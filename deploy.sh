#!/bin/bash

# ====================================================
# Deploy Script — DJAYA MANDIRI TEKNIK
# Main → /home/alurelab/jayapetir.com
# ====================================================

set -e

REPO_DIR="/home/alurelab/repositories/DJAYA-MANDIRI-TEKNIK"
TARGET_DIR="/home/alurelab/jayapetir.com"
BRANCH="main"

echo "========================================"
echo "  Deploying DJAYA MANDIRI TEKNIK"
echo "  Branch : $BRANCH"
echo "  Target : $TARGET_DIR"
echo "========================================"

# 1. Pull latest code
echo ""
echo "[1/5] Pulling latest code..."
cd "$REPO_DIR"
git checkout "$BRANCH"
git pull origin "$BRANCH"

# 2. Sync files to target (exclude git, node_modules, etc.)
echo ""
echo "[2/5] Syncing files to target directory..."
rsync -a --delete \
    --exclude='.git' \
    --exclude='.gitignore' \
    --exclude='node_modules' \
    --exclude='vendor' \
    --exclude='storage/framework/cache/data/*' \
    --exclude='storage/framework/sessions/*' \
    --exclude='storage/framework/views/*' \
    --exclude='storage/logs/*' \
    --exclude='.env' \
    "$REPO_DIR/" "$TARGET_DIR/"

# 3. Create storage symlink
echo ""
echo "[3/5] Setting up storage..."
cd "$TARGET_DIR"
php artisan storage:link --force 2>/dev/null || true

# 4. Install/update composer dependencies
echo ""
echo "[4/5] Installing Composer dependencies..."
if [ -f "$TARGET_DIR/composer.lock" ]; then
    cd "$TARGET_DIR" && composer install --no-dev --optimize-autoloader --no-interaction
else
    cd "$TARGET_DIR" && composer install --no-interaction
fi

# 5. Optimize Laravel
echo ""
echo "[5/5] Optimizing Laravel..."
cd "$TARGET_DIR"
php artisan optimize:clear 2>/dev/null || true
php artisan view:cache 2>/dev/null || true
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true

# 6. Set permissions
echo ""
echo "[6/6] Setting permissions..."
chmod -R 775 "$TARGET_DIR/storage"
chmod -R 775 "$TARGET_DIR/bootstrap/cache"
if [ -d "$TARGET_DIR/public/storage" ]; then
    chmod -R 775 "$TARGET_DIR/public/storage"
fi

echo ""
echo "========================================"
echo "  ✅ Deploy complete!"
echo "  Target: $TARGET_DIR"
echo "========================================"
