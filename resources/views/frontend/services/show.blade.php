@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <a href="{{ route('services') }}" class="text-tertiary-fixed font-bold text-xs md:text-sm flex items-center gap-2 mb-4 md:mb-6 hover:gap-3 transition-all">
            <span class="material-symbols-outlined text-sm md:text-base">arrow_back</span>Kembali ke Layanan
        </a>
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">Layanan</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">{{ $service->title }}</h1>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-4xl mx-auto px-4 md:px-gutter">
        @if($service->image)
        <div class="rounded-2xl overflow-hidden aspect-video mb-8 md:mb-12 shadow-lg">
            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="prose prose-sm md:prose-base max-w-none text-on-surface-variant leading-relaxed">
            {!! nl2br($service->description) !!}
        </div>

        <div class="mt-8 md:mt-12 text-center">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getWhatsApp() ?? '6285704307095') }}"
               target="_blank"
               class="inline-flex items-center gap-2 bg-on-background text-on-primary px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-sm md:text-base hover:bg-on-surface transition-all duration-300 shadow-lg hover:-translate-y-1">
                Konsultasi Sekarang
                <span class="material-symbols-outlined text-lg">whatsapp</span>
            </a>
        </div>
    </div>
</section>
@endsection
