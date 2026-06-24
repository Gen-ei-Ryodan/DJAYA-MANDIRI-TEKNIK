@extends('frontend.layouts.app')

@section('content')
<section class="bg-on-background py-16 md:py-24 lg:py-32">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter text-center">
        <span class="text-tertiary-fixed font-bold text-xs md:text-sm uppercase tracking-widest">Hubungi Kami</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-on-primary mt-3 md:mt-4 font-heading">Kontak</h1>
        <p class="text-on-primary/60 mt-3 md:mt-4 max-w-2xl mx-auto text-sm md:text-base">Siap membantu kebutuhan proteksi petir Anda.</p>
    </div>
</section>

<section class="py-12 md:py-20 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="grid lg:grid-cols-2 gap-8 md:gap-16">
            <div class="space-y-6 md:space-y-8">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-on-background text-tertiary-fixed rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-on-background font-heading">Alamat</h4>
                        <p class="text-on-surface-variant text-sm mt-1">{{ $contact->address ?? 'Jl. Kedungrejo Timur Gg Satria RT 6 RW 1, Kec. Waru, Kab. Sidoarjo' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-on-background text-tertiary-fixed rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl">call</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-on-background font-heading">Telepon / WhatsApp</h4>
                        <p class="text-on-surface-variant text-sm mt-1">WA: {{ $contact->whatsapp ?? '085704307095' }}<br>Telp: {{ $contact->telephone ?? '081393663669' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-on-background text-tertiary-fixed rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl">mail</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-on-background font-heading">Email</h4>
                        <p class="text-on-surface-variant text-sm mt-1">{{ $contact->email ?? 'info@djajamandiriteknik.com' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-on-background text-tertiary-fixed rounded-xl flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-xl">schedule</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-on-background font-heading">Jam Operasional</h4>
                        <p class="text-on-surface-variant text-sm mt-1">Senin - Sabtu, 08.00 - 17.00 WIB</p>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden h-48 md:h-64 shadow-lg border border-outline-variant/30">
                    <img class="w-full h-full object-cover"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhMbK5sYtLFzjbMEIMvCx49pwnmEQ0uBdxbtjHrtWMpIt8Cuw42XRV0pz72oqMhYR7oahUgldYLddjJJeShfeVTl2NhX1d8o3vVIPAv8ls9CLGqro2u6CAYF8b-CGnhG-ZceMDHdxj_BePEmzc0vcuzwoVWSIQGXQjGl9McibW6talK-HxzBrKIAobOvLYRvVUi8bX1UP-45xGzx1dgR6sFVNhdlzW49nCIQEUMGwO7eeLCJpBcWyFT-K6VgEU33XnW-u1CrL3fFM"
                         alt="Map">
                </div>
            </div>

            <div>
                <div class="bg-surface-container-low p-6 md:p-10 rounded-2xl shadow-xl">
                    <h3 class="text-lg md:text-xl font-bold text-on-background mb-4 md:mb-6 font-heading">Kirim Pesan</h3>
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-background mb-1">Nama Lengkap *</label>
                                <input type="text" name="name" required
                                       class="w-full rounded-lg border-outline-variant bg-surface px-4 py-3 text-sm focus:ring-2 focus:ring-on-background/20 focus:border-on-background transition-all"
                                       placeholder="Nama Anda">
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-background mb-1">Nomor WhatsApp</label>
                                <input type="tel" name="phone"
                                       class="w-full rounded-lg border-outline-variant bg-surface px-4 py-3 text-sm focus:ring-2 focus:ring-on-background/20 focus:border-on-background transition-all"
                                       placeholder="0812...">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs md:text-sm font-bold text-on-background mb-1">Email</label>
                            <input type="email" name="email"
                                   class="w-full rounded-lg border-outline-variant bg-surface px-4 py-3 text-sm focus:ring-2 focus:ring-on-background/20 focus:border-on-background transition-all"
                                   placeholder="email@example.com">
                        </div>
                        <div>
                            <label class="block text-xs md:text-sm font-bold text-on-background mb-1">Pesan *</label>
                            <textarea name="message" required rows="4"
                                      class="w-full rounded-lg border-outline-variant bg-surface px-4 py-3 text-sm focus:ring-2 focus:ring-on-background/20 focus:border-on-background transition-all resize-none"
                                      placeholder="Jelaskan kebutuhan proteksi petir Anda..."></textarea>
                        </div>
                        <button type="submit"
                                class="w-full bg-on-background text-on-primary py-3 md:py-4 rounded-xl font-bold text-sm md:text-base hover:bg-on-surface transition-all duration-300 shadow-lg hover:-translate-y-1">
                            Kirim via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@if($contact->google_maps ?? false)
<section class="pb-12 md:pb-20 bg-surface">
    <div class="max-w-container-max mx-auto px-4 md:px-gutter">
        <div class="rounded-2xl overflow-hidden h-48 md:h-96">{!! $contact->google_maps !!}</div>
    </div>
</section>
@endif
@endsection
