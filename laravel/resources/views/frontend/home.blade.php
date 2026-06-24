@extends('frontend.layouts.app')

@section('content')
{{-- ==================== HERO SECTION ==================== --}}
<section class="relative overflow-hidden bg-on-background">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-on-background/70 z-10"></div>
        <img class="w-full h-full object-cover"
             src="{{ optional($hero)->background_image ? asset('storage/' . optional($hero)->background_image) : '' }}"
             alt="Hero Background">
    </div>

    <div class="relative z-20 w-full px-4 md:px-gutter max-w-container-max mx-auto text-on-primary py-20 md:py-28 lg:py-36">
        <div class="max-w-2xl lg:max-w-3xl reveal active">
            <h1 class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl mb-3 md:mb-5 leading-tight font-bold" style="font-family: Poppins">
                {{ optional($hero)->title ?? 'Solusi Penangkal Petir Profesional untuk Perlindungan Bangunan Anda' }}
            </h1>
            <p class="text-sm sm:text-base lg:text-lg text-on-primary/90 mb-5 md:mb-7 max-w-xl lg:max-w-2xl leading-relaxed">
                {{ optional($hero)->description ?? 'Djaja Mandiri Teknik hadir sebagai mitra terpercaya dalam jasa pemasangan penangkal petir dan penyedia material penangkal petir berkualitas.' }}
            </p>

            {{-- Badge Tags --}}
            <div class="flex flex-wrap gap-2 md:gap-3 mb-6 md:mb-10 items-center">
                <span class="px-3 md:px-4 py-1 bg-tertiary-fixed/20 border border-tertiary-fixed/30 rounded-full text-xs md:text-sm font-medium">Perlindungan Maksimal</span>
                <span class="px-3 md:px-4 py-1 bg-tertiary-fixed/20 border border-tertiary-fixed/30 rounded-full text-xs md:text-sm font-medium">Pengerjaan Profesional</span>
                <span class="px-3 md:px-4 py-1 bg-tertiary-fixed/20 border border-tertiary-fixed/30 rounded-full text-xs md:text-sm font-medium">Hasil Terpercaya</span>
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4">
                <a href="{{ optional($hero)->button1_url ?? '#kontak' }}"
                   class="bg-tertiary-fixed text-on-tertiary-fixed px-6 md:px-8 py-3 md:py-4 rounded-lg font-bold text-sm md:text-lg hover:bg-tertiary-fixed-dim transition-colors shadow-xl text-center">
                    {{ optional($hero)->button1_text ?? 'Konsultasi Sekarang' }}
                </a>
                <a href="{{ optional($hero)->button2_url ?? route('projects') }}"
                   class="border-2 border-on-primary text-on-primary px-6 md:px-8 py-3 md:py-4 rounded-lg font-bold text-sm md:text-lg hover:bg-on-primary hover:text-on-background transition-all text-center">
                    {{ optional($hero)->button2_text ?? 'Lihat Project' }}
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ==================== STATS ==================== --}}
<section class="relative z-10 -mt-10 md:-mt-16">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @php $stats = optional($hero)->statistics ?? []; @endphp
            @forelse($stats as $stat)
            <div class="bg-surface-container-lowest p-4 md:p-8 rounded-xl md:rounded-2xl shadow-lg flex items-center gap-4">
                <div class="w-10 h-10 md:w-14 md:h-14 bg-secondary-container flex items-center justify-center rounded-full text-secondary shrink-0">
                    <span class="material-symbols-outlined text-xl md:text-3xl">{{ $stat['icon'] ?? 'task_alt' }}</span>
                </div>
                <div>
                    <div class="font-bold text-lg md:text-3xl text-on-background counter" data-target="{{ preg_replace('/[^0-9]/', '', $stat['value']) }}">{{ $stat['value'] }}</div>
                    <div class="text-sm md:text-base text-on-surface-variant">{{ $stat['label'] }}</div>
                </div>
            </div>
            @empty
            @foreach([
                ['icon' => 'task_alt', 'val' => '500+', 'label' => 'Project Selesai'],
                ['icon' => 'sentiment_satisfied', 'val' => '350+', 'label' => 'Pelanggan Puas'],
                ['icon' => 'verified', 'val' => '100%', 'label' => 'Material Berkualitas'],
                ['icon' => 'support_agent', 'val' => '24/7', 'label' => 'Dukungan Profesional'],
            ] as $s)
            <div class="bg-surface-container-lowest p-4 md:p-8 rounded-xl md:rounded-2xl shadow-lg flex items-center gap-4">
                <div class="w-10 h-10 md:w-14 md:h-14 bg-secondary-container flex items-center justify-center rounded-full text-secondary shrink-0">
                    <span class="material-symbols-outlined text-xl md:text-3xl">{{ $s['icon'] }}</span>
                </div>
                <div>
                    <div class="font-bold text-lg md:text-3xl text-on-background">{{ $s['val'] }}</div>
                    <div class="text-sm md:text-base text-on-surface-variant">{{ $s['label'] }}</div>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ==================== TENTANG KAMI ==================== --}}
