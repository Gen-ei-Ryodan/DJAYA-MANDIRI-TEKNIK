<nav class="flex items-center gap-1 md:gap-2 text-xs md:text-sm text-on-primary/60 mb-3 md:mb-4" aria-label="Breadcrumb">
    <a href="{{ route('home') }}" class="hover:text-tertiary-fixed transition-colors">Beranda</a>
    @foreach($crumbs as $crumb)
    <span class="material-symbols-outlined text-sm md:text-base">chevron_right</span>
    @if(isset($crumb['url']))
    <a href="{{ $crumb['url'] }}" class="hover:text-tertiary-fixed transition-colors">{{ $crumb['label'] }}</a>
    @else
    <span class="text-on-primary/40 truncate max-w-[200px]">{{ $crumb['label'] }}</span>
    @endif
    @endforeach
</nav>