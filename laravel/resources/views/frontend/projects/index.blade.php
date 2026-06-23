@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter text-center">
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">Portfolio</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">{{ $category->name ?? 'Project Kami' }}</h1>
        <p class="text-on-primary/60 mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base">Hasil pengerjaan instalasi penangkal petir oleh tim profesional kami.</p>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="flex flex-wrap justify-center gap-2 md:gap-3 mb-8 md:mb-12">
            <a href="{{ route('projects') }}"
               class="px-4 md:px-5 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-medium transition-all {{ !isset($category) ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-tertiary-fixed/20' }}">Semua</a>
            @foreach($categories as $cat)
            <a href="{{ route('projects.category', $cat->slug) }}"
               class="px-4 md:px-5 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-medium transition-all {{ isset($category) && $category->id == $cat->id ? 'bg-tertiary-fixed text-on-tertiary-fixed' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-tertiary-fixed/20' }}">{{ $cat->name }}</a>
            @endforeach
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @forelse($projects as $project)
            <a href="{{ route('projects.show', $project->slug) }}" class="group relative overflow-hidden rounded-2xl aspect-[4/3] block">
                <img src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : '' }}"
                     alt="{{ $project->title }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                     loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-on-background/90 via-on-background/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="absolute bottom-0 left-0 right-0 p-4 md:p-6 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                    <span class="text-tertiary-fixed font-bold text-[10px] md:text-xs uppercase">{{ $project->category->name ?? '' }}</span>
                    <h4 class="text-on-primary font-bold text-sm md:text-lg mt-1 font-heading">{{ $project->title }}</h4>
                    <div class="flex items-center gap-3 md:gap-4 mt-1 md:mt-2 text-on-primary/60 text-[10px] md:text-xs">
                        @if($project->location)<span>{{ $project->location }}</span>@endif
                        @if($project->year)<span>{{ $project->year }}</span>@endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-2 lg:col-span-3 bg-surface-container-lowest p-8 md:p-12 rounded-2xl text-center">
                <p class="text-on-surface-variant text-base md:text-lg">Belum ada project yang ditambahkan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8 md:mt-12">{{ $projects->links() }}</div>
    </div>
</section>
@endsection