<section class="py-16 md:py-section-padding bg-surface" id="tentang">
    <div class="max-w-container-max mx-auto px-gutter grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-16 items-center">
        <div class="relative reveal">
            <div class="absolute -top-4 md:-top-6 -left-4 md:-left-6 w-20 md:w-32 h-20 md:h-32 bg-secondary-container rounded-2xl -z-10"></div>
            <div class="rounded-2xl overflow-hidden shadow-2xl">
                <img class="w-full h-full object-cover aspect-square"
                     src="{{ is_array(optional($about)->company_images) && isset(optional($about)->company_images[0]) && optional($about)->company_images[0] ? asset('storage/' . optional($about)->company_images[0]) : '' }}"
                     alt="Tentang Djaja Mandiri Teknik">
            </div>
            <div class="absolute -bottom-6 md:-bottom-10 -right-4 md:-right-10 bg-on-background p-4 md:p-8 rounded-xl md:rounded-2xl text-on-primary shadow-2xl hidden md:block">
                <div class="text-2xl md:text-4xl font-bold text-tertiary-fixed mb-1">10+ Thn</div>
                <div class="text-xs md:text-sm opacity-80">Pengalaman Industri</div>
            </div>
        </div>
        <div class="reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-3 md:mb-4 block text-xs md:text-sm">Tentang Kami</span>
            <h2 class="text-2xl md:text-headline-md text-on-background mb-4 md:mb-6 font-bold" style="font-family: Poppins">Tentang Djaja Mandiri Teknik</h2>
            <p class="text-sm md:text-body-md text-on-surface-variant mb-6 md:mb-8 leading-relaxed">
                {{ $about->description ?? 'Kami adalah perusahaan spesialis dalam bidang sistem proteksi petir (lightning protection system) yang berlokasi di Sidoarjo, Jawa Timur.' }}
            </p>
            <div class="space-y-3 md:space-y-4">
                <div class="p-3 md:p-4 bg-surface-container-low rounded-xl flex items-start gap-3 md:gap-4 hover:shadow-md transition-shadow">
                    <span class="material-symbols-outlined text-tertiary-fixed-dim bg-on-background rounded-full p-1.5 md:p-2 shrink-0">bolt</span>
                    <div>
                        <h4 class="font-bold text-sm md:text-base text-on-background">Visi Kami</h4>
                        <p class="text-xs md:text-sm text-on-surface-variant">{{ $about->vision ?? 'Menjadi pemimpin pasar dalam industri sistem proteksi petir yang terintegrasi di Indonesia.' }}</p>
                    </div>
                </div>
                <div class="p-3 md:p-4 bg-surface-container-low rounded-xl flex items-start gap-3 md:gap-4 hover:shadow-md transition-shadow">
                    <span class="material-symbols-outlined text-tertiary-fixed-dim bg-on-background rounded-full p-1.5 md:p-2 shrink-0">check_circle</span>
                    <div>
                        <h4 class="font-bold text-sm md:text-base text-on-background">Misi Kami</h4>
                        <ul class="text-xs md:text-sm text-on-surface-variant grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-1 mt-2">
                            @foreach($about->missions ?? ['Standar Internasional', 'Kepuasan Pelanggan', 'Inovasi Teknologi', 'Keamanan Maksimal', 'Integritas Kerja'] as $mission)
                            <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-tertiary-fixed-dim rounded-full shrink-0"></span> {{ $mission }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ==================== LAYANAN KAMI ==================== --}}
