@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter text-center">
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">Layanan</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">Layanan Kami</h1>
        <p class="text-on-primary/60 mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base">
            Solusi lengkap sistem proteksi petir untuk bangunan Anda.
        </p>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="grid md:grid-cols-2 gap-6 md:gap-8">
            @forelse($services as $service)
            <a href="{{ route('services.show', $service->slug) }}" class="group bg-surface-container-lowest overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 block">
                <div class="aspect-[16/10] overflow-hidden">
                    <img src="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                         alt="{{ $service->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         loading="lazy">
                </div>
                <div class="p-5 md:p-8">
                    <div class="w-10 h-10 md:w-14 md:h-14 bg-on-background text-tertiary-fixed rounded-xl md:rounded-2xl flex items-center justify-center mb-3 md:mb-4">
                        {!! $service->icon ?? '<span class="material-symbols-outlined text-2xl md:text-3xl">construction</span>' !!}
                    </div>
                    <h3 class="font-bold text-base md:text-xl text-on-background mb-2 md:mb-3 font-heading">{{ $service->title }}</h3>
                    <p class="text-on-surface-variant text-xs md:text-sm line-clamp-3 mb-3 md:mb-4 leading-relaxed">{{ $service->description }}</p>
                    <span class="text-tertiary-fixed-dim font-bold text-xs md:text-sm inline-flex items-center gap-2 group-hover:gap-3 transition-all">
                        Selengkapnya
                        <span class="material-symbols-outlined text-sm md:text-base">arrow_forward</span>
                    </span>
                </div>
            </a>
            @empty
            <div class="col-span-2 bg-surface-container-lowest p-8 md:p-12 rounded-2xl text-center">
                <p class="text-on-surface-variant text-base md:text-lg">Belum ada layanan yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
