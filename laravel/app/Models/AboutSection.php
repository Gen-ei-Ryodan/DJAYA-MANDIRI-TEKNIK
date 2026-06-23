<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'description', 'vision', 'missions', 'company_images', 'is_active',
    ];

    protected $casts = [
        'missions' => 'json',
        'company_images' => 'json',
        'is_active' => 'boolean',
    ];
}