<section class="py-16 md:py-section-padding bg-surface-container-low" id="layanan">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="text-center mb-10 md:mb-16 reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Our Expertise</span>
            <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Layanan Unggulan Kami</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            @forelse($services as $service)
            <div class="group relative overflow-hidden rounded-2xl bg-surface-container-lowest shadow-lg hover:shadow-2xl transition-all duration-500 reveal">
                <div class="h-48 md:h-64 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                         src="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                         alt="{{ $service->title }}">
                </div>
                <div class="p-6 md:p-10">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-on-background text-tertiary-fixed rounded-xl md:rounded-2xl flex items-center justify-center mb-4 md:mb-6 shadow-lg -translate-y-1/2 mt-[-3.5rem] md:mt-[-5rem] relative z-10">
                        {!! $service->icon ?? '<span class="material-symbols-outlined text-2xl md:text-4xl">construction</span>' !!}
                    </div>
                    <h3 class="text-lg md:text-headline-sm mb-3 md:mb-4 text-on-background font-bold" style="font-family: Poppins">{{ $service->title }}</h3>
                    <p class="text-sm md:text-base text-on-surface-variant mb-4 md:mb-6 leading-relaxed">{{ Str::limit($service->description, 150) }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-on-background font-bold gap-2 group/btn text-sm md:text-base">
                        Pelajari Selengkapnya
                        <span class="material-symbols-outlined group-hover/btn:translate-x-2 transition-transform">arrow_forward</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center py-8 md:py-12 text-on-surface-variant reveal">
                Belum ada layanan yang ditambahkan.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ==================== MENGAPA MEMILIH KAMI ==================== --}}
<section class="py-16 md:py-section-padding bg-surface">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="text-center mb-10 md:mb-16 reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Why Us</span>
            <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Mengapa Memilih Djaja Mandiri Teknik?</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8 reveal">
            @forelse($whyChooseUs as $item)
            <div class="p-5 md:p-8 border border-outline-variant/30 rounded-xl md:rounded-2xl hover:bg-on-background group transition-all duration-300">
                {!! $item->icon !!}
                <h4 class="font-bold text-base md:text-lg mb-2 mt-3 md:mt-4 group-hover:text-on-primary">{{ $item->title }}</h4>
                <p class="text-on-surface-variant text-xs md:text-sm group-hover:text-on-primary/70">{{ $item->description }}</p>
            </div>
            @empty
            @php
            $defaultWhy = [
                ['icon' => '<span class="material-symbols-outlined text-3xl md:text-4xl text-on-secondary-container mb-3 md:mb-4 group-hover:text-tertiary-fixed">engineering</span>', 'title' => 'Pengerjaan Profesional', 'desc' => 'Teknisi ahli yang sudah tersertifikasi dan berpengalaman bertahun-tahun di lapangan.'],
                ['icon' => '<span class="material-symbols-outlined text-3xl md:text-4xl text-on-secondary-container mb-3 md:mb-4 group-hover:text-tertiary-fixed">workspace_premium</span>', 'title' => 'Material Berkualitas', 'desc' => 'Hanya menggunakan material dengan standar SNI dan Internasional untuk durabilitas maksimal.'],
                ['icon' => '<span class="material-symbols-outlined text-3xl md:text-4xl text-on-secondary-container mb-3 md:mb-4 group-hover:text-tertiary-fixed">architecture</span>', 'title' => 'Solusi Sesuai Kebutuhan', 'desc' => 'Setiap bangunan unik, kami merancang sistem proteksi yang paling optimal untuk struktur Anda.'],
                ['icon' => '<span class="material-symbols-outlined text-3xl md:text-4xl text-on-secondary-container mb-3 md:mb-4 group-hover:text-tertiary-fixed">speed</span>', 'title' => 'Pelayanan Responsif', 'desc' => 'Tim admin dan teknis kami siap memberikan respon cepat untuk setiap kebutuhan Anda.'],
                ['icon' => '<span class="material-symbols-outlined text-3xl md:text-4xl text-on-secondary-container mb-3 md:mb-4 group-hover:text-tertiary-fixed">payments</span>', 'title' => 'Harga Kompetitif', 'desc' => 'Penawaran harga transparan dan terbaik untuk kualitas material dan pengerjaan premium.'],
                ['icon' => '<span class="material-symbols-outlined text-3xl md:text-4xl text-on-secondary-container mb-3 md:mb-4 group-hover:text-tertiary-fixed">contact_support</span>', 'title' => 'Konsultasi Gratis', 'desc' => 'Hubungi kami kapan saja untuk konsultasi awal mengenai kebutuhan proteksi petir Anda.'],
            ];
            @endphp
            @foreach($defaultWhy as $w)
            <div class="p-5 md:p-8 border border-outline-variant/30 rounded-xl md:rounded-2xl hover:bg-on-background group transition-all duration-300">
                {!! $w['icon'] !!}
                <h4 class="font-bold text-base md:text-lg mb-2 mt-3 md:mt-4 group-hover:text-on-primary">{{ $w['title'] }}</h4>
                <p class="text-on-surface-variant text-xs md:text-sm group-hover:text-on-primary/70">{{ $w['desc'] }}</p>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- ==================== PRODUK UNGGULAN ==================== --}}
<section class="py-16 md:py-section-padding bg-surface-container-low" id="produk">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 md:mb-16 reveal gap-4">
            <div>
                <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Premium Products</span>
                <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Produk Unggulan</h2>
            </div>
            <a href="{{ route('products') }}" class="bg-on-background text-on-primary px-5 md:px-6 py-2.5 md:py-3 rounded-lg font-bold text-sm md:text-base hover:bg-on-surface transition-colors shrink-0">
                Lihat Semua Produk
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8 reveal">
            @forelse($products->take(3) as $product)
            <a href="{{ route('products.show', $product->slug) }}" class="bg-surface-container-lowest p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md border border-transparent hover:border-tertiary-fixed transition-all group block">
                <div class="aspect-square rounded-xl overflow-hidden mb-4 md:mb-6 bg-surface-container-low flex items-center justify-center p-4 md:p-8">
                    <img class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500"
                         src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                         alt="{{ $product->name }}">
                </div>
                <span class="text-[10px] md:text-xs font-bold text-on-tertiary-container bg-tertiary-fixed/20 px-2 py-0.5 md:px-2 md:py-1 rounded mb-2 md:mb-4 inline-block">
                    {{ $product->category->name ?? 'PRODUK' }}
                </span>
                <h4 class="text-base md:text-lg mb-1 md:mb-2 text-on-background font-bold" style="font-family: Poppins">{{ $product->name }}</h4>
                <p class="text-xs md:text-sm text-on-surface-variant mb-4 md:mb-6 line-clamp-2">{{ $product->description }}</p>
                <div class="flex justify-between items-center">
                    <span class="font-bold text-sm md:text-base text-on-background">Lihat Detail</span>
                    <span class="w-8 h-8 md:w-10 md:h-10 bg-on-background text-on-primary rounded-full flex items-center justify-center hover:bg-tertiary-fixed hover:text-on-tertiary-fixed transition-colors">
                        <span class="material-symbols-outlined text-lg md:text-xl">shopping_cart</span>
                    </span>
                </div>
            </a>
            @empty
            @for($i = 1; $i <= 3; $i++)
            <div class="bg-surface-container-lowest p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md border border-transparent hover:border-tertiary-fixed transition-all group">
                <div class="aspect-square rounded-xl overflow-hidden mb-4 md:mb-6 bg-surface-container-low flex items-center justify-center p-4 md:p-8">
                    <span class="material-symbols-outlined text-4xl md:text-6xl text-on-surface-variant/30">image</span>
                </div>
                <h4 class="text-base md:text-lg mb-2 text-on-background font-bold" style="font-family: Poppins">Produk Unggulan {{ $i }}</h4>
                <p class="text-xs md:text-sm text-on-surface-variant mb-4 md:mb-6">Material penangkal petir berkualitas tinggi.</p>
            </div>
            @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- ==================== PROJECT TERBARU ==================== --}}
<section class="py-16 md:py-section-padding bg-surface" id="project">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="text-center mb-10 md:mb-16 reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Portfolio</span>
            <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Project Terbaru Kami</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 reveal">
            @forelse($projects->take(4) as $index => $project)
            @php
                $colSpan = $index == 0 ? 'md:col-span-2' : ($index == 3 ? 'md:col-span-2' : '');
            @endphp
            <a href="{{ route('projects.show', $project->slug) }}" class="{{ $colSpan }} group relative overflow-hidden rounded-xl md:rounded-2xl h-64 md:h-[400px] block">
                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                     src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : '' }}"
                     alt="{{ $project->title }}">
                <div class="absolute inset-0 bg-gradient-to-t from-on-background/80 to-transparent flex items-end p-4 md:p-8">
                    <div>
                        <span class="text-tertiary-fixed font-bold text-[10px] md:text-xs">{{ strtoupper($project->category->name ?? 'PROJECT') }}</span>
                        <h4 class="text-on-primary font-bold text-lg md:text-2xl mt-1">{{ $project->title }}</h4>
                    </div>
                </div>
            </a>
            @empty
            @for($i = 0; $i < 4; $i++)
            @php
                $colSpan = $i == 0 ? 'md:col-span-2' : ($i == 3 ? 'md:col-span-2' : '');
            @endphp
            <div class="{{ $colSpan }} group relative overflow-hidden rounded-xl md:rounded-2xl h-64 md:h-[400px]">
                <div class="w-full h-full bg-surface-container-low flex items-center justify-center">
                    <span class="material-symbols-outlined text-4xl md:text-6xl text-on-surface-variant/30">image</span>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-on-background/80 to-transparent flex items-end p-4 md:p-8">
                    <div>
                        <span class="text-tertiary-fixed font-bold text-[10px] md:text-xs">PROJECT</span>
                        <h4 class="text-on-primary font-bold text-lg md:text-2xl mt-1">Project Kami</h4>
                    </div>
                </div>
            </div>
            @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- ==================== ARTIKEL TERBARU ==================== --}}
