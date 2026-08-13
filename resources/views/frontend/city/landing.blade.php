@php
    $cityName = $city->type . ' ' . $city->name;
    $heroTitle = $landing->title ?? "Jasa Penangkal Petir {$cityName}";
    $heroDesc = $landing->subtitle ?? "Solusi proteksi petir profesional untuk bangunan di {$cityName}. Tim teknisi berpengalaman siap membantu.";
    $heroCta = $landing->cta_text ?? 'Konsultasi Sekarang';
    $heroCtaUrl = $landing->cta_url ?? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings->getWhatsApp() ?? '6285704307095');
    $stats = $landing->statistics ?? [
        ['icon' => 'task_alt', 'value' => '500+', 'label' => 'Project Selesai'],
        ['icon' => 'sentiment_satisfied', 'value' => '350+', 'label' => 'Pelanggan Puas'],
        ['icon' => 'verified', 'value' => '100%', 'label' => 'Material Berkualitas'],
        ['icon' => 'support_agent', 'value' => '24/7', 'label' => 'Dukungan Profesional'],
    ];
@endphp

@extends('frontend.layouts.app')

@section('content')
{{-- HERO --}}
<section class="relative overflow-hidden bg-on-background">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-on-background/70 z-10"></div>
        @if($landing && $landing->hero_image)
        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $landing->hero_image) }}" alt="{{ $heroTitle }}">
        @endif
    </div>
    <div class="relative z-20 w-full px-4 md:px-gutter max-w-container-max mx-auto text-on-primary py-20 md:py-28 lg:py-36">
        <div class="max-w-3xl reveal active">
            @include('frontend.partials.breadcrumb', ['crumbs' => [
                ['label' => 'Beranda', 'url' => route('home')],
                ['label' => "Penangkal Petir {$cityName}"],
            ]])
            <h1 class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl mb-3 md:mb-5 leading-tight font-bold" style="font-family: Poppins">
                {{ $heroTitle }}
            </h1>
            <p class="text-sm sm:text-base lg:text-lg text-on-primary/90 mb-5 md:mb-7 max-w-xl lg:max-w-2xl leading-relaxed">
                {{ $heroDesc }}
            </p>
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                <a href="{{ $heroCtaUrl }}" target="_blank"
                   class="bg-tertiary-fixed text-on-tertiary-fixed px-6 md:px-8 py-3 md:py-4 rounded-lg font-bold text-sm md:text-lg hover:bg-tertiary-fixed-dim transition-colors shadow-xl text-center">
                    {{ $heroCta }}
                </a>
                <a href="{{ route('projects') }}"
                   class="border-2 border-on-primary text-on-primary px-6 md:px-8 py-3 md:py-4 rounded-lg font-bold text-sm md:text-lg hover:bg-on-primary hover:text-on-background transition-all text-center">
                    Lihat Project
                </a>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="relative z-10 -mt-10 md:-mt-16">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($stats as $stat)
            <div class="bg-surface-container-lowest p-4 md:p-8 rounded-xl md:rounded-2xl shadow-lg flex items-center gap-4">
                <div class="w-10 h-10 md:w-14 md:h-14 bg-secondary-container flex items-center justify-center rounded-full text-secondary shrink-0">
                    <span class="material-symbols-outlined text-xl md:text-3xl">{{ $stat['icon'] ?? 'task_alt' }}</span>
                </div>
                <div>
                    <div class="font-bold text-lg md:text-3xl text-on-background">{{ $stat['value'] }}</div>
                    <div class="text-sm md:text-base text-on-surface-variant">{{ $stat['label'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ABOUT CITY --}}
<section class="py-16 md:py-section-padding bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="max-w-4xl mx-auto text-center reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-3 md:mb-4 block text-xs md:text-sm">Layanan Kami di {{ $cityName }}</span>
            <h2 class="text-2xl md:text-headline-md text-on-background mb-4 md:mb-6 font-bold" style="font-family: Poppins">
                {{ $landing->title ?? "Jasa & Material Penangkal Petir {$cityName}" }}
            </h2>
            <p class="text-sm md:text-body-md text-on-surface-variant mb-6 md:mb-8 leading-relaxed max-w-3xl mx-auto">
                {{ $landing->description ?? "{$settings->getCompanyName()} melayani jasa pemasangan penangkal petir dan penyedia material penangkal petir berkualitas di {$cityName} dan sekitarnya. Dengan pengalaman bertahun-tahun, kami siap memberikan solusi proteksi petir terbaik untuk bangunan Anda." }}
            </p>
            @if($landing && $landing->content)
            <div class="text-sm md:text-body-md text-on-surface-variant leading-relaxed max-w-3xl mx-auto text-left">
                {!! $landing->content !!}
            </div>
            @endif
        </div>
    </div>
</section>

{{-- LAYANAN --}}
<section class="py-16 md:py-section-padding bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="text-center mb-10 md:mb-16 reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Our Expertise</span>
            <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Layanan Penangkal Petir {{ $cityName }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            @forelse($services as $service)
            <div class="group relative overflow-hidden rounded-2xl bg-surface-container-lowest shadow-lg hover:shadow-2xl transition-all duration-500 reveal">
                <div class="h-48 md:h-64 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         src="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                         alt="{{ $service->title }} di {{ $cityName }}">
                </div>
                <div class="p-6 md:p-10">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-on-background text-tertiary-fixed rounded-xl md:rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg -translate-y-1/2 mt-[-3.5rem] md:mt-[-5rem] relative z-10">
                        {!! $service->icon ?? '<span class="material-symbols-outlined text-2xl md:text-4xl">construction</span>' !!}
                    </div>
                    <h3 class="text-lg md:text-headline-sm mb-3 md:mb-4 text-on-background font-bold" style="font-family: Poppins">{{ $service->title }} di {{ $cityName }}</h3>
                    <p class="text-sm md:text-base text-on-surface-variant mb-4 md:mb-6 leading-relaxed">{{ Str::limit($service->description, 150) }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-on-background font-bold gap-2 group/btn text-sm md:text-base">
                        Pelajari Selengkapnya
                        <span class="material-symbols-outlined group-hover/btn:translate-x-2 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-8 md:py-12 text-on-surface-variant reveal">
                Belum ada layanan yang ditambahkan.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- PRODUK --}}
<section class="py-16 md:py-section-padding bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 md:mb-16 reveal gap-4">
            <div>
                <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Premium Products</span>
                <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Produk Penangkal Petir {{ $cityName }}</h2>
            </div>
            <a href="{{ route('products') }}" class="bg-on-background text-on-primary px-5 md:px-6 py-2.5 md:py-3 rounded-lg font-bold text-sm md:text-base hover:bg-on-surface transition-colors shrink-0">
                Lihat Semua Produk
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8 reveal">
            @forelse($products as $product)
            <a href="{{ route('products.show', $product->slug) }}" class="bg-surface-container-lowest p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md border border-transparent hover:border-tertiary-fixed transition-all group block">
                <div class="aspect-square rounded-xl overflow-hidden mb-4 md:mb-6 bg-surface-container-low flex items-center justify-center p-4 md:p-8">
                    <img class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500"
                         src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                         alt="{{ $product->name }}">
                </div>
                <span class="text-[10px] md:text-xs font-bold text-on-tertiary-container bg-tertiary-fixed/20 px-2 py-0.5 md:px-2 md:py-1 rounded mb-2 md:mb-4 inline-block">
                    {{ $product->category->name ?? 'PRODUK' }}
                </span>
                <h4 class="text-base md:text-lg mb-1 md:mb-2 text-on-background font-bold" style="font-family: Poppins">{{ $product->name }}</h4>
                <p class="text-xs md:text-sm text-on-surface-variant mb-4 md:mb-6 line-clamp-2">{{ $product->description }}</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-sm md:text-base text-on-background">Lihat Detail</span>
                    <span class="w-8 h-8 md:w-10 md:h-10 bg-on-background text-on-primary rounded-full flex items-center justify-center hover:bg-tertiary-fixed hover:text-on-tertiary-fixed transition-colors">
                        <span class="material-symbols-outlined text-lg md:text-xl">shopping_cart</span>
                    </span>
                </div>
            </a>
            @empty
            @for($i = 1; $i <= 3; $i++)
            <div class="bg-surface-container-lowest p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md border border-transparent hover:border-tertiary-fixed transition-all group">
                <div class="aspect-square rounded-xl overflow-hidden mb-4 md:mb-6 bg-surface-container-low flex items-center justify-center p-4 md:p-8">
                    <span class="material-symbols-outlined text-4xl md:text-6xl text-on-surface-variant/30">image</span>
                </div>
                <h4 class="text-base md:text-lg mb-2 text-on-background font-bold" style="font-family: Poppins">Produk Unggulan {{ $i }}</h4>
                <p class="text-xs md:text-sm text-on-surface-variant mb-4 md:mb-6">Material penangkal petir berkualitas tinggi.</p>
            </div>
            @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- PROJECT --}}
