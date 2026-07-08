<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleCitySeeder extends Seeder
{
    private array $fields = [
        'Title', 'Slug', 'Thumbnail', 'Content', 'Excerpt',
        'Tags', 'SEO Title', 'SEO Description', 'SEO Keywords',
    ];

    private array $fieldKeys = [
        'title', 'slug', 'thumbnail', 'content', 'excerpt',
        'tags', 'seo_title', 'seo_description', 'seo_keywords',
    ];

    public function run(): void
    {
        $filePath = base_path('artikel.txt');

        if (!file_exists($filePath)) {
            $this->command?->error('File artikel.txt tidak ditemukan di ' . $filePath);

            return;
        }

        $category = ArticleCategory::firstOrCreate(
            ['slug' => 'layanan-kota'],
            [
                'name' => 'Layanan Kota',
                'description' => 'Artikel layanan pemasangan penangkal petir di berbagai kota di Jawa Timur.',
                'order' => 6,
            ]
        );

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            $this->command?->error('Gagal membaca file artikel.txt');

            return;
        }

        $articles = [];
        $current = [];
        $bufferField = null;
        $bufferLines = [];

        foreach ($lines as $raw) {
            $line = trim($raw);
            if ($line === '') {
                continue;
            }

            // Detect field header
            $fieldIndex = $this->detectField($line);

            if ($fieldIndex !== null) {
                // Flush buffer into previous field before switching
                if ($bufferField !== null && $bufferLines !== []) {
                    $current[$bufferField] = implode("\n\n", $bufferLines);
                    $bufferField = null;
                    $bufferLines = [];
                }

                $key = $this->fieldKeys[$fieldIndex];
                $fieldName = $this->fields[$fieldIndex];

                // Check for inline value (Format B: "FieldName: value")
                $colonPos = strpos($line, ': ');
                $hasInlineValue = $colonPos !== false
                    && trim(substr($line, 0, $colonPos)) === $fieldName;

                if ($hasInlineValue) {
                    $value = trim(substr($line, $colonPos + 2));

                    // Title with inline value marks a new article
                    if ($fieldIndex === 0 && $current !== []) {
                        $articles[] = $current;
                        $current = [];
                    }

                    $current[$key] = $value;
                } else {
                    // Format A: field name on its own line, value follows
                    if ($fieldIndex === 0 && $current !== []) {
                        $articles[] = $current;
                        $current = [];
                    }

                    // Set a placeholder so we know field exists;
                    // value will be filled by the following lines
                    $current[$key] = '';
                    $bufferField = $key;
                    $bufferLines = [];
                }
            } else {
                // Accumulate content lines for the current buffer field
                if ($bufferField !== null) {
                    $bufferLines[] = $line;
                }
            }
        }

        // Flush last buffer
        if ($bufferField !== null && $bufferLines !== []) {
            $current[$bufferField] = implode("\n\n", $bufferLines);
        }

        // Save last article
        if ($current !== [] && isset($current['title'])) {
            $articles[] = $current;
        }

        $this->command?->info('Found ' . count($articles) . ' city articles to seed.');

        $count = 0;
        foreach ($articles as $article) {
            $slug = isset($article['slug']) ? Str::slug($article['slug']) : Str::slug($article['title'] ?? '');
            $title = $article['title'] ?? '';
            $excerpt = $article['excerpt'] ?? '';
            $content = $article['content'] ?? '';

            // Parse tags: handle both comma-separated and newline-separated
            $tagsRaw = $article['tags'] ?? '';
            $tagsArray = [];
            foreach (preg_split('/[,\n]/', $tagsRaw) as $tag) {
                $tag = trim($tag, " \t\n\r\0\x0B,");
                if ($tag !== '') {
                    $tagsArray[] = $tag;
                }
            }

            // Skip if we already have this slug
            if (Article::where('slug', $slug)->exists()) {
                $this->command?->warn("Skipping '{$title}' — slug '{$slug}' already exists.");

                continue;
            }

            Article::create([
                'category_id' => $category->id,
                'title' => $title,
                'slug' => $slug,
                'thumbnail' => null,
                'content' => $this->formatContent($content),
                'excerpt' => $excerpt,
                'tags' => $tagsArray,
                'seo_title' => $article['seo_title'] ?? $title,
                'seo_description' => $article['seo_description'] ?? $excerpt,
                'seo_keywords' => $article['seo_keywords'] ?? implode(', ', $tagsArray),
                'published_at' => now(),
                'status' => 'published',
                'read_time' => $this->calculateReadTime($content),
            ]);

            $count++;
        }

        $this->command?->info("Successfully seeded {$count} city articles in category '{$category->name}'.");
    }

    /**
     * Detect if a line is a known field header.
     * Returns the field index or null.
     */
    private function detectField(string $line): ?int
    {
        foreach ($this->fields as $i => $field) {
            // Exact match: "Title"
            if ($line === $field) {
                return $i;
            }

            // Inline value: "Title: something"
            if (str_starts_with($line, $field . ': ')) {
                return $i;
            }
        }

        return null;
    }

    private function formatContent(string $content): string
    {
        // Convert plain text sections into simple HTML paragraphs
        $parts = explode("\n\n", $content);
        $html = '';

        foreach ($parts as $part) {
            $part = trim($part);
            if ($part === '') {
                continue;
            }

            // Detect FAQ and other sub-headings
            if (preg_match('/^(FAQ|Hubungi Kami|Layanan Kami|Area Layanan|Mengapa Memilih|Keunggulan|Solusi|Pilihan Layanan)/', $part)) {
                $html .= '<h2>' . e($part) . '</h2>';
            } elseif (str_starts_with($part, '- ') || str_starts_with($part, '• ')) {
                $html .= '<ul>';
                foreach (explode("\n", $part) as $item) {
                    $item = trim($item, '- • ');
                    if ($item !== '') {
                        $html .= '<li>' . e($item) . '</li>';
                    }
                }
                $html .= '</ul>';
            } else {
                $html .= '<p>' . e($part) . '</p>';
            }
        }

        return $html;
    }

    private function calculateReadTime(string $content): int
    {
        $words = str_word_count(strip_tags($content));

        return max(1, (int) ceil($words / 200));
    }
}
