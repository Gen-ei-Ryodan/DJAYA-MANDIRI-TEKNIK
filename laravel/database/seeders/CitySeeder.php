<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $province = Province::where('slug', 'jawa-timur')->firstOrFail();

        $cities = [
            // Kota (9)
            ['name' => 'Surabaya', 'slug' => 'surabaya', 'type' => 'Kota'],
            ['name' => 'Malang', 'slug' => 'malang', 'type' => 'Kota'],
            ['name' => 'Batu', 'slug' => 'batu', 'type' => 'Kota'],
            ['name' => 'Blitar', 'slug' => 'blitar', 'type' => 'Kota'],
            ['name' => 'Kediri', 'slug' => 'kediri', 'type' => 'Kota'],
            ['name' => 'Madiun', 'slug' => 'madiun', 'type' => 'Kota'],
            ['name' => 'Mojokerto', 'slug' => 'mojokerto', 'type' => 'Kota'],
            ['name' => 'Pasuruan', 'slug' => 'pasuruan', 'type' => 'Kota'],
            ['name' => 'Probolinggo', 'slug' => 'probolinggo', 'type' => 'Kota'],
            // Kabupaten (29)
            ['name' => 'Bangkalan', 'slug' => 'bangkalan', 'type' => 'Kabupaten'],
            ['name' => 'Banyuwangi', 'slug' => 'banyuwangi', 'type' => 'Kabupaten'],
            ['name' => 'Blitar', 'slug' => 'blitar-kab', 'type' => 'Kabupaten'],
            ['name' => 'Bojonegoro', 'slug' => 'bojonegoro', 'type' => 'Kabupaten'],
            ['name' => 'Bondowoso', 'slug' => 'bondowoso', 'type' => 'Kabupaten'],
            ['name' => 'Gresik', 'slug' => 'gresik', 'type' => 'Kabupaten'],
            ['name' => 'Jember', 'slug' => 'jember', 'type' => 'Kabupaten'],
            ['name' => 'Jombang', 'slug' => 'jombang', 'type' => 'Kabupaten'],
            ['name' => 'Kediri', 'slug' => 'kediri-kab', 'type' => 'Kabupaten'],
            ['name' => 'Lamongan', 'slug' => 'lamongan', 'type' => 'Kabupaten'],
            ['name' => 'Lumajang', 'slug' => 'lumajang', 'type' => 'Kabupaten'],
            ['name' => 'Madiun', 'slug' => 'madiun-kab', 'type' => 'Kabupaten'],
            ['name' => 'Magetan', 'slug' => 'magetan', 'type' => 'Kabupaten'],
            ['name' => 'Malang', 'slug' => 'malang-kab', 'type' => 'Kabupaten'],
            ['name' => 'Mojokerto', 'slug' => 'mojokerto-kab', 'type' => 'Kabupaten'],
            ['name' => 'Nganjuk', 'slug' => 'nganjuk', 'type' => 'Kabupaten'],
            ['name' => 'Ngawi', 'slug' => 'ngawi', 'type' => 'Kabupaten'],
            ['name' => 'Pacitan', 'slug' => 'pacitan', 'type' => 'Kabupaten'],
            ['name' => 'Pamekasan', 'slug' => 'pamekasan', 'type' => 'Kabupaten'],
            ['name' => 'Pasuruan', 'slug' => 'pasuruan-kab', 'type' => 'Kabupaten'],
            ['name' => 'Ponorogo', 'slug' => 'ponorogo', 'type' => 'Kabupaten'],
            ['name' => 'Probolinggo', 'slug' => 'probolinggo-kab', 'type' => 'Kabupaten'],
            ['name' => 'Sampang', 'slug' => 'sampang', 'type' => 'Kabupaten'],
            ['name' => 'Sidoarjo', 'slug' => 'sidoarjo', 'type' => 'Kabupaten'],
            ['name' => 'Situbondo', 'slug' => 'situbondo', 'type' => 'Kabupaten'],
            ['name' => 'Sumenep', 'slug' => 'sumenep', 'type' => 'Kabupaten'],
            ['name' => 'Trenggalek', 'slug' => 'trenggalek', 'type' => 'Kabupaten'],
            ['name' => 'Tuban', 'slug' => 'tuban', 'type' => 'Kabupaten'],
            ['name' => 'Tulungagung', 'slug' => 'tulungagung', 'type' => 'Kabupaten'],
        ];

        foreach ($cities as $city) {
            City::create([
                'province_id' => $province->id,
                'name' => $city['name'],
                'slug' => $city['slug'],
                'type' => $city['type'],
            ]);
        }
    }
}