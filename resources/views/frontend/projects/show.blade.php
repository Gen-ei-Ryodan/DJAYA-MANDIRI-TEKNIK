@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <a href="{{ route('projects') }}" class="text-tertiary-fixed font-bold text-xs md:text-sm flex items-center gap-2 mb-4 md:mb-6 hover:gap-3 transition-all">
            <span class="material-symbols-outlined text-sm md:text-base">arrow_back</span>Kembali ke Project
        </a>
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">{{ $project->category->name ?? 'Project' }}</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">{{ $project->title }}</h1>
        <div class="flex flex-wrap items-center gap-3 md:gap-4 mt-3 md:mt-4 text-on-primary/60 text-xs md:text-sm">
            @if($project->location)<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">location_on</span>{{ $project->location }}</span>@endif
            @if($project->year)<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">calendar_today</span>{{ $project->year }}</span>@endif
            @if($project->client)<span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">person</span>Client: {{ $project->client }}</span>@endif
        </div>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-4xl mx-auto px-4 md:px-gutter">
        @if($project->thumbnail)
        <div class="rounded-2xl overflow-hidden mb-8 md:mb-12 shadow-lg">
            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full aspect-video object-cover">
        </div>
        @endif

        <div class="text-sm md:text-base text-on-surface-variant leading-relaxed">
            {!! nl2br($project->description) !!}
        </div>

        @if($related->isNotEmpty())
        <div class="border-t border-outline-variant/30 pt-10 md:pt-16 mt-10 md:mt-16">
            <h3 class="text-xl md:text-2xl font-bold text-on-background mb-6 md:mb-8 font-heading">Project Terkait</h3>
            <div class="grid sm:grid-cols-2 gap-4 md:gap-6">
                @foreach($related as $item)
                <a href="{{ route('projects.show', $item->slug) }}" class="group bg-surface-container-lowest overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 block">
                    <div class="aspect-[16/9] overflow-hidden">
                        <img src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : '' }}"
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                             loading="lazy">
                    </div>
                    <div class="p-4 md:p-6">
                        <span class="text-[10px] md:text-xs font-bold text-tertiary-fixed-dim uppercase">{{ $item->category->name ?? '' }}</span>
                        <h4 class="font-bold text-sm md:text-base text-on-background mt-1 font-heading">{{ $item->title }}</h4>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
