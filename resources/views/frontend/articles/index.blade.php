@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter text-center">
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">Informasi</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">{{ $category->name ?? 'Artikel' }}</h1>
        <p class="text-on-primary/60 mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base">Informasi dan tips seputar sistem proteksi petir.</p>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="flex flex-wrap justify-center gap-2 md:gap-3 mb-8 md:mb-12">
            <a href="{{ route('articles') }}"
               class="px-4 md:px-5 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-medium transition-all {{ !isset($category) ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-tertiary-fixed/20' }}">Semua</a>
            @foreach($categories as $cat)
            <a href="{{ route('articles.category', $cat->slug) }}"
               class="px-4 md:px-5 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-medium transition-all {{ isset($category) && $category->id == $cat->id ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-tertiary-fixed/20' }}">{{ $cat->name }}</a>
            @endforeach
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @forelse($articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 block">
                <div class="aspect-[16/10] overflow-hidden">
                    <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : '' }}"
                         alt="{{ $article->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         loading="lazy">
                </div>
                <div class="p-4 md:p-6">
                    <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-2 md:mb-3">
                        <span class="text-[10px] md:text-xs bg-tertiary-fixed/20 text-tertiary-fixed-dim font-bold px-2 md:px-3 py-0.5 md:py-1 rounded-full">{{ $article->category->name ?? 'Artikel' }}</span>
                        <span class="text-on-surface-variant/60 text-[10px] md:text-xs">{{ $article->published_at ? $article->published_at->format('d M Y') : '' }}</span>
                        <span class="text-on-surface-variant/60 text-[10px] md:text-xs">{{ $article->read_time }} min read</span>
                    </div>
                    <h3 class="font-bold text-sm md:text-base text-on-background mb-1 md:mb-2 group-hover:text-tertiary-fixed-dim transition-colors line-clamp-2 font-heading">{{ $article->title }}</h3>
                    <p class="text-on-surface-variant text-xs md:text-sm line-clamp-3">{{ $article->excerpt }}</p>
                </div>
            </a>
            @empty
            <div class="col-span-2 lg:col-span-3 bg-surface-container-lowest p-8 md:p-12 rounded-2xl text-center">
                <p class="text-on-surface-variant text-base md:text-lg">Belum ada artikel.</p>
            </div>
            @endforelse
        </div>
        <div class="mt-8 md:mt-12">{{ $articles->links() }}</div>
    </div>
</section>
@endsection
