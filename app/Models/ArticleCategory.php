<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'order'];

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

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