<section class="py-16 md:py-section-padding bg-surface-container-low" id="artikel">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="text-center mb-10 md:mb-16 reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Blog &amp; News</span>
            <h2 class="text-2xl md:text-headline-md text-on-background font-bold" style="font-family: Poppins">Artikel Terbaru</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-8 reveal">
            @forelse($articles->take(3) as $article)
            <article class="bg-surface-container-lowest rounded-xl md:rounded-2xl overflow-hidden shadow-md group hover:shadow-xl transition-shadow">
                <div class="h-40 md:h-48 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                         src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : '' }}"
                         alt="{{ $article->title }}">
                </div>
                <div class="p-4 md:p-6">
                    <time class="text-[10px] md:text-xs text-on-surface-variant font-bold">{{ $article->published_at ? strtoupper($article->published_at->format('d F Y')) : '' }}</time>
                    <h4 class="font-bold text-sm md:text-lg mt-1 md:mt-2 mb-2 md:mb-3 leading-snug group-hover:text-on-secondary-container transition-colors">{{ $article->title }}</h4>
                    <p class="text-xs md:text-sm text-on-surface-variant line-clamp-3 mb-3 md:mb-4">{{ $article->excerpt }}</p>
                    <a href="{{ route('articles.show', $article->slug) }}" class="text-on-background font-bold text-xs md:text-sm inline-flex items-center gap-2">
                        Baca Selengkapnya
                        <span class="material-symbols-outlined text-xs md:text-sm">open_in_new</span>
                    </a>
                </div>
            </article>
            @empty
            @for($i = 1; $i <= 3; $i++)
            <article class="bg-surface-container-lowest rounded-xl md:rounded-2xl overflow-hidden shadow-md group hover:shadow-xl transition-shadow">
                <div class="h-40 md:h-48 overflow-hidden bg-surface-container-low flex items-center justify-center">
                    <span class="material-symbols-outlined text-4xl md:text-6xl text-on-surface-variant/30">image</span>
                </div>
                <div class="p-4 md:p-6">
                    <time class="text-[10px] md:text-xs text-on-surface-variant font-bold">ARTIKEL</time>
                    <h4 class="font-bold text-sm md:text-lg mt-1 md:mt-2 mb-2 md:mb-3">Judul Artikel {{ $i }}</h4>
                    <p class="text-xs md:text-sm text-on-surface-variant line-clamp-3 mb-3 md:mb-4">Deskripsi artikel akan ditampilkan di sini.</p>
                </div>
            </article>
            @endfor
            @endforelse
        </div>
    </div>
</section>

{{-- ==================== CTA SECTION ==================== --}}
<section class="py-16 md:py-24 bg-[#0F172A] relative overflow-hidden lightning-pattern">
    <div class="absolute top-0 right-0 w-48 md:w-96 h-48 md:h-96 bg-tertiary-fixed/10 blur-[60px] md:blur-[100px] rounded-full"></div>
    <div class="max-w-container-max mx-auto px-gutter text-center relative z-10 reveal">
        <h2 class="text-xl md:text-headline-md text-on-primary mb-4 md:mb-6 font-bold" style="font-family: Poppins">
            Lindungi Bangunan Anda dari Risiko Sambaran Petir
        </h2>
        <p class="text-sm md:text-lg text-on-primary/70 mb-6 md:mb-10 max-w-2xl mx-auto">
            Keamanan aset dan keselamatan orang di dalamnya adalah prioritas. Konsultasikan sistem proteksi petir Anda hari ini bersama pakarnya.
        </p>
        <a href="#kontak"
           class="bg-tertiary-fixed text-on-tertiary-fixed px-8 md:px-10 py-3 md:py-4 rounded-xl font-bold text-base md:text-xl hover:scale-105 active:scale-95 transition-all shadow-[0_10px_40px_rgba(255,221,184,0.3)] inline-block">
            Hubungi Kami Sekarang
        </a>
    </div>
</section>

