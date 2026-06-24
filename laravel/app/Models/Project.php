<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $fillable = [
        'category_id', 'title', 'slug', 'location', 'year', 'client',
        'thumbnail', 'gallery', 'description', 'before_after', 'featured',
        'seo_title', 'seo_description', 'seo_keywords',
    ];

    protected $casts = [
        'gallery' => 'json',
        'before_after' => 'json',
        'featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('home.featured_projects'));
        static::deleted(fn () => cache()->forget('home.featured_projects'));
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }
}
