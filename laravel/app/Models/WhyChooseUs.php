<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = 'why_choose_us';

    protected $fillable = [
        'icon', 'title', 'description', 'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('home.why_choose_us'));
        static::deleted(fn () => cache()->forget('home.why_choose_us'));
    }
}
