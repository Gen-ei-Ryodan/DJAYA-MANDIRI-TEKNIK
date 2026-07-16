@php
    $linkingService = app(\App\Services\InternalLinkingService::class);
    $cities = $cities ?? $linkingService->getCityLinks();
    $title = $title ?? 'Layanan Penangkal Petir di Seluruh Jawa Timur';
    $excludeSlug = $excludeSlug ?? null;
    $limit = $limit ?? null;
    $gridCols = $gridCols ?? 'grid-cols-2 md:grid-cols-3 lg:grid-cols-4';
    $showCount = $showCount ?? false;
@endphp

@if($excludeSlug || $limit)
    @php $cities = $cities->where('slug', '!=', $excludeSlug)->take($limit ?? 999); @endphp
@endif

@if($cities->isNotEmpty())
<section class="py-12 md:py-20 {{ $sectionClass ?? 'bg-surface-container-low' }}">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="text-center mb-8 md:mb-12 reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Area Layanan</span>
            <h2 class="text-xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">{{ $title }}</h2>
            @if(isset($subtitle))
            <p class="text-sm md:text-body-md text-on-surface-variant mt-2 max-w-2xl mx-auto">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="grid {{ $gridCols }} gap-3 md:gap-4 reveal">
            @foreach($cities as $city)
            <a href="{{ $city['url'] }}"
               class="bg-surface-container-lowest p-3 md:p-5 rounded-xl border border-outline-variant/20 hover:bg-on-background hover:text-on-primary hover:border-tertiary-fixed/30 group transition-all duration-300 text-center">
                <span class="block font-bold text-xs md:text-sm group-hover:text-tertiary-fixed transition-colors">{{ $city['label'] }}</span>
                @if($showCount && isset($city['count']))
                <span class="text-[10px] md:text-xs text-on-surface-variant group-hover:text-on-primary/60">{{ $city['count'] }} project</span>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif