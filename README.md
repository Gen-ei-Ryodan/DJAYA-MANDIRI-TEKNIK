# DJAYA MANDIRI TEKNIK

Website perusahaan CV DJAYA MANDIRI TEKNIK - Sistem Informasi Penangkal Petir.

## Tech Stack

- **Framework:** Laravel
- **Frontend:** Blade, Filament Admin
- **Database:** MySQL
- **Styling:** Tailwind CSS

## Installation

```bash
# Clone repository
git clone https://github.com/Gen-ei-Ryodan/DJAYA-MANDIRI-TEKNIK.git

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database migration
php artisan migrate --seed

# Development server
php artisan serve
```

## Branching Strategy

- `main` - Production stable branch
- `develop` - Integration branch for features
- `feature/*` - Feature development branches
- `deploy/shared-hosting` - Deployment configuration for shared hosting

## License

Proprietary - CV DJAYA MANDIRI TEKNIK
