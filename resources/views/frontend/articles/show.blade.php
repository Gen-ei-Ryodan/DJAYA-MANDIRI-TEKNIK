@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-4xl mx-auto px-4 md:px-gutter">
        <a href="{{ route('articles') }}" class="text-tertiary-fixed font-bold text-xs md:text-sm flex items-center gap-2 mb-4 md:mb-6 hover:gap-3 transition-all">
            <span class="material-symbols-outlined text-sm md:text-base">arrow_back</span>Kembali ke Artikel
        </a>
        <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-3 md:mb-4">
            <span class="text-[10px] md:text-xs bg-tertiary-fixed/20 text-tertiary-fixed font-bold px-2 md:px-3 py-0.5 md:py-1 rounded-full">{{ $article->category->name ?? 'Artikel' }}</span>
            <span class="text-on-primary/60 text-xs md:text-sm">{{ $article->published_at ? $article->published_at->format('d M Y') : '' }}</span>
            <span class="text-on-primary/60 text-xs md:text-sm">{{ $article->read_time }} min read</span>
        </div>
        <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold text-on-primary font-heading">{{ $article->title }}</h1>

        @if($article->tags)
        <div class="flex flex-wrap gap-1.5 md:gap-2 mt-4 md:mt-6">
            @foreach($article->tags as $tag)
            <span class="text-[10px] md:text-xs text-on-primary/60 bg-on-primary/10 px-2 md:px-3 py-0.5 md:py-1 rounded-full">#{{ $tag }}</span>
            @endforeach
        </div>
        @endif
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-4xl mx-auto px-4 md:px-gutter">
        @if($article->thumbnail)
        <div class="rounded-2xl overflow-hidden mb-8 md:mb-12 shadow-lg">
            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="w-full aspect-video object-cover">
        </div>
        @endif
        <div class="prose prose-sm md:prose-base max-w-none text-on-surface-variant">{!! $article->content !!}</div>

        @if($latest->isNotEmpty())
        <div class="border-t border-outline-variant/30 pt-8 md:pt-12 mt-10 md:mt-16">
            <h3 class="text-xl md:text-2xl font-bold text-on-background mb-6 md:mb-8 font-heading">Artikel Terbaru</h3>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                @foreach($latest as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="group bg-surface-container-lowest overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 block">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : '' }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                    </div>
                    <div class="p-3 md:p-4">
                        <h4 class="font-bold text-xs md:text-sm text-on-background line-clamp-2 font-heading">{{ $item->title }}</h4>
                        <p class="text-on-surface-variant/60 text-[10px] md:text-xs mt-1">{{ $item->published_at ? $item->published_at->format('d M Y') : '' }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
