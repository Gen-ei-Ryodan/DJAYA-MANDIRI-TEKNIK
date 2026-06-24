<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description', 'background_video',
        'background_image', 'statistics', 'button1_text', 'button1_url',
        'button2_text', 'button2_url', 'is_active',
    ];

    protected $casts = [
        'statistics' => 'json',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('home.hero'));
        static::deleted(fn () => cache()->forget('home.hero'));
    }
}
