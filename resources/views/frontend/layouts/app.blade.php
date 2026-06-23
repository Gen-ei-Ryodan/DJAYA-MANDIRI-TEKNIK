<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>{{ $seo->meta_title ?? 'DJAYA MANDIRI TEKNIK - Solusi Penangkal Petir Profesional' }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? 'Djaya Mandiri Teknik hadir sebagai mitra terpercaya dalam jasa pemasangan penangkal petir dan penyedia material penangkal petir berkualitas.' }}">
    <meta name="keywords" content="{{ $seo->keywords ?? 'penangkal petir, jasa penangkal petir, material penangkal petir, sistem proteksi petir' }}">
    <meta name="author" content="DJAYA MANDIRI TEKNIK">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seo->og_title ?? $seo->meta_title ?? 'DJAYA MANDIRI TEKNIK' }}">
    <meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description ?? '' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $seo->og_image ?? '' }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="{{ $seo->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $seo->meta_title ?? 'DJAYA MANDIRI TEKNIK' }}">
    <meta name="twitter:description" content="{{ $seo->meta_description ?? '' }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ $settings->getFavicon() }}" type="image/x-icon">

    {{-- Schema.org --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "{{ $settings->getCompanyName() }}",
        "url": "{{ url('/') }}",
        "logo": "{{ $settings->getLogo() }}",
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "{{ $contact->telephone ?? '081393663669' }}",
            "contactType": "customer service",
            "areaServed": "ID"
        },
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Jl. Kedungrejo Timur Gg Satria RT 6 RW 1",
            "addressLocality": "Sidoarjo",
            "addressRegion": "Jawa Timur",
            "addressCountry": "ID"
        }
    }
    </script>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    {{-- Tailwind Config --}}
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-background": "#111c2d",
                        "on-surface": "#111c2d",
                        "on-secondary-fixed-variant": "#3a485c",
                        "secondary-container": "#d5e3fd",
                        "secondary-fixed-dim": "#b9c7e0",
                        "inverse-primary": "#bec6e0",
                        "background": "#f9f9ff",
                        "on-secondary-fixed": "#0d1c2f",
                        "outline": "#76777d",
                        "surface-bright": "#f9f9ff",
                        "inverse-surface": "#263143",
                        "tertiary-container": "#2a1700",
                        "surface-container": "#e7eeff",
                        "on-secondary-container": "#57657b",
                        "on-primary-fixed": "#131b2e",
                        "inverse-on-surface": "#ecf1ff",
                        "on-surface-variant": "#45464d",
                        "surface": "#f9f9ff",
                        "error": "#ba1a1a",
                        "surface-container-highest": "#d8e3fb",
                        "tertiary": "#000000",
                        "surface-tint": "#565e74",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-fixed": "#2a1700",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary-container": "#b87500",
                        "secondary-fixed": "#d5e3fd",
                        "surface-container-low": "#f0f3ff",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-secondary": "#ffffff",
                        "primary-container": "#131b2e",
                        "surface-variant": "#d8e3fb",
                        "secondary": "#515f74",
                        "on-primary-container": "#7c839b",
                        "on-tertiary-fixed-variant": "#653e00",
                        "surface-dim": "#cfdaf2",
                        "on-error-container": "#93000a",
                        "primary-fixed": "#dae2fd",
                        "outline-variant": "#c6c6cd",
                        "on-primary": "#ffffff",
                        "primary": "#000000",
                        "primary-fixed-dim": "#bec6e0",
                        "on-primary-fixed-variant": "#3f465c",
                        "surface-container-high": "#dee8ff",
                        "tertiary-fixed": "#ffddb8",
                        "tertiary-fixed-dim": "#ffb95f"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        "2xl": "20px",
                        full: "9999px"
                    },
                    spacing: {
                        "stack-lg": "32px",
                        "stack-sm": "8px",
                        "container-max": "1280px",
                        "stack-md": "16px",
                        "gutter": "24px",
                        "section-padding": "120px",
                        "margin-mobile": "20px"
                    },
                    fontFamily: {
                        "headline-md": ["Poppins"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Poppins"],
                        "headline-lg-mobile": ["Poppins"],
                        "label-md": ["Inter"],
                        "display-lg": ["Poppins"],
                        "body-md": ["Inter"],
                        "headline-sm": ["Poppins"]
                    },
                    fontSize: {
                        "headline-md": ["32px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "headline-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "1.2", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "display-lg": ["64px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-sm": ["24px", {"lineHeight": "1.4", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .lightning-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(255,221,184,0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Poppins', sans-serif; }
        html { scroll-behavior: smooth; }
    </style>

    @stack('styles')
</head>
<body class="bg-surface text-on-surface font-body-md selection:bg-tertiary-fixed selection:text-on-tertiary-fixed">
    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    {{-- Floating WhatsApp --}}
    <div class="fixed bottom-8 right-8 z-50 flex flex-col gap-4 items-end">
        <div class="bg-on-background text-on-primary px-4 py-2 rounded-lg text-sm font-bold shadow-xl opacity-0 translate-y-2 transition-all duration-300" id="support-label">
            Hubungi Tim Engineering
        </div>
        <a class="bg-[#25D366] text-white rounded-full p-4 shadow-2xl hover:scale-110 active:scale-90 transition-all flex items-center justify-center relative"
           href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getWhatsApp() ?? '6285704307095') }}"
           onmouseout="document.getElementById('support-label').style.opacity='0'; document.getElementById('support-label').style.transform='translateY(10px)'"
           onmouseover="document.getElementById('support-label').style.opacity='1'; document.getElementById('support-label').style.transform='translateY(0)'">
            <span class="absolute inset-0 bg-[#25D366] rounded-full animate-ping opacity-20"></span>
            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    </div>

    <script>
        // Reveal Animations on Scroll
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                }
            }
        }
        window.addEventListener("scroll", reveal);
        document.addEventListener("DOMContentLoaded", reveal);

        // Header transparency shift on scroll
        const header = document.getElementById('navbar');
        if (header) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('h-16', 'bg-on-background/100', 'shadow-md');
                    header.classList.remove('h-20');
                } else {
                    header.classList.add('md:h-20', 'h-16');
                    header.classList.remove('h-16', 'bg-on-background/100');
                }
            });
        }

        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');
        let menuOpen = false;

        function toggleMenu(open) {
            menuOpen = open !== undefined ? open : !menuOpen;
            mobileMenu.classList.toggle('hidden', !menuOpen);
            hamburgerIcon.classList.toggle('opacity-0', menuOpen);
            hamburgerIcon.classList.toggle('scale-0', menuOpen);
            closeIcon.classList.toggle('opacity-0', !menuOpen);
            closeIcon.classList.toggle('scale-0', !menuOpen);
            document.body.style.overflow = menuOpen ? 'hidden' : '';
        }

        menuToggle?.addEventListener('click', (e) => { e.stopPropagation(); toggleMenu(); });
        document.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', () => toggleMenu(false));
        });
        window.addEventListener('resize', () => { if (window.innerWidth >= 1024) toggleMenu(false); });
        document.addEventListener('click', (e) => {
            if (menuOpen && !mobileMenu?.contains(e.target) && !menuToggle?.contains(e.target)) toggleMenu(false);
        });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && menuOpen) toggleMenu(false); });
    </script>

    @stack('scripts')
</body>
</html>
