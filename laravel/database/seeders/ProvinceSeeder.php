<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        Province::create([
            'name' => 'Jawa Timur',
            'slug' => 'jawa-timur',
            'iso_code' => 'ID-JI',
        ]);
    }
}