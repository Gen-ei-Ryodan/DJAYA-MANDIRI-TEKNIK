@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter text-center">
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">Produk</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">{{ $category->name ?? 'Produk Kami' }}</h1>
        <p class="text-on-primary/60 mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base">
            Material penangkal petir berkualitas standar nasional dan internasional.
        </p>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        {{-- Categories Filter --}}
        <div class="flex flex-wrap justify-center gap-2 md:gap-3 mb-8 md:mb-12">
            <a href="{{ route('products') }}"
               class="px-4 md:px-5 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-medium transition-all {{ !isset($category) ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-tertiary-fixed/20' }}">
                Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('products.category', $cat->slug) }}"
               class="px-4 md:px-5 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-medium transition-all {{ isset($category) && $category->id == $cat->id ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-tertiary-fixed/20' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @forelse($products as $product)
            <a href="{{ route('products.show', $product->slug) }}" class="group bg-surface-container-lowest overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 block">
                <div class="aspect-square overflow-hidden">
                    <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         loading="lazy">
                </div>
                <div class="p-3 md:p-6">
                    <span class="text-[10px] md:text-xs font-bold text-tertiary-fixed-dim uppercase">{{ $product->category->name ?? 'PRODUK' }}</span>
                    <h3 class="font-bold text-xs md:text-base text-on-background mt-1 md:mt-2 mb-1 md:mb-2 font-heading">{{ $product->name }}</h3>
                    <p class="text-on-surface-variant text-[10px] md:text-sm line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-2 lg:col-span-3 bg-surface-container-lowest p-8 md:p-12 rounded-2xl text-center">
                <p class="text-on-surface-variant text-base md:text-lg">Belum ada produk yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8 md:mt-12">
            {{ $products->links() }}
        </div>
    </div>
</section>
@endsection
