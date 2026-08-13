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

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('home.featured_products'));
        static::deleted(fn () => cache()->forget('home.featured_products'));
        static::deleted(fn () => static::renumberOrders());
    }

    protected static function renumberOrders(): void
    {
        $order = 1;

        foreach (static::query()->orderBy('order')->get() as $product) {
            if ($product->order !== $order) {
                $product->forceFill(['order' => $order])->save();
            }

            $order++;
        }
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
}
