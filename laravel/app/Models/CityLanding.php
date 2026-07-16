<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityLanding extends Model
{
    protected $fillable = [
        'city_id', 'title', 'subtitle', 'description', 'content',
        'hero_image', 'cta_text', 'cta_url', 'statistics', 'is_active',
    ];

    protected $casts = [
        'statistics' => 'json',
        'is_active' => 'boolean',
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}