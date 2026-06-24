<header id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-on-background/95 backdrop-blur-md h-16 md:h-20 transition-all duration-300">
    <div class="flex justify-between items-center w-full px-4 md:px-gutter max-w-container-max mx-auto h-full">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="text-base md:text-headline-sm font-bold text-on-primary tracking-tight truncate max-w-[200px] md:max-w-none">
            {{ $settings->getCompanyName() ?? 'DJAJA MANDIRI TEKNIK' }}
        </a>

        {{-- Desktop Menu --}}
        <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
            <a href="{{ route('home') }}"
               class="text-xs xl:text-label-md pb-1 transition-colors {{ request()->routeIs('home') ? 'text-tertiary-fixed font-bold border-b-2 border-tertiary-fixed' : 'text-on-primary/80 hover:text-on-primary' }}">
               Home
            </a>
            <a href="{{ route('home') }}#tentang"
               class="text-xs xl:text-label-md transition-colors {{ request()->routeIs('home') ? 'text-tertiary-fixed font-bold' : 'text-on-primary/80 hover:text-on-primary' }}">
               Tentang Kami
            </a>
            <a href="{{ route('services') }}"
               class="text-xs xl:text-label-md transition-colors {{ request()->routeIs('services*') ? 'text-tertiary-fixed font-bold' : 'text-on-primary/80 hover:text-on-primary' }}">
               Layanan
            </a>
            <a href="{{ route('products') }}"
               class="text-xs xl:text-label-md transition-colors {{ request()->routeIs('products*') ? 'text-tertiary-fixed font-bold' : 'text-on-primary/80 hover:text-on-primary' }}">
               Produk
            </a>
            <a href="{{ route('projects') }}"
               class="text-xs xl:text-label-md transition-colors {{ request()->routeIs('projects*') ? 'text-tertiary-fixed font-bold' : 'text-on-primary/80 hover:text-on-primary' }}">
               Project
            </a>
            <a href="{{ route('articles') }}"
               class="text-xs xl:text-label-md transition-colors {{ request()->routeIs('articles*') ? 'text-tertiary-fixed font-bold' : 'text-on-primary/80 hover:text-on-primary' }}">
               Artikel
            </a>
            <a href="{{ route('contact') }}"
               class="text-xs xl:text-label-md transition-colors {{ request()->routeIs('contact') ? 'text-tertiary-fixed font-bold' : 'text-on-primary/80 hover:text-on-primary' }}">
               Kontak
            </a>
        </nav>

        {{-- CTA Button --}}
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getWhatsApp() ?? '6285704307095') }}"
           target="_blank"
           class="hidden lg:inline-block bg-tertiary-fixed text-on-tertiary-fixed px-4 xl:px-6 py-2 rounded-lg text-xs xl:text-label-md font-bold hover:scale-105 active:scale-95 transition-all shadow-lg shrink-0">
            Konsultasi Sekarang
        </a>

        {{-- Mobile Menu Button --}}
        <button id="menu-toggle" class="lg:hidden text-on-primary p-2 relative w-10 h-10 focus:outline-none shrink-0" aria-label="Toggle menu">
            <svg id="hamburger-icon" class="w-6 h-6 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="close-icon" class="w-6 h-6 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 scale-0 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-on-background border-t border-outline-variant/20 max-h-[calc(100vh-4rem)] overflow-y-auto">
        <div class="px-4 md:px-gutter py-4 space-y-1">
            <a href="{{ route('home') }}"
               class="block font-medium py-3 px-3 rounded-lg transition-colors mobile-link {{ request()->routeIs('home') ? 'text-tertiary-fixed bg-on-primary/10' : 'text-on-primary/80 hover:bg-on-primary/5' }}">
               Home
            </a>
            <a href="{{ route('home') }}#tentang"
               class="block font-medium py-3 px-3 rounded-lg transition-colors mobile-link text-on-primary/80 hover:bg-on-primary/5">
               Tentang Kami
            </a>
            <a href="{{ route('services') }}"
               class="block font-medium py-3 px-3 rounded-lg transition-colors mobile-link {{ request()->routeIs('services*') ? 'text-tertiary-fixed bg-on-primary/10' : 'text-on-primary/80 hover:bg-on-primary/5' }}">
               Layanan
            </a>
            <a href="{{ route('products') }}"
               class="block font-medium py-3 px-3 rounded-lg transition-colors mobile-link {{ request()->routeIs('products*') ? 'text-tertiary-fixed bg-on-primary/10' : 'text-on-primary/80 hover:bg-on-primary/5' }}">
               Produk
            </a>
            <a href="{{ route('projects') }}"
               class="block font-medium py-3 px-3 rounded-lg transition-colors mobile-link {{ request()->routeIs('projects*') ? 'text-tertiary-fixed bg-on-primary/10' : 'text-on-primary/80 hover:bg-on-primary/5' }}">
               Project
            </a>
            <a href="{{ route('articles') }}"
               class="block font-medium py-3 px-3 rounded-lg transition-colors mobile-link {{ request()->routeIs('articles*') ? 'text-tertiary-fixed bg-on-primary/10' : 'text-on-primary/80 hover:bg-on-primary/5' }}">
               Artikel
            </a>
            <a href="{{ route('contact') }}"
               class="block font-medium py-3 px-3 rounded-lg transition-colors mobile-link {{ request()->routeIs('contact') ? 'text-tertiary-fixed bg-on-primary/10' : 'text-on-primary/80 hover:bg-on-primary/5' }}">
               Kontak
            </a>
            <div class="pt-3">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getWhatsApp() ?? '6285704307095') }}"
                   target="_blank"
                   class="block w-full bg-tertiary-fixed text-on-tertiary-fixed text-center font-bold px-6 py-3 rounded-lg transition-all mobile-link">
                    Konsultasi Sekarang
                </a>
            </div>
        </div>
    </div>
</header>