@if($projects->isNotEmpty())
<section class="py-16 md:py-section-padding bg-surface-container-low">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="text-center mb-10 md:mb-16 reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Project di {{ $cityName }}</span>
            <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Project Terbaru</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 reveal">
            @foreach($projects->take(4) as $project)
            <a href="{{ route('projects.show', $project->slug) }}" class="group relative overflow-hidden rounded-xl md:rounded-2xl h-64 md:h-[350px] block">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     src="{{ ! empty($project->thumbnail) ? asset('storage/' . $project->thumbnail[0]) : '' }}"
                     alt="{{ $project->title }}">
                <div class="absolute inset-0 bg-gradient-to-t from-on-background/80 to-transparent flex items-end p-4 md:p-8">
                    <div>
                        <span class="text-tertiary-fixed font-bold text-[10px] md:text-xs">{{ strtoupper($project->category->name ?? 'PROJECT') }}</span>
                        <h4 class="text-on-primary font-bold text-lg md:text-2xl mt-1">{{ $project->title }}</h4>
                        @if($project->location)
                        <p class="text-on-primary/60 text-xs md:text-sm mt-1">{{ $project->location }}</p>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-16 md:py-24 bg-[#0F172A] relative overflow-hidden lightning-pattern">
    <div class="absolute top-0 right-0 w-48 md:w-96 h-48 md:h-96 bg-tertiary-fixed/10 blur-[60px] md:blur-[100px] rounded-full"></div>
    <div class="max-w-container-max mx-auto px-4 md:px-gutter text-center relative z-10 reveal">
        <h2 class="text-xl md:text-headline-md text-on-primary mb-4 md:mb-6 font-bold" style="font-family: Poppins">
            Butuh Proteksi Petir di {{ $cityName }}?
        </h2>
        <p class="text-sm md:text-lg text-on-primary/70 mb-6 md:mb-10 max-w-2xl mx-auto">
            Konsultasikan kebutuhan proteksi petir Anda bersama tim engineering kami. Gratis!
        </p>
        <a href="{{ $heroCtaUrl }}" target="_blank"
           class="bg-tertiary-fixed text-on-tertiary-fixed px-8 md:px-10 py-3 md:py-4 rounded-xl font-bold text-base md:text-xl hover:scale-105 active:scale-95 transition-all shadow-[0_10px_40px_rgba(255,221,184,0.3)] inline-block">
            {{ $heroCta }}
        </a>
    </div>
</section>

{{-- Internal Links: Other Cities --}}
@include('frontend.partials.city-links', [
    'title' => 'Layanan Penangkal Petir di Kota Lain',
    'subtitle' => 'Kami juga melayani pemasangan dan penyediaan material penangkal petir di kota-kota berikut:',
    'excludeSlug' => $city->slug,
    'limit' => 38,
])

{{-- Internal Links: Major Cities --}}
<section class="py-8 md:py-12 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="flex flex-wrap justify-center gap-2 md:gap-3 text-xs md:text-sm">
            <span class="text-on-surface-variant font-bold">Juga tersedia di:</span>
            @php $majorCities = app(\App\Services\InternalLinkingService::class)->getMajorCities(); @endphp
            @foreach($majorCities as $mc)
            <a href="{{ $mc['url'] }}" class="text-on-background hover:text-tertiary-fixed-dim underline underline-offset-4">
                {{ $mc['label'] }}
            </a>
            @if(!$loop->last)<span class="text-outline">|</span>@endif
            @endforeach
        </div>
    </div>
</section>
@endsection