@php
    $primaryColor = $companySetting->primary_color;
    $secondaryColor = $companySetting->secondary_color;
    $lightColor = '#ffffff';

    $daysOrder = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

@endphp

<div
    style="
        --color-primary: {{ $primaryColor }};
        --color-secondary: {{ $secondaryColor }};
        --color-light: {{ $lightColor }};
    ">
    {{-- HERO --}}
    <section
        class="relative h-[60vh] flex items-center justify-center text-[var(--color-light)] px-6
               bg-[var(--color-secondary)] bg-[url('https://images.unsplash.com/photo-1560066984-138dadb4c035')]
               bg-cover bg-center">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-[var(--color-secondary)]/80"></div>

        <div class="relative text-center max-w-xl flex flex-col items-center gap-8 z-10">

            @if ($companySetting->logo)
                <img src="{{ asset('storage/logos/' . $companySetting->logo) }}" class="w-30 h-30 rounded-full"
                    alt="">
            @endif

            <h1 class="text-4xl md:text-5xl font-bold tracking-wide">
                {{ $companySetting->name }}<span class="text-[var(--color-primary)]">.</span>
            </h1>

            <p class="text-gray-300 text-lg">
                {{ $companySetting->seo_description }}
            </p>

            <button
                class="px-10 py-4 rounded-full bg-[var(--color-primary)] text-[var(--color-secondary)]
                       font-semibold text-lg hover:opacity-90 transition cursor-pointer">
                Reservar
            </button>
        </div>
    </section>

    {{-- HORARIO --}}
    <section class="py-20 bg-[var(--color-light)] text-center px-6">
        <h2 class="text-3xl font-bold mb-8">
            Horario de <span class="text-[var(--color-primary)]">Atención</span>
        </h2>

        <div class="max-w-md mx-auto space-y-4 text-gray-700">
            @foreach ($daysOrder as $day)
                @php
                    $data = $companySetting->schedule[$day] ?? null;
                @endphp

                @if ($data)
                    <div class="flex justify-between {{ !$data['active'] ? 'text-gray-400' : '' }}">
                        <span>{{ $day }}</span>

                        @if ($data['active'])
                            <span class="font-semibold">
                                {{ \Carbon\Carbon::createFromFormat('H:i', $data['start'])->format('g:i A') }}
                                –
                                {{ \Carbon\Carbon::createFromFormat('H:i', $data['end'])->format('g:i A') }}
                            </span>
                        @else
                            <span>Cerrado</span>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- UBICACIÓN --}}
    <section class="py-20 bg-gray-100 px-6">
        <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-10 items-center">

            <div>
                <h2 class="text-3xl font-bold mb-4">
                    Ubicación
                </h2>
                <p class="text-gray-600 mb-6">
                   {{ $companySetting->location_description }}
                </p>


                <a href="{{ $companySetting->map_url }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-[var(--color-primary)] text-[var(--color-secondary)] font-semibold hover:opacity-90 transition cursor-pointer mb-8  cursor-pointer">

                    <i class="fas fa-map-marker-alt"></i>
                    Ver ubicación en Google Maps
                </a>

                <p class="text-lg font-semibold">
                    Teléfono:<br>
                    <a href="tel:{{ $companySetting->phone }}" class="text-[var(--color-primary)]">
                        {{ $companySetting->phone }}
                    </a>
                </p>
            </div>

            <div class="rounded-2xl overflow-hidden shadow-lg">
                <iframe class="w-full h-80 border-0" src="{{ $companySetting->map_url }}" loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-[var(--color-secondary)] text-[var(--color-light)] py-16 px-6">
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-10 items-center">

            <div class="text-center md:text-left">
                <h3 class="text-2xl font-bold">
                    {{ $companySetting->name }}<span class="text-[var(--color-primary)]">.</span>
                </h3>
                <p class="text-gray-400 mt-2 text-sm">
                    {{ $companySetting->seo_keywords }}
                </p>
            </div>

            <div class="flex justify-center gap-6 text-xl">
                @if ($companySetting->whatsapp)
                    <a href="{{ $companySetting->whatsapp }}" class="hover:text-[var(--color-primary)] transition">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                @endif

                @if ($companySetting->instagram)
                    <a href="{{ $companySetting->instagram }}" class="hover:text-[var(--color-primary)] transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                @endif

                @if ($companySetting->facebook)
                    <a href="{{ $companySetting->facebook }}" class="hover:text-[var(--color-primary)] transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                @endif

                @if ($companySetting->twitter)
                    <a href="{{ $companySetting->twitter }}" class="hover:text-[var(--color-primary)] transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                @endif
            </div>

            <div class="text-center md:text-right">
                <button
                    class="px-8 py-3 bg-[var(--color-primary)] text-[var(--color-secondary)]
           font-semibold rounded-full hover:opacity-90 transition cursor-pointer">
                    Reservar cita
                </button>

            </div>
        </div>

        <div class="mt-12 text-center text-gray-500 text-sm">
            © {{ date('Y') }} Todos los derechos reservados.
        </div>
    </footer>

</div>
