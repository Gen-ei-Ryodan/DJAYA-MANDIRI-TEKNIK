<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'image', 'order'];

    protected $casts = ['order' => 'integer'];

    protected static function booted(): void
    {
        static::deleted(fn () => static::renumberOrders());
    }

    protected static function renumberOrders(): void
    {
        $order = 1;

        foreach (static::query()->orderBy('order')->get() as $category) {
            if ($category->order !== $order) {
                $category->forceFill(['order' => $order])->save();
            }

            $order++;
        }
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
