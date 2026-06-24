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
}
