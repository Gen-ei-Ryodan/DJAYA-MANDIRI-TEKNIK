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
@php
    $images = [];
    if ($project->thumbnail) {
        $images[] = $project->thumbnail;
    }
    if ($project->gallery && is_array($project->gallery)) {
        foreach ($project->gallery as $img) {
            if ($img && $img !== $project->thumbnail) {
                $images[] = $img;
            }
        }
    }
@endphp

@if(!empty($images))
<div id="project-carousel" class="rounded-2xl overflow-hidden mb-8 md:mb-12 shadow-lg bg-surface-container-low">
    <div class="relative w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[550px] overflow-hidden">
        <div class="carousel-track h-full">
            @foreach($images as $index => $img)
            <div class="carousel-slide absolute inset-0 flex items-center justify-center p-4 {{ $index === 0 ? 'active' : '' }}"
                 style="opacity: {{ $index === 0 ? '1' : '0' }}; z-index: {{ $index === 0 ? '1' : '0' }};"
                 data-index="{{ $index }}">
                <img src="{{ asset('storage/' . $img) }}"
                     alt="{{ $project->title }} - {{ $index + 1 }}"
                     class="max-w-full max-h-full w-auto h-auto object-contain rounded-xl">
            </div>
            @endforeach
        </div>

        @if(count($images) > 1)
        <div class="absolute inset-0 flex items-center justify-between px-2 md:px-4 pointer-events-none z-10">
            <button class="carousel-prev pointer-events-auto w-10 h-10 md:w-12 md:h-12 rounded-full bg-on-background/60 text-on-primary flex items-center justify-center hover:bg-on-background/80 transition-all backdrop-blur-sm shadow-lg">
                <span class="material-symbols-outlined text-xl md:text-2xl">chevron_left</span>
            </button>
            <button class="carousel-next pointer-events-auto w-10 h-10 md:w-12 md:h-12 rounded-full bg-on-background/60 text-on-primary flex items-center justify-center hover:bg-on-background/80 transition-all backdrop-blur-sm shadow-lg">
                <span class="material-symbols-outlined text-xl md:text-2xl">chevron_right</span>
            </button>
        </div>

        <div class="absolute bottom-3 md:bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
            @foreach($images as $index => $img)
            <button class="carousel-dot h-2 md:h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-tertiary-fixed w-6 md:w-8' : 'bg-on-primary/50 w-2 md:w-3' }}"
                    data-index="{{ $index }}">
            </button>
            @endforeach
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('project-carousel');
        if (!carousel) return;

        const slides = carousel.querySelectorAll('.carousel-slide');
        const dots = carousel.querySelectorAll('.carousel-dot');
        const prevBtn = carousel.querySelector('.carousel-prev');
        const nextBtn = carousel.querySelector('.carousel-next');
        let currentIndex = 0;
        let interval;

        function showSlide(index) {
            slides.forEach((s, i) => {
                s.classList.toggle('active', i === index);
                s.style.opacity = i === index ? '1' : '0';
                s.style.zIndex = i === index ? '1' : '0';
            });
            dots.forEach((d, i) => {
                if (i === index) {
                    d.className = 'carousel-dot bg-tertiary-fixed w-6 md:w-8 h-2 md:h-3 rounded-full transition-all duration-300';
                } else {
                    d.className = 'carousel-dot bg-on-primary/50 w-2 md:w-3 h-2 md:h-3 rounded-full transition-all duration-300';
                }
            });
            currentIndex = index;
        }

        function nextSlide() {
            showSlide((currentIndex + 1) % slides.length);
            resetAutoplay();
        }

        function prevSlide() {
            showSlide((currentIndex - 1 + slides.length) % slides.length);
            resetAutoplay();
        }

        function goToSlide(index) {
            showSlide(index);
            resetAutoplay();
        }

        function startAutoplay() {
            interval = setInterval(function() {
                showSlide((currentIndex + 1) % slides.length);
            }, 5000);
        }

        function resetAutoplay() {
            clearInterval(interval);
            startAutoplay();
        }

        // Event listeners
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                goToSlide(parseInt(this.dataset.index));
            });
        });

        // Initialize
        showSlide(0);
        if (slides.length > 1) startAutoplay();
    });
</script>
@elseif($project->thumbnail)
<div class="rounded-2xl overflow-hidden mb-8 md:mb-12 shadow-lg bg-surface-container-low flex items-center justify-center h-[300px] sm:h-[400px] md:h-[500px]">
    <img src="{{ asset('storage/' . $project->thumbnail) }}"
         alt="{{ $project->title }}"
         class="max-w-full max-h-full w-auto h-auto object-contain p-4">
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
