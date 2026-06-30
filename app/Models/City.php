<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $fillable = [
        'province_id', 'name', 'slug', 'type',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function scopeKota($query)
    {
        return $query->where('type', 'Kota');
    }

    public function scopeKabupaten($query)
    {
        return $query->where('type', 'Kabupaten');
    }
}