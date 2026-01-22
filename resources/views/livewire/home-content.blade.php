<div>
    @php
        $primaryColor = $companySetting->primary_color;
        $secondaryColor = $companySetting->secondary_color;
        $lightColor = '#ffffff';

        $daysOrder = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    @endphp

    <style>
        :root {
            --color-primary: {{ $primaryColor }};
            --color-secondary: {{ $secondaryColor }};
            --color-light: {{ $lightColor }};
        }

        /* Animaciones mejoradas */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        .animate-pulse-slow {
            animation: pulse-slow 2s infinite ease-in-out;
        }

        /* Estilos profesionales */
        .professional-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }

        .professional-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .section-container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Tipografía profesional */
        .heading-serif {
            font-family: 'Playfair Display', Georgia, serif;
            font-weight: 700;
            line-height: 1.2;
        }

        .heading-sans {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            font-weight: 600;
            line-height: 1.3;
        }

        .body-text {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
        }

        /* Botones profesionales */
        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-light);
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .btn-primary:hover {
            background-color: var(--color-primary);
            filter: brightness(0.9);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-secondary {
            background-color: var(--color-secondary);
            color: var(--color-light);
            transition: all 0.3s ease;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .btn-secondary:hover {
            background-color: var(--color-secondary);
            filter: brightness(0.9);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        /* Líneas decorativas */
        .decorative-line {
            height: 3px;
            width: 60px;
            background: linear-gradient(90deg, var(--color-primary), transparent);
        }

        /* Efecto overlay profesional */
        .image-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));
        }

        /* Tarjetas de equipo con efecto de elevación */
        .team-member-card {
            border-radius: 12px;
            overflow: hidden;
            position: relative;
        }

        .team-member-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            z-index: 10;
        }
    </style>

    <div class="font-sans bg-gray-50">
        <!-- NAVEGACIÓN PROFESIONAL RESPONSIVE -->
        <nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm">
            <div class="section-container px-4 sm:px-6 h-16 flex items-center justify-between">
                <!-- Logo y nombre -->
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg flex items-center justify-center flex-shrink-0"
                        style="background: var(--color-primary);">
                        <i class="fas fa-cut text-white text-sm sm:text-base"></i>
                    </div>
                    <div class="hidden sm:block">
                        <span
                            class="text-lg sm:text-xl font-bold heading-sans text-gray-900">{{ $companySetting->name }}</span>
                        <p class="text-xs text-gray-500 hidden md:block">Barbería Profesional</p>
                    </div>
                    <div class="sm:hidden">
                        <span
                            class="text-base font-bold heading-sans text-gray-900">{{ Str::limit($companySetting->name, 15) }}</span>
                    </div>
                </div>

                <!-- Menú para desktop -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#horario" class="text-sm text-gray-700 hover:text-gray-900 font-medium transition-colors">
                        Horarios
                    </a>
                    <a href="#equipo" class="text-sm text-gray-700 hover:text-gray-900 font-medium transition-colors">
                        Equipo
                    </a>
                    <a href="#ubicacion"
                        class="text-sm text-gray-700 hover:text-gray-900 font-medium transition-colors">
                        Ubicación
                    </a>
                    <a href="{{ route('appointments.create') }}"
                        class="btn-primary px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg text-sm font-medium">
                        Reservar Cita
                    </a>
                </div>

                <!-- Menú móvil: botón hamburguesa y CTA -->
                <div class="flex items-center space-x-2 md:hidden">
                    <!-- Botón reservar móvil -->
                    <a href="{{ route('appointments.create') }}"
                        class="btn-primary px-3 py-1.5 rounded-lg text-xs font-medium whitespace-nowrap">
                        Reservar
                    </a>

                    <!-- Botón hamburguesa -->
                    <button id="mobile-menu-button" class="p-2 text-gray-700 hover:text-gray-900">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Menú móvil desplegable -->
            <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200 shadow-lg hidden">
                <div class="px-4 py-3 space-y-1">
                    <a href="#horario"
                        class="block py-3 px-3 text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                        <i class="fas fa-clock mr-3 text-gray-400"></i> Horarios
                    </a>
                    <a href="#equipo"
                        class="block py-3 px-3 text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                        <i class="fas fa-users mr-3 text-gray-400"></i> Equipo
                    </a>
                    <a href="#ubicacion"
                        class="block py-3 px-3 text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                        <i class="fas fa-map-marker-alt mr-3 text-gray-400"></i> Ubicación
                    </a>
                    <a href="{{ route('appointments.create') }}"
                        class="block py-3 px-3 text-gray-700 hover:text-gray-900 hover:bg-gray-50 rounded-lg font-medium transition-colors">
                        <i class="fas fa-calendar-check mr-3 text-gray-400"></i> Reservar Cita
                    </a>
                </div>
            </div>
        </nav>

        <!-- Script para menú móvil -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenu = document.getElementById('mobile-menu');

                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                        // Cambiar ícono
                        const icon = mobileMenuButton.querySelector('i');
                        if (mobileMenu.classList.contains('hidden')) {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        } else {
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-times');
                        }
                    });

                    // Cerrar menú al hacer clic en un enlace
                    mobileMenu.querySelectorAll('a').forEach(link => {
                        link.addEventListener('click', function() {
                            mobileMenu.classList.add('hidden');
                            const icon = mobileMenuButton.querySelector('i');
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        });
                    });

                    // Cerrar menú al hacer clic fuera
                    document.addEventListener('click', function(event) {
                        if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                            mobileMenu.classList.add('hidden');
                            const icon = mobileMenuButton.querySelector('i');
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    });
                }
            });
        </script>

        <!-- HERO SECTION CON IMAGEN DE FONDO PROFESIONAL -->
        <section class="relative min-h-screen flex items-center pt-16 overflow-hidden">
            <!-- Fondo con imagen -->
            <div class="absolute inset-0 z-0">
                @if ($companySetting->featured_image)
                    <img src="{{ asset('storage/' . $companySetting->featured_image) }}"
                        alt="{{ $companySetting->name }}" class="w-full h-full object-cover">
                @else
                    <!-- Imagen de fondo por defecto para barbería -->
                    <div class="w-full h-full bg-gradient-to-br from-gray-900 to-black"></div>
                @endif
                <!-- Overlay para mejor legibilidad -->
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/60"></div>
            </div>

            <!-- Contenido principal -->
            <div class="section-container relative z-10 px-6 text-white animate-fade-in-up">
                <div class="max-w-2xl">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="decorative-line"></div>
                        <span class="text-sm uppercase tracking-wider text-gray-300 font-medium">Excelencia en
                            Barbería</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 heading-serif leading-tight">
                        <span class="block" style="color: var(--color-primary);">{{ $companySetting->name }}</span>
                        <span class="block text-white">Experiencia Premium</span>
                    </h1>

                    <p class="text-lg text-gray-300 mb-10 max-w-xl body-text">
                        {{ $companySetting->seo_description }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('appointments.create') }}"
                            class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold inline-flex items-center justify-center">
                            <i class="fas fa-calendar-check mr-3"></i>
                            Reservar Ahora
                        </a>

                        <a href="#equipo"
                            class="px-8 py-4 rounded-lg text-lg font-semibold border-2 border-white text-white hover:bg-white hover:text-gray-900 transition-all inline-flex items-center justify-center">
                            <i class="fas fa-users mr-3"></i>
                            Conoce al Equipo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Indicador de scroll -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
                <div class="animate-bounce">
                    <i class="fas fa-chevron-down text-white text-2xl"></i>
                </div>
            </div>
        </section>

        <!-- SECCIÓN EQUIPO PROFESIONAL -->
        <section id="equipo" class="py-24 bg-white">
            <div class="section-container px-6">
                <!-- Encabezado de sección -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 heading-serif">
                        <span class="text-gray-900">Nuestro </span>
                        <span style="color: var(--color-primary);">Equipo</span>
                    </h2>
                    <p class="text-lg text-gray-600 body-text">
                        Profesionales certificados con años de experiencia en las últimas tendencias de barbería.
                    </p>
                    <div class="decorative-line mx-auto mt-6"></div>
                </div>

                <!-- Grid de equipo -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($employees as $employee)
                        <div class="team-member-card professional-card bg-white shadow-lg"
                            wire:click="$dispatch('openEmployeeModal', { employeeId: {{ $employee->id }} })">

                            <!-- Imagen del empleado -->
                            <div class="relative h-80 overflow-hidden">
                                @if ($employee->user->photo_path)
                                    <img src="{{ asset('storage/' . $employee->user->photo_path) }}"
                                        alt="{{ $employee->user->name }}"
                                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                                @else
                                    <div class="w-full h-full flex items-center justify-center"
                                        style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                                        <span class="text-4xl font-bold text-white">
                                            {{ strtoupper(substr($employee->user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                @endif

                                <!-- Overlay hover -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 flex items-end">
                                </div>
                            </div>

                            <!-- Información del empleado -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 heading-sans">
                                    {{ $employee->user->name }}
                                </h3>

                                <p class="text-gray-600 mb-4"></p>

                                <div class="flex items-center justify-between">
                                    <span class="text-sm px-3 py-1 rounded-full"
                                        style="background: var(--color-primary); color: var(--color-light);">
                                        {{ $employee->status }}
                                    </span>

                                    <button class="text-sm font-medium flex items-center space-x-1"
                                        style="color: var(--color-primary);">
                                        <span>Ver detalles</span>
                                        <i class="fas fa-arrow-right text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Modal de empleado -->
            <livewire:employee-modal :primaryColor="$companySetting->primary_color" />
        </section>

        <!-- HORARIO PROFESIONAL CON COLOR SECONDARY DE FONDO -->
        <section id="horario" class="py-24" style="background: var(--color-secondary);">
            <div class="section-container px-6">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <!-- Información del horario -->
                    <div>
                        <h2 class="text-4xl md:text-5xl font-bold mb-8 heading-serif text-white">
                            <span class="text-white">Horario de </span>
                            <span style="color: var(--color-primary);">Atención</span>
                        </h2>

                        <p class="text-lg text-gray-100 mb-10 body-text">
                            Ofrecemos horarios flexibles para adaptarnos a tu agenda. Recomendamos reservar con
                            anticipación, especialmente los viernes y sábados.
                        </p>

                        <!-- Destacado -->
                        <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl border-l-4 border-white/30">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                                    style="background: var(--color-primary);">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-white mb-2">Reservas Prioritarias</h4>
                                    <p class="text-gray-100">Para garantizar tu horario preferido, te recomendamos
                                        reservar con al menos 24 horas de anticipación.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de horarios ultra compacta -->
                    <div class="bg-white rounded-lg shadow-md p-5 professional-card">
                        <h3 class="text-lg font-bold mb-5 heading-sans text-center text-gray-900">Horario Semanal</h3>

                        <div class="space-y-2">
                            @foreach ($daysOrder as $day)
                                @php
                                    $data = $companySetting->schedule[$day] ?? null;
                                @endphp

                                @if ($data)
                                    <div
                                        class="flex items-center justify-between p-2.5 rounded-md hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center space-x-2.5">
                                            <div
                                                class="w-8 h-8 rounded-md flex items-center justify-center flex-shrink-0
                        {{ $data['active'] ? 'bg-green-50' : 'bg-gray-50' }}">
                                                @if ($data['active'])
                                                    <i class="fas fa-check text-xs"
                                                        style="color: var(--color-primary);"></i>
                                                @else
                                                    <i class="fas fa-times text-gray-400 text-xs"></i>
                                                @endif
                                            </div>
                                            <div class="min-w-[90px]">
                                                <span
                                                    class="font-medium text-gray-900 text-xs">{{ $day }}</span>
                                                @if ($data['active'])
                                                    <p class="text-xs text-gray-500">Disponible</p>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($data['active'])
                                            <div class="text-right">
                                                <span class="font-semibold text-gray-900 text-xs">
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $data['start'])->format('g:i A') }}
                                                </span>
                                                <span class="mx-1 text-gray-400 text-xs">-</span>
                                                <span class="font-semibold text-gray-900 text-xs">
                                                    {{ \Carbon\Carbon::createFromFormat('H:i', $data['end'])->format('g:i A') }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="text-gray-400 font-medium text-xs">Cerrado</span>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!-- CTA super compacto -->
                        <div class="mt-6 text-center">
                            <a href="{{ route('appointments.create') }}"
                                class="btn-secondary px-5 py-2.5 rounded-md text-sm font-semibold inline-block">
                                <i class="fas fa-calendar-alt mr-1.5"></i>
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- UBICACIÓN Y CONTACTO PROFESIONAL -->
        <section id="ubicacion" class="py-24 bg-white">
            <div class="section-container px-6">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 heading-serif">
                        <span class="text-gray-900">Nuestra </span>
                        <span style="color: var(--color-primary);">Ubicación</span>
                    </h2>
                    <p class="text-lg text-gray-600 body-text">
                        Encuéntranos fácilmente en el corazón de la ciudad. Estacionamiento disponible y excelente
                        acceso al transporte público.
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-12">
                    <!-- Información de contacto -->
                    <div class="space-y-8">
                        <div class="bg-gray-50 p-8 rounded-2xl">
                            <h3 class="text-2xl font-bold mb-6 heading-sans">Información de Contacto</h3>

                            <div class="space-y-6">
                                <!-- Dirección -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0"
                                        style="background: var(--color-primary);">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Dirección</h4>
                                        <p class="text-gray-600">{{ $companySetting->address }}</p>
                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ $companySetting->location_description }}</p>
                                    </div>
                                </div>

                                <!-- Teléfono -->
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0"
                                        style="background: var(--color-primary);">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900 mb-1">Teléfono</h4>
                                        <a href="tel:{{ $companySetting->phone }}"
                                            class="text-xl font-bold hover:underline"
                                            style="color: var(--color-primary);">
                                            {{ $companySetting->phone }}
                                        </a>
                                        <p class="text-sm text-gray-500 mt-2">Lunes a Sábado: 9:00 AM - 8:00 PM</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                @if ($companySetting->email)
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0"
                                            style="background: var(--color-primary);">
                                            <i class="fas fa-envelope text-white"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 mb-1">Correo Electrónico</h4>
                                            <a href="mailto:{{ $companySetting->email }}"
                                                class="text-lg text-gray-600 hover:underline">
                                                {{ $companySetting->email }}
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <a href="{{ $companySetting->map_url }}" target="_blank" rel="noopener"
                                class="btn-primary p-4 rounded-lg text-center font-semibold">
                                <i class="fas fa-directions mr-2"></i>
                                Cómo Llegar
                            </a>

                            <a href="{{ route('appointments.create') }}"
                                class="p-4 rounded-lg text-center font-semibold border-2 border-gray-300 text-gray-900 hover:border-gray-900 transition-colors">
                                <i class="fas fa-calendar mr-2"></i>
                                Reservar Cita
                            </a>
                        </div>
                    </div>

                    <!-- Mapa -->
                    <div class="relative">
                        <div
                            class="absolute -inset-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl transform rotate-1">
                        </div>
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl h-full">
                            <iframe class="w-full h-full min-h-[400px] border-0" src="{{ $companySetting->map_url }}"
                                loading="lazy" allowfullscreen>
                            </iframe>
                            <div
                                class="absolute top-6 left-6 px-4 py-2 rounded-lg bg-white/90 backdrop-blur-sm shadow-lg">
                                <span class="font-semibold" style="color: var(--color-primary);">
                                    <i class="fas fa-map-pin mr-2"></i> Ubicación Exacta
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="pt-16 pb-8" style="background: var(--color-secondary); color: var(--color-light);">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-12 pb-12 border-b border-white/10">
                    <!-- Logo y descripción -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg flex items-center justify-center"
                                style="background: var(--color-primary);">
                                <i class="fas fa-cut text-white text-xl"></i>
                            </div>
                            <span class="text-2xl font-bold">{{ $companySetting->name }}</span>
                        </div>
                        <p class="text-gray-300">
                            {{ $companySetting->seo_description }}
                        </p>
                    </div>

                    <!-- Enlaces rápidos -->
                    <div>
                        <h4 class="text-lg font-bold mb-6">Enlaces Rápidos</h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('appointments.create') }}"
                                    class="text-gray-300 hover:text-white transition">Reservar Cita</a></li>
                            <li><a href="#equipo" class="text-gray-300 hover:text-white transition">Nuestro Equipo</a></li>
                            <li><a href="#horario" class="text-gray-300 hover:text-white transition">Horarios</a></li>
                            <li><a href="#ubicacion" class="text-gray-300 hover:text-white transition">Ubicación</a></li>
                        </ul>
                    </div>

                    <!-- Contacto -->
                    <div>
                        <h4 class="text-lg font-bold mb-6">Contacto</h4>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-map-marker-alt text-gray-300"></i>
                                <span class="text-gray-300">{{ $companySetting->address }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone text-gray-300"></i>
                                <span class="text-gray-300">{{ $companySetting->phone }}</span>
                            </div>
                            @if ($companySetting->email)
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-envelope text-gray-300"></i>
                                    <span class="text-gray-300">{{ $companySetting->email }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Redes sociales -->
                    <div>
                        <h4 class="text-lg font-bold mb-6">Síguenos</h4>
                        <div class="flex gap-3">
                            @if ($companySetting->whatsapp)
                                <a href="{{ $companySetting->whatsapp }}"
                                    class="w-10 h-10 rounded-lg flex items-center justify-center hover:opacity-90 transition"
                                    style="background: var(--color-primary);">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            @endif

                            @if ($companySetting->instagram)
                                <a href="{{ $companySetting->instagram }}"
                                    class="w-10 h-10 rounded-lg flex items-center justify-center hover:opacity-90 transition"
                                    style="background: var(--color-primary);">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif

                            @if ($companySetting->facebook)
                                <a href="{{ $companySetting->facebook }}"
                                    class="w-10 h-10 rounded-lg flex items-center justify-center hover:opacity-90 transition"
                                    style="background: var(--color-primary);">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="pt-8 text-center">
                    <p class="text-gray-400 text-sm">
                        © {{ date('Y') }} {{ $companySetting->name }}. Todos los derechos reservados.
                    </p>
                </div>
            </div>
        </footer>

        <!-- BOTÓN FLOTANTE DE RESERVA PROFESIONAL -->
        <div class="fixed bottom-8 right-8 z-50">
            <div class="relative">
                <!-- Botón principal -->
                <a href="{{ route('appointments.create') }}"
                    class="w-16 h-16 rounded-full flex items-center justify-center shadow-2xl transition-all duration-300 hover:scale-110"
                    style="background: var(--color-primary); color: var(--color-light);">
                    <i class="fas fa-calendar-alt text-2xl"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para animaciones adicionales -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animación suave al hacer scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Efecto de aparición al hacer scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                }
            });
        }, observerOptions);

        // Observar elementos para animación
        document.querySelectorAll('.professional-card, .section-container > div').forEach(el => {
            observer.observe(el);
        });
    });
</script>
