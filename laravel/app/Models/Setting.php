<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group', 'label'];

    protected $casts = [
        'value' => 'string',
    ];

    public static function get(string $key, $default = null): ?string
    {
        return cache()->rememberForever("setting.{$key}", fn () => 
            static::where('key', $key)->value('value') ?? $default
        );
    }

    public static function set(string $key, $value, string $type = 'text', string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type, 'group' => $group]
        );
        cache()->forget("setting.{$key}");
    }
}
