<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address', 'whatsapp', 'telephone', 'email',
        'operational_hours', 'is_active',
    ];

    protected $casts = [
        'operational_hours' => 'json',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(fn () => cache()->forget('home.contact'));
        static::deleted(fn () => cache()->forget('home.contact'));
    }
}
