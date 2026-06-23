<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Service;
use App\Models\WhyChooseUs;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        HeroSection::create([
            'title' => 'Solusi Penangkal Petir Profesional untuk Perlindungan Bangunan Anda',
            'subtitle' => 'Proteksi Maksimal',
            'description' => 'DJAYA MANDIRI TEKNIK hadir sebagai mitra terpercaya dalam jasa pemasangan penangkal petir dan penyedia material penangkal petir berkualitas.',
            'statistics' => [
                ['label' => 'Project', 'value' => '100+'],
                ['label' => 'Tahun Pengalaman', 'value' => '10+'],
                ['label' => 'Produk Terjual', 'value' => '500+'],
                ['label' => 'Kepuasan Pelanggan', 'value' => '98%'],
            ],
            'button1_text' => 'Konsultasi Sekarang',
            'button1_url' => url('#contact'),
            'button2_text' => 'Lihat Project',
            'button2_url' => '#projects',
            'is_active' => true,
        ]);

        // About Section
        AboutSection::create([
            'description' => 'DJAYA MANDIRI TEKNIK adalah perusahaan yang bergerak di bidang jasa pemasangan penangkal petir dan penyedia material penangkal petir. Kami berkomitmen memberikan solusi proteksi petir yang handal, aman, dan sesuai standar nasional maupun internasional.',
            'vision' => 'Menjadi perusahaan terpercaya dalam bidang sistem proteksi petir di Indonesia, memberikan perlindungan optimal bagi bangunan dan aset melalui teknologi terkini dan layanan profesional.',
            'missions' => [
                'Memberikan layanan profesional dan berkualitas tinggi',
                'Menyediakan material penangkal petir berkualitas',
                'Mengutamakan kepuasan pelanggan',
                'Mengikuti perkembangan teknologi terkini',
                'Membangun hubungan jangka panjang dengan klien',
            ],
            'company_images' => [],
            'is_active' => true,
        ]);

        // Services
        $services = [
            ['title' => 'Jasa Pemasangan Penangkal Petir', 'slug' => 'jasa-pemasangan-penangkal-petir', 'description' => 'Layanan pemasangan sistem penangkal petir profesional untuk berbagai jenis bangunan. Tim teknisi berpengalaman dan tersertifikasi siap memberikan solusi proteksi terbaik.', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>', 'order' => 1],
            ['title' => 'Supplier Material Penangkal Petir', 'slug' => 'supplier-material-penangkal-petir', 'description' => 'Penyedia material penangkal petir berkualitas dengan standar SNI dan internasional. Tersedia berbagai jenis komponen untuk kebutuhan instalasi proteksi petir.', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>', 'order' => 2],
        ];
        foreach ($services as $svc) { Service::create($svc); }

        // Why Choose Us
        $whyItems = [
            ['title' => 'Pengerjaan Profesional', 'description' => 'Tim teknisi berpengalaman dan tersertifikasi', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>', 'order' => 1],
            ['title' => 'Material Berkualitas', 'description' => 'Material bersertifikasi SNI dan internasional', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>', 'order' => 2],
            ['title' => 'Solusi Sesuai Kebutuhan', 'description' => 'Analisis dan rekomendasi sistem proteksi yang tepat', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>', 'order' => 3],
            ['title' => 'Pelayanan Responsif', 'description' => 'Tim support siap membantu dalam 1x24 jam', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'order' => 4],
            ['title' => 'Harga Kompetitif', 'description' => 'Harga terbaik dengan kualitas tanpa kompromi', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>', 'order' => 5],
            ['title' => 'Konsultasi Gratis', 'description' => 'Konsultasi tanpa biaya untuk kebutuhan proteksi petir', 'icon' => '<svg class="w-7 h-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>', 'order' => 6],
        ];
        foreach ($whyItems as $item) { WhyChooseUs::create($item); }

        // Settings
        $settings = [
            ['key' => 'company_name', 'value' => 'DJAYA MANDIRI TEKNIK', 'type' => 'text', 'group' => 'general', 'label' => 'Nama Perusahaan'],
            ['key' => 'company_email', 'value' => 'info@djayamandiriteknik.com', 'type' => 'email', 'group' => 'general', 'label' => 'Email Perusahaan'],
            ['key' => 'whatsapp_number', 'value' => '6285704307095', 'type' => 'text', 'group' => 'social', 'label' => 'Nomor WhatsApp'],
            ['key' => 'telephone', 'value' => '081393663669', 'type' => 'text', 'group' => 'social', 'label' => 'Nomor Telepon'],
            ['key' => 'address', 'value' => 'Jl. Kedungrejo Timur Gg Satria RT 6 RW 1, Kec. Waru, Kab. Sidoarjo', 'type' => 'text', 'group' => 'general', 'label' => 'Alamat'],
            ['key' => 'google_analytics', 'value' => '', 'type' => 'text', 'group' => 'analytics', 'label' => 'Google Analytics ID'],
            ['key' => 'facebook_pixel', 'value' => '', 'type' => 'text', 'group' => 'analytics', 'label' => 'Facebook Pixel ID'],
        ];
        foreach ($settings as $st) { Setting::create($st); }

        // Contact
        Contact::create([
            'address' => 'Jl. Kedungrejo Timur Gg Satria RT 6 RW 1, Kec. Waru, Kab. Sidoarjo',
            'whatsapp' => '085704307095',
            'telephone' => '081393663669',
            'email' => 'info@djayamandiriteknik.com',
            'operational_hours' => [['day' => 'Senin - Sabtu', 'open' => '08.00', 'close' => '17.00 WIB']],
            'is_active' => true,
        ]);

        // SEO Meta
        $seoPages = [
            ['page' => 'home', 'meta_title' => 'DJAYA MANDIRI TEKNIK - Solusi Penangkal Petir Profesional | Sidoarjo', 'meta_description' => 'DJAYA MANDIRI TEKNIK melayani jasa pemasangan penangkal petir dan supplier material penangkal petir berkualitas di Sidoarjo. Konsultasi gratis!', 'keywords' => 'penangkal petir, jasa penangkal petir, material penangkal petir, sistem proteksi petir, sidoarjo'],
            ['page' => 'services', 'meta_title' => 'Layanan Penangkal Petir | DJAYA MANDIRI TEKNIK', 'meta_description' => 'Layanan jasa pemasangan dan supplier material penangkal petir profesional.', 'keywords' => 'jasa penangkal petir, supplier material penangkal petir'],
            ['page' => 'products', 'meta_title' => 'Produk Material Penangkal Petir | DJAYA MANDIRI TEKNIK', 'meta_description' => 'Produk material penangkal petir berkualitas standar SNI dan internasional.', 'keywords' => 'material penangkal petir, produk penangkal petir'],
            ['page' => 'projects', 'meta_title' => 'Project Penangkal Petir | DJAYA MANDIRI TEKNIK', 'meta_description' => 'Portfolio project pemasangan penangkal petir oleh DJAYA MANDIRI TEKNIK.', 'keywords' => 'project penangkal petir, instalasi penangkal petir'],
            ['page' => 'articles', 'meta_title' => 'Artikel Proteksi Petir | DJAYA MANDIRI TEKNIK', 'meta_description' => 'Artikel dan tips seputar sistem proteksi petir.', 'keywords' => 'artikel penangkal petir, tips proteksi petir'],
            ['page' => 'contact', 'meta_title' => 'Hubungi Kami | DJAYA MANDIRI TEKNIK', 'meta_description' => 'Hubungi DJAYA MANDIRI TEKNIK untuk konsultasi penangkal petir gratis.', 'keywords' => 'kontak penangkal petir, konsultasi penangkal petir'],
        ];
        foreach ($seoPages as $seo) { SeoMeta::create($seo); }
    }
}