{{-- ==================== KONTAK ==================== --}}
<section class="py-16 md:py-section-padding bg-surface" id="kontak">
    <div class="max-w-container-max mx-auto px-gutter grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-16">
        {{-- Info --}}
        <div class="reveal">
            <span class="text-on-tertiary-container font-label-md tracking-widest uppercase mb-2 md:mb-4 block text-xs md:text-sm">Get In Touch</span>
            <h2 class="text-2xl md:text-headline-md text-on-background mb-6 md:mb-8 font-bold" style="font-family: Poppins">Informasi Kontak</h2>

            <div class="space-y-5 md:space-y-8 mb-8 md:mb-12">
                <div class="flex items-start gap-3 md:gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-on-background text-tertiary-fixed rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-lg md:text-xl">location_on</span>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-sm md:text-base text-on-background">Alamat Kantor</h4>
                        <p class="text-xs md:text-sm text-on-surface-variant">{{ $contact->address ?? 'Jl. Kedungrejo Timur Gg Satria, Waru, Sidoarjo, Jawa Timur' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 md:gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-on-background text-tertiary-fixed rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-lg md:text-xl">call</span>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-sm md:text-base text-on-background">Telepon / WhatsApp</h4>
                        <p class="text-xs md:text-sm text-on-surface-variant">{{ $contact->whatsapp ?? '0857-0430-7095' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 md:gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-on-background text-tertiary-fixed rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-lg md:text-xl">mail</span>
                    </div>
                    <div class="min-w-0">
                        <h4 class="font-bold text-sm md:text-base text-on-background">Email Bisnis</h4>
                        <p class="text-xs md:text-sm text-on-surface-variant">{{ $contact->email ?? 'info@djajamandiriteknik.com' }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl overflow-hidden h-48 md:h-64 grayscale hover:grayscale-0 transition-all duration-500 shadow-lg border border-outline-variant/30">
                <iframe class="w-full h-full"
                        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1610.5909132894062!2d112.72667508131664!3d-7.353249709321018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sJl.%20Kedungrejo%20Timur%20Gg%20Satria%20RT%206%20RW%201%2C%20Kec.%20Waru%2C%20Kab.%20Sidoarjo!5e0!3m2!1sid!2sid!4v1782274670426!5m2!1sid!2sid"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>
        </div>

        {{-- Contact Form --}}
        <div class="reveal">
            <div class="bg-surface-container-low p-6 md:p-10 rounded-xl md:rounded-2xl shadow-xl">
                <h3 class="text-lg md:text-headline-sm mb-4 md:mb-6 text-on-background font-bold" style="font-family: Poppins">Kirim Pesan</h3>
                <form action="{{ route('contact.send') }}" method="POST" class="space-y-3 md:space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                        <div class="space-y-1">
                            <label class="text-xs md:text-sm font-bold text-on-background">Nama Lengkap</label>
                            <input name="name" type="text" required
                                   class="w-full rounded-lg border-outline-variant bg-surface px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base focus:ring-on-background focus:border-on-background"
                                   placeholder="Nama Anda">
                        </div>
                        <div class="space-y-1">
                            <label class="text-xs md:text-sm font-bold text-on-background">Nomor WhatsApp</label>
                            <input name="phone" type="tel"
                                   class="w-full rounded-lg border-outline-variant bg-surface px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base focus:ring-on-background focus:border-on-background"
                                   placeholder="0812...">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs md:text-sm font-bold text-on-background">Alamat Email</label>
                        <input name="email" type="email"
                               class="w-full rounded-lg border-outline-variant bg-surface px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base focus:ring-on-background focus:border-on-background"
                               placeholder="email@example.com">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs md:text-sm font-bold text-on-background">Detail Pesan</label>
                        <textarea name="message" required rows="4"
                                  class="w-full rounded-lg border-outline-variant bg-surface px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base focus:ring-on-background focus:border-on-background resize-none"
                                  placeholder="Jelaskan kebutuhan proteksi petir Anda..."></textarea>
                    </div>
                    <button type="submit"
                            class="w-full bg-on-background text-on-primary py-3 md:py-4 rounded-lg font-bold text-sm md:text-base hover:bg-on-surface transition-colors">
                        Kirim via WhatsApp
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Google Maps --}}
@if($contact->google_maps ?? false)
<section class="pb-16 md:pb-section-padding bg-surface">
    <div class="max-w-container-max mx-auto px-gutter">
        <div class="rounded-2xl overflow-hidden h-48 md:h-96 grayscale hover:grayscale-0 transition-all duration-500">
            {!! $contact->google_maps !!}
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
    // Counter animation for stats
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.dataset.target);
        if (isNaN(target)) return;
        const suffix = counter.textContent.replace(/[0-9]/g, '').trim() || '';
        let current = 0;
        const increment = Math.ceil(target / 60);
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) { current = target; clearInterval(timer); }
            counter.textContent = current + suffix;
        }, 30);
    });
</script>
@endpush
