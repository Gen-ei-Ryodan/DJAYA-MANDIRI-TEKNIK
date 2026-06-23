<footer class="bg-on-background text-on-primary border-t border-outline-variant/20">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 md:gap-10 px-4 md:px-gutter py-12 md:py-section-padding max-w-container-max mx-auto">
        {{-- About --}}
        <div class="sm:col-span-2 md:col-span-1">
            <a href="{{ route('home') }}" class="font-bold text-base md:text-headline-sm text-on-primary mb-3 md:mb-4 block">
                {{ $settings->getCompanyName() ?? 'DJAYA MANDIRI TEKNIK' }}
            </a>
            <p class="text-sm md:text-body-md text-on-primary/60 mb-6 leading-relaxed">
                &copy; {{ date('Y') }} {{ $settings->getCompanyName() ?? 'DJAYA MANDIRI TEKNIK' }}. All rights reserved. Premium Lightning Protection Systems.
            </p>
            <div class="flex gap-3 md:gap-4">
                <a class="w-9 h-9 md:w-10 md:h-10 rounded-full border border-on-primary/20 flex items-center justify-center hover:bg-tertiary-fixed hover:text-on-tertiary-fixed transition-all" href="#">
                    <span class="material-symbols-outlined text-lg md:text-xl">public</span>
                </a>
                <a class="w-9 h-9 md:w-10 md:h-10 rounded-full border border-on-primary/20 flex items-center justify-center hover:bg-tertiary-fixed hover:text-on-tertiary-fixed transition-all" href="#">
                    <span class="material-symbols-outlined text-lg md:text-xl">share</span>
                </a>
                <a class="w-9 h-9 md:w-10 md:h-10 rounded-full border border-on-primary/20 flex items-center justify-center hover:bg-tertiary-fixed hover:text-on-tertiary-fixed transition-all" href="#">
                    <span class="material-symbols-outlined text-lg md:text-xl">thumb_up</span>
                </a>
            </div>
        </div>

        {{-- Navigation --}}
        <div>
            <h4 class="font-bold text-base md:text-lg mb-4 md:mb-6">Navigasi</h4>
            <ul class="space-y-2 md:space-y-3 text-sm md:text-label-md">
                <li><a href="{{ route('home') }}" class="text-on-primary/60 hover:text-on-primary transition-colors">Home</a></li>
                <li><a href="{{ route('home') }}#tentang" class="text-on-primary/60 hover:text-on-primary transition-colors">Tentang Kami</a></li>
                <li><a href="{{ route('services') }}" class="text-on-primary/60 hover:text-on-primary transition-colors">Layanan</a></li>
                <li><a href="{{ route('products') }}" class="text-on-primary/60 hover:text-on-primary transition-colors">Produk</a></li>
            </ul>
        </div>

        {{-- Quick Links --}}
        <div>
            <h4 class="font-bold text-base md:text-lg mb-4 md:mb-6">Quick Links</h4>
            <ul class="space-y-2 md:space-y-3 text-sm md:text-label-md">
                <li><a href="{{ route('projects') }}" class="text-on-primary/60 hover:text-on-primary transition-colors">Project</a></li>
                <li><a href="{{ route('articles') }}" class="text-on-primary/60 hover:text-on-primary transition-colors">Artikel</a></li>
                <li><a href="{{ route('home') }}#kontak" class="text-on-primary/60 hover:text-on-primary transition-colors">Kontak</a></li>
                <li><a href="{{ route('contact') }}" class="text-on-primary/60 hover:text-on-primary transition-colors">Hubungi Kami</a></li>
            </ul>
        </div>

        {{-- Legal --}}
        <div>
            <h4 class="font-bold text-base md:text-lg mb-4 md:mb-6">Legal</h4>
            <ul class="space-y-2 md:space-y-3 text-sm md:text-label-md">
                <li><a href="#" class="text-on-primary/60 hover:text-on-primary transition-colors">Kebijakan Privasi</a></li>
                <li><a href="#" class="text-on-primary/60 hover:text-on-primary transition-colors">Syarat &amp; Ketentuan</a></li>
                <li class="pt-3 md:pt-4 flex items-center gap-2 text-tertiary-fixed text-sm md:text-base">
                    <span class="material-symbols-outlined">security</span>
                    Protected by DMT Safety Standard
                </li>
            </ul>
        </div>
    </div>
</footer>
