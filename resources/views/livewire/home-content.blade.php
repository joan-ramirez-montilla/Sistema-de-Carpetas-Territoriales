<div>
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
        font-family: 'Inter', sans-serif;
    ">

        {{-- HERO ELEGANTE --}}
        <section class="relative pt-12 pb-20 md:pt-16 md:pb-32 overflow-hidden">
            {{-- Fondo con gradiente sutil --}}
            <div class="absolute inset-0 bg-gradient-to-b from-gray-50 to-white"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                {{-- Encabezado minimalista --}}
                <div class="flex justify-between items-center mb-12 md:mb-16">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full" style="background: var(--color-primary);"></div>
                        <span class="text-xl font-semibold tracking-tight">{{ $companySetting->name }}</span>
                    </div>
                </div>

                {{-- Hero principal --}}
                <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center">
                    <div>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight"
                            style="font-family: 'Playfair Display', serif;">
                            {{ $companySetting->name }}
                        </h1>

                        <p class="text-lg text-gray-600 mb-8 leading-relaxed max-w-xl">
                            {{ $companySetting->seo_description }}
                        </p>

                        {{-- CTA único --}}
                        <button
                            class="px-8 py-3.5 rounded-full font-medium transition-all duration-300
                                   hover:shadow-lg transform hover:-translate-y-0.5"
                            style="background: var(--color-primary); color: var(--color-light);">
                            Reservar cita ahora
                        </button>
                    </div>

                    {{-- Imagen con marco elegante --}}
                    <div class="relative">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-gray-100 to-gray-200 rounded-3xl
                                transform rotate-1">
                        </div>
                        <img src="https://www.blackwhitebarber.es/images/barberia-vigo.jpg"
                            class="relative rounded-2xl shadow-2xl object-cover w-full h-[400px]" alt="Barbería">
                    </div>
                </div>
            </div>
        </section>

        {{-- EQUIPO ELEGANTE --}}
        <section class="py-20 md:py-28 bg-white px-6">
            <div class="max-w-6xl mx-auto"> {{-- Encabezado con línea decorativa --}} <div class="relative mb-16">
                    <div class="absolute left-0 top-1/2 w-12 h-0.5" style="background: var(--color-primary);"></div>
                    <h2 class="text-3xl md:text-4xl font-bold ml-16" style="font-family: 'Playfair Display', serif;">
                        Nuestro <span style="color: var(--color-primary);">Equipo</span> de Expertos </h2>
                    <p class="text-gray-500 ml-16 mt-2">Profesionales certificados con años de experiencia</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
                    @foreach ($employees as $employee)
                        <div class="group cursor-pointer"
                            wire:click="$dispatch('openEmployeeModal', { employeeId: {{ $employee->id }} })">
                            <div
                                class="relative overflow-hidden rounded-2xl mb-4 transition-all duration-500 group-hover:shadow-xl">
                                @if ($employee->user->photo_path)
                                    <img src="{{ asset('storage/' . $employee->user->photo_path) }}"
                                        alt="{{ $employee->user->name }}"
                                        class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <div class="relative h-64 rounded-2xl mb-4 overflow-hidden transition-all duration-500 group-hover:shadow-xl"
                                        style="background: linear-gradient(135deg, #1f2937 0%, #111827 100%);">
                                        <div class="absolute inset-0 flex items-center justify-center"> <span
                                                class="text-6xl font-bold text-white/90 tracking-widest">
                                                {{ strtoupper(substr($employee->user->name, 0, 2)) }} </span> </div>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-lg mb-1">{{ $employee->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $employee->status }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> {{-- Componente Livewire del Modal --}} <livewire:employee-modal />
        </section>

        {{-- HORARIO ELEGANTE --}}
        <section class="py-20 md:py-28 px-6" style="background: var(--color-light);">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">
                        Horario de <span style="color: var(--color-primary);">Atención</span>
                    </h2>
                    <p class="text-gray-500 max-w-2xl mx-auto">
                        Planifica tu visita con nuestro horario extendido
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-8 md:p-10 border border-gray-100">
                    <div class="grid gap-3">
                        @foreach ($daysOrder as $day)
                            @php
                                $data = $companySetting->schedule[$day] ?? null;
                            @endphp

                            @if ($data)
                                <div
                                    class="flex items-center justify-between py-4 px-4 rounded-lg hover:bg-gray-50
                                        transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full flex items-center justify-center
                                                {{ $data['active'] ? 'bg-green-50' : 'bg-gray-100' }}">
                                            @if ($data['active'])
                                                <i class="fas fa-clock text-sm"
                                                    style="color: var(--color-primary);"></i>
                                            @else
                                                <i class="fas fa-times text-gray-400 text-sm"></i>
                                            @endif
                                        </div>
                                        <span
                                            class="font-medium {{ !$data['active'] ? 'text-gray-400' : 'text-gray-800' }}">
                                            {{ $day }}
                                        </span>
                                    </div>

                                    @if ($data['active'])
                                        <div class="text-right">
                                            <span class="font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $data['start'])->format('g:i A') }}
                                                –
                                                {{ \Carbon\Carbon::createFromFormat('H:i', $data['end'])->format('g:i A') }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">Cerrado</span>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Nota al pie --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <p class="text-sm text-gray-500 flex items-center gap-2">
                            <i class="fas fa-info-circle" style="color: var(--color-primary);"></i>
                            Reservas recomendadas, especialmente viernes y sábado
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- UBICACIÓN ELEGANTE --}}
        <section class="py-20 md:py-28 px-6 bg-white">
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center">
                    {{-- Texto informativo --}}
                    <div>
                        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full bg-gray-100">
                            <i class="fas fa-map-marker-alt" style="color: var(--color-primary);"></i>
                            <span class="text-sm font-medium">Nuestra ubicación</span>
                        </div>

                        <h2 class="text-3xl md:text-4xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">
                            Encuéntranos <span style="color: var(--color-primary);">Fácilmente</span>
                        </h2>

                        <p class="text-gray-600 mb-8 leading-relaxed">
                            {{ $companySetting->location_description }}
                        </p>

                        {{-- Información de contacto --}}
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center"
                                    style="background: var(--color-primary); color: var(--color-light);">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-500 mb-1">Teléfono</p>
                                    <a href="tel:{{ $companySetting->phone }}"
                                        class="text-xl font-semibold hover:underline"
                                        style="color: var(--color-primary);">
                                        {{ $companySetting->phone }}
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center"
                                    style="background: var(--color-primary); color: var(--color-light);">
                                    <i class="fas fa-map"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-500 mb-1">Dirección</p>
                                    <p class="text-gray-800">{{ $companySetting->address }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Botón mapa --}}
                        <div class="mt-8">
                            <a href="{{ $companySetting->map_url }}" target="_blank" rel="noopener"
                                class="inline-flex items-center gap-3 px-6 py-3.5 rounded-full font-medium
                                  transition-all duration-300 hover:shadow-lg"
                                style="background: var(--color-primary); color: var(--color-light);">
                                <i class="fas fa-directions"></i>
                                Abrir en Google Maps
                            </a>
                        </div>
                    </div>

                    {{-- Mapa elegante --}}
                    <div class="relative">
                        <div
                            class="absolute -inset-4 bg-gradient-to-br from-gray-100 to-gray-200
                                rounded-3xl transform -rotate-2">
                        </div>
                        <div class="relative rounded-2xl overflow-hidden shadow-xl">
                            <iframe class="w-full h-96 border-0" src="{{ $companySetting->map_url }}" loading="lazy"
                                style="filter: grayscale(20%);">
                            </iframe>
                            <div
                                class="absolute top-4 right-4 px-4 py-2 rounded-full bg-white/90
                                    backdrop-blur-sm shadow-sm">
                                <span class="text-sm font-medium" style="color: var(--color-primary);">
                                    <i class="fas fa-map-pin mr-1"></i> Ubicación
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FOOTER ELEGANTE --}}
        <footer class="py-16 px-6" style="background: var(--color-secondary); color: var(--color-light);">
            <div class="max-w-6xl mx-auto">
                {{-- Grid principal --}}
                <div class="grid md:grid-cols-3 gap-10 pb-12 border-b border-white/10">
                    {{-- Logo y nombre --}}
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center"
                                style="background: var(--color-primary);">
                                <i class="fas fa-cut"></i>
                            </div>
                            <span class="text-2xl font-bold">{{ $companySetting->name }}</span>
                        </div>
                        <p class="text-gray-400 text-sm max-w-xs">
                            {{ $companySetting->seo_keywords }}
                        </p>
                    </div>

                    {{-- Redes sociales --}}
                    <div>
                        <h3 class="font-semibold mb-6 text-lg">Síguenos</h3>
                        <div class="flex gap-4">
                            @if ($companySetting->whatsapp)
                                <a href="{{ $companySetting->whatsapp }}"
                                    class="w-10 h-10 rounded-full flex items-center justify-center
                                      transition-all duration-300 hover:scale-110"
                                    style="background: var(--color-primary);">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            @endif

                            @if ($companySetting->instagram)
                                <a href="{{ $companySetting->instagram }}"
                                    class="w-10 h-10 rounded-full flex items-center justify-center
                                      bg-gradient-to-br from-purple-600 to-pink-600
                                      transition-all duration-300 hover:scale-110">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if ($companySetting->facebook)
                                <a href="{{ $companySetting->facebook }}"
                                    class="w-10 h-10 rounded-full flex items-center justify-center
                                      bg-blue-600 transition-all duration-300 hover:scale-110">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif

                            @if ($companySetting->twitter)
                                <a href="{{ $companySetting->twitter }}"
                                    class="w-10 h-10 rounded-full flex items-center justify-center
                                      bg-blue-400 transition-all duration-300 hover:scale-110">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Información de contacto --}}
                    <div class="text-right">
                        <h3 class="font-semibold mb-6 text-lg">Contacto</h3>
                        <p class="text-gray-300">
                            <a href="tel:{{ $companySetting->phone }}" class="hover:text-[var(--color-primary)]">
                                {{ $companySetting->phone }}
                            </a>
                        </p>
                        <p class="text-gray-300 mt-2">{{ $companySetting->address }}</p>
                    </div>
                </div>

                {{-- Copyright --}}
                <div class="pt-8 text-center">
                    <p class="text-gray-500 text-sm">
                        © {{ date('Y') }} {{ $companySetting->name }}. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </footer>

        {{-- BOTÓN FLOTANTE DE RESERVA CON TEXTO FIJO --}}
        <div class="fixed bottom-6 right-6 z-50">
            <div class="relative flex flex-col items-center">
                {{-- Label fijo que siempre está visible --}}
                <div
                    class="relative mb-3 bg-[var(--color-primary)] text-[var(--color-light)]
                    px-4 py-2 rounded-lg shadow-lg whitespace-nowrap animate-pulse-slow">
                    <div class="text-sm font-bold">¡RESERVAR AHORA!</div>
                    {{-- Flecha triangular que apunta al botón --}}
                    <div
                        class="absolute -bottom-1 left-1/2 transform -translate-x-1/2
                        w-3 h-3 bg-[var(--color-primary)] rotate-45">
                    </div>
                </div>

                {{-- Botón principal --}}
                <button
                    class="w-14 h-14 md:w-16 md:h-16 rounded-full flex items-center justify-center
                       shadow-2xl transition-all duration-300 hover:scale-110
                       group"
                    style="background: var(--color-primary); color: var(--color-light);
                       box-shadow: 0 8px 25px -5px rgba(0, 0, 0, 0.3);">
                    <i class="fas fa-calendar-alt text-xl md:text-2xl group-hover:scale-110 transition-transform"></i>
                </button>
            </div>
        </div>
    </div>



</div>
