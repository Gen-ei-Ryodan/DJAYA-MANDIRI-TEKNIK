<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address', 'whatsapp', 'telephone', 'email',
        'google_maps', 'operational_hours', 'is_active',
    ];

    protected $casts = [
        'operational_hours' => 'json',
        'is_active' => 'boolean',
    ];
}
