<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'thumbnail', 'content', 'excerpt',
        'tags', 'seo_title', 'seo_description', 'seo_keywords',
        'published_at', 'status', 'read_time',
    ];

    protected $casts = [
        'tags' => 'json',
        'published_at' => 'datetime',
        'read_time' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('home.latest_articles'));
        static::deleted(fn () => cache()->forget('home.latest_articles'));
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Get content with guaranteed HTML paragraph formatting.
     */
    public function getFormattedContentAttribute(): string
    {
        $content = trim($this->content ?? '');

        if ($content === '') {
            return '';
        }

        // If content is already rich HTML (contains <p> or <div> or <h2>)
        if (preg_match('/<(p|h[1-6]|ul|ol|table|blockquote|div)\b/i', $content)) {
            return $content;
        }

        // Convert double newline to paragraphs, single newline to <br>
        $paragraphs = preg_split('/\n\s*\n/', $content);
        $html = '';

        foreach ($paragraphs as $paragraph) {
            $paragraph = trim($paragraph);
            if ($paragraph === '') {
                continue;
            }

            // Detect heading lines (e.g., lines ending with no dot or starting with specific keyword)
            if (preg_match('/^(FAQ|Keunggulan|Layanan|Area Layanan|Mengapa|Manfaat|Tips|Kesimpulan|Tentang|Solusi)/i', $paragraph) && strlen($paragraph) < 100) {
                $html .= '<h2 class="font-heading">' . e($paragraph) . '</h2>';
            } elseif (str_starts_with($paragraph, '- ') || str_starts_with($paragraph, '• ')) {
                $lines = explode("\n", $paragraph);
                $html .= '<ul>';
                foreach ($lines as $line) {
                    $item = trim($line, "- \t\n\r\0\x0B•");
                    if ($item !== '') {
                        $html .= '<li>' . e($item) . '</li>';
                    }
                }
                $html .= '</ul>';
            } else {
                $html .= '<p>' . nl2br(e($paragraph)) . '</p>';
            }
        }

        return $html;
    }
}
