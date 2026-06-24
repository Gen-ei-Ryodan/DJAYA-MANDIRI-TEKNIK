<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function get(string $key, $default = null): ?string
    {
        return Setting::get($key, $default);
    }

    public function getAll(): array
    {
        return cache()->rememberForever('settings.all', function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }

    public function getCompanyName(): string
    {
        return $this->get('company_name', 'DJAJA MANDIRI TEKNIK');
    }

    public function getWhatsApp(): string
    {
        return $this->get('whatsapp_number', '6285704307095');
    }

    public function getEmail(): string
    {
        return $this->get('company_email', 'info@djajamandiriteknik.com');
    }

    public function getLogo(): string
    {
        return $this->get('logo', asset('images/logo.png'));
    }

    public function getFavicon(): string
    {
        return $this->get('favicon', asset('images/favicon.ico'));
    }
}
