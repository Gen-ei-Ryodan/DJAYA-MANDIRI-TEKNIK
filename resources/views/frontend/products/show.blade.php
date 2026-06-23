@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <a href="{{ route('products') }}" class="text-tertiary-fixed font-bold text-xs md:text-sm flex items-center gap-2 mb-4 md:mb-6 hover:gap-3 transition-all">
            <span class="material-symbols-outlined text-sm md:text-base">arrow_back</span>Kembali ke Produk
        </a>
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">{{ $product->category->name ?? 'Produk' }}</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">{{ $product->name }}</h1>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="grid lg:grid-cols-2 gap-8 md:gap-12 mb-12 md:mb-16">
            <div class="rounded-2xl overflow-hidden aspect-square shadow-lg bg-surface-container-low">
                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover">
            </div>
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-on-background mb-4 md:mb-6 font-heading">{{ $product->name }}</h2>
                <div class="text-sm md:text-base text-on-surface-variant leading-relaxed mb-6 md:mb-8">
                    {!! nl2br($product->description) !!}
                </div>
                @if($product->specification)
                <div class="bg-surface-container-low p-4 md:p-6 rounded-xl mb-6 md:mb-8">
                    <h4 class="font-bold text-sm md:text-base text-on-background mb-2 md:mb-3">Spesifikasi</h4>
                    <div class="text-on-surface-variant text-xs md:text-sm">{!! nl2br($product->specification) !!}</div>
                </div>
                @endif
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getWhatsApp() ?? '6285704307095') }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 bg-on-background text-on-primary px-6 md:px-8 py-3 md:py-4 rounded-xl font-bold text-sm md:text-base hover:bg-on-surface transition-all duration-300 shadow-lg hover:-translate-y-1">
                    Ingin Produk Ini?
                    <span class="material-symbols-outlined text-lg">whatsapp</span>
                </a>
            </div>
        </div>

        @if($related->isNotEmpty())
        <div class="border-t border-outline-variant/30 pt-10 md:pt-16">
            <h3 class="text-xl md:text-2xl font-bold text-on-background mb-6 md:mb-8 text-center font-heading">Produk Terkait</h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($related as $item)
                <a href="{{ route('products.show', $item->slug) }}" class="group bg-surface-container-lowest overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 block">
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : '' }}"
                             alt="{{ $item->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                             loading="lazy">
                    </div>
                    <div class="p-3 md:p-4">
                        <h4 class="font-bold text-on-background text-xs md:text-sm font-heading">{{ $item->name }}</h4>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
