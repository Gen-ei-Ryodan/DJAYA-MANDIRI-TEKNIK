<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'thumbnail', 'gallery',
        'description', 'specification', 'featured',
        'seo_title', 'seo_description', 'seo_keywords', 'order',
    ];

    protected $casts = [
        'gallery' => 'json',
        'featured' => 'boolean',
        'order' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
