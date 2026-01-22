<div>
    @php
        $primaryColor = $companySetting->primary_color;
        $secondaryColor = $companySetting->secondary_color;
        $lightColor = '#ffffff';
    @endphp

    <style>
        :root {
            --color-primary: {{ $primaryColor }};
            --color-secondary: {{ $secondaryColor }};
            --color-light: {{ $lightColor }};
        }

        .btn-primary {
            background-color: var(--color-primary);
            color: var(--color-light);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--color-primary);
            filter: brightness(0.9);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .service-selected {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .employee-selected {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            border-radius: 20px;
            padding-bottom: 15px;
        }

        .date-selected {
            animation: pulse 0.3s ease;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>

    <div style="font-family: 'Inter', sans-serif; background: #f8fafc;">

        {{-- HEADER MEJORADO --}}
        <header class="py-6 px-4 sm:px-6 bg-white shadow-sm sticky top-0 z-40">
            <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center"
                         style="background: var(--color-primary);">
                        <i class="fas fa-cut text-white"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-gray-900">{{ $companySetting->name }}</span>
                        <p class="text-sm text-gray-500 hidden sm:block">Barbería Profesional</p>
                    </div>
                </div>

                <div class="text-center sm:text-right">
                    <h1 class="text-2xl font-bold text-gray-900">Agendar Cita</h1>
                    <p class="text-gray-500 text-sm">Reserva tu cita en pocos pasos</p>
                </div>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="py-8 px-4 sm:px-6">
            <div class="max-w-4xl mx-auto">

                {{-- PROGRESS INDICATOR --}}
                <div class="mb-10"></div>

                {{-- 1. CLIENT DATA --}}
                <section class="mb-10">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-user text-xs text-gray-600"></i>
                        </div>
                        Datos personales
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre completo</label>
                            <input type="text" wire:model="customer_name"
                                class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition"
                                placeholder="Ingresa tu nombre">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="text" wire:model="customer_phone"
                                class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent transition"
                                placeholder="Ej: 555-123-4567" id="customer_phone">
                        </div>
                    </div>
                </section>

                {{-- 2. SERVICES SELECTION --}}
                <section class="mb-10">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-scissors text-xs text-gray-600"></i>
                        </div>
                        Selecciona el servicio
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                        @foreach ($services as $service)
                            <div wire:click="selectService({{ $service->id }})"
                                class="cursor-pointer flex flex-col items-center gap-3 p-4 rounded-2xl border-2 transition-all duration-300 relative
                                    {{ $selectedService && $selectedService->id === $service->id
                                        ? 'service-selected border-[var(--color-primary)]'
                                        : 'border-gray-200 hover:border-gray-300 hover:shadow-md' }}">

                                {{-- Check indicator en esquina --}}
                                <div class="absolute top-2 right-2 w-7 h-7 rounded-full flex items-center justify-center transition-all duration-300"
                                    style="background: {{ $selectedService && $selectedService->id === $service->id
                                        ? 'var(--color-primary)'
                                        : 'rgba(255,255,255,0.9)' }};
                                           border: 2px solid {{ $selectedService && $selectedService->id === $service->id
                                        ? 'var(--color-primary)'
                                        : '#e5e7eb' }};">
                                    @if ($selectedService && $selectedService->id === $service->id)
                                        <i class="fas fa-check text-white text-xs"></i>
                                    @endif
                                </div>

                                <div class="relative w-20 h-20 rounded-full flex items-center justify-center overflow-hidden"
                                    style="background: {{ $service->color }};">

                                    {{-- Image --}}
                                    @if ($service->image)
                                        <img src="{{ asset('storage/services/' . $service->image) }}"
                                            alt="{{ $service->name }}"
                                            class="w-12 h-12 object-contain">
                                    @else
                                        <span class="text-2xl font-bold text-white">
                                            {{ strtoupper(substr($service->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Text --}}
                                <div class="text-center">
                                    <p class="font-semibold text-gray-800 text-sm">{{ $service->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 3. BARBERS SELECTION --}}
                @if($selectedService)
                <section class="mb-10">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-user-tie text-xs text-gray-600"></i>
                        </div>
                        Selecciona tu barbero
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                        @foreach ($employees as $employee)
                            <div wire:click="selectBarber({{ $employee->id }})"
                                class="relative cursor-pointer group transition-all duration-300
                                    {{ $selectedEmployee && $selectedEmployee->id == $employee->id
                                        ? 'employee-selected'
                                        : 'hover:scale-[1.02]' }}">

                                {{-- Selection indicator sin fondo blanco --}}
                                <div class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-300"
                                    style="border-color: var(--color-primary);
                                           background: {{ $selectedEmployee && $selectedEmployee->id == $employee->id
                                                ? 'var(--color-primary)'
                                                : 'transparent' }};">
                                    @if ($selectedEmployee && $selectedEmployee->id == $employee->id)
                                        <i class="fas fa-check text-white text-sm"></i>
                                    @endif
                                </div>

                                {{-- Employee photo --}}
                                <div class="relative rounded-xl overflow-hidden shadow-md">
                                    @if ($employee->user->photo_path)
                                        <img src="{{ asset('storage/' . $employee->user->photo_path) }}"
                                            class="w-full h-40 object-cover group-hover:scale-110 transition-transform duration-500"
                                            alt="{{ $employee->user->name }}">
                                    @else
                                        <div class="w-full h-40 flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                            <span class="text-3xl font-bold text-gray-700">
                                                {{ strtoupper(substr($employee->user->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Employee info --}}
                                <div class="text-center mt-4">
                                    <p class="font-bold text-gray-900">{{ $employee->user->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $employee->specialty ?? 'Barbero Profesional' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- 4. DATE SELECTION --}}
                @if ($currentMonth && $selectedEmployee)
                <section class="mb-10">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-calendar text-xs text-gray-600"></i>
                        </div>
                        Selecciona la fecha
                    </h2>

                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between mb-6">
                            <button wire:click="previousMonth"
                                    class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-100 transition"
                                    @disabled($currentMonthIndex === 0)>
                                <i class="fas fa-chevron-left text-gray-600"></i>
                            </button>

                            <div class="text-xl font-bold text-gray-900">
                                {{ $currentMonth['monthName'] }} {{ $currentMonth['year'] }}
                            </div>

                            <button wire:click="nextMonth"
                                    class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-gray-100 transition"
                                    @disabled($currentMonthIndex === count($availableMonths) - 1)>
                                <i class="fas fa-chevron-right text-gray-600"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-7 gap-2 text-center">
                            @foreach (['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                                <div class="text-sm font-semibold text-gray-500 py-2">{{ $day }}</div>
                            @endforeach

                            @php
                                $firstDate = \Carbon\Carbon::parse($currentMonth['dates'][0]['value']);
                                $blankDays = $firstDate->dayOfWeekIso - 1;
                            @endphp

                            @for ($i = 0; $i < $blankDays; $i++)
                                <div class="h-14"></div>
                            @endfor

                            @foreach ($currentMonth['dates'] as $date)
                                <div wire:click="$set('selectedDate','{{ $date['value'] }}')"
                                    class="h-14 flex flex-col items-center justify-center rounded-xl cursor-pointer transition-all duration-200
                                    {{ $selectedDate === $date['value']
                                        ? 'date-selected text-white shadow-md'
                                        : 'hover:bg-gray-50 border border-transparent hover:border-gray-200' }}"
                                    style="{{ $selectedDate === $date['value']
                                        ? 'background: var(--color-primary);'
                                        : '' }}">
                                    <span class="font-bold text-sm">{{ $date['number'] }}</span>
                                    <span class="text-xs mt-1 {{ $selectedDate === $date['value'] ? 'text-white/90' : 'text-gray-400' }}">
                                        {{ $date['day'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                @endif

                {{-- 5. TIME SELECTION --}}
                @if ($selectedDate)
                <section class="mb-10">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <div class="w-6 h-6 rounded bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-clock text-xs text-gray-600"></i>
                        </div>
                        Selecciona el horario
                    </h2>

                    @if (empty($timeSlots))
                        <div class="text-center py-8 rounded-2xl bg-gray-50 border border-gray-200">
                            <i class="fas fa-calendar-times text-3xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 font-medium">No hay horarios disponibles para este día</p>
                            <p class="text-sm text-gray-500 mt-1">Por favor selecciona otra fecha</p>
                        </div>
                    @else
                        <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-6 gap-3">
                            @foreach ($timeSlots as $slot)
                                <button wire:click="$set('selectedTime','{{ $slot['value'] }}')"
                                    class="h-14 rounded-xl border font-medium transition-all duration-200 flex items-center justify-center
                                    {{ $selectedTime === $slot['value']
                                        ? 'btn-primary shadow-md'
                                        : 'bg-white border-gray-300 hover:border-[var(--color-primary)] hover:bg-[var(--color-primary)]/5' }}">
                                    {{ $slot['label'] }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </section>
                @endif

                {{-- ERROR MESSAGES --}}
                @if ($errors->any())
                    <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5 animate-pulse">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-600"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-red-800 mb-2">Corrige los siguientes errores:</h3>
                                <ul class="space-y-1.5">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-center gap-2 text-sm text-red-700">
                                            <i class="fas fa-circle text-xs"></i>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- APPOINTMENT SUMMARY --}}
                @if($selectedService && $selectedEmployee && $selectedDate && $selectedTime)
                <div class="mb-8 rounded-2xl bg-gradient-to-r from-gray-50 to-white p-6 border border-gray-200 shadow-sm">
                    <h3 class="text-lg font-bold mb-4 text-gray-900">Resumen de tu cita</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
                                    <i class="fas fa-user text-[var(--color-primary)]"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Cliente</p>
                                    <p class="font-medium">{{ $customer_name ?: 'Por completar' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
                                    <i class="fas fa-scissors text-[var(--color-primary)]"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Servicio</p>
                                    <p class="font-medium">{{ $selectedService->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
                                    <i class="fas fa-user-tie text-[var(--color-primary)]"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Barbero</p>
                                    <p class="font-medium">{{ $selectedEmployee->user->name }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-[var(--color-primary)]"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Fecha y hora</p>
                                    <p class="font-medium">
                                        {{ \Carbon\Carbon::parse($selectedDate)->format('d/m/Y') }}
                                        a las {{ \Carbon\Carbon::parse($selectedTime)->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- SUBMIT BUTTON --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <button wire:click="storeAppointment"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-70 cursor-not-allowed"
                            class="btn-primary px-10 py-4 rounded-full font-bold text-lg transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none flex items-center gap-3 w-full sm:w-auto">
                        <span wire:loading.remove wire:target="storeAppointment">
                            <i class="fas fa-calendar-check"></i> Confirmar Cita
                        </span>
                        <span wire:loading wire:target="storeAppointment">
                            <i class="fas fa-spinner fa-spin"></i> Procesando...
                        </span>
                    </button>
                </div>

            </div>
        </main>

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

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Cleave('#customer_phone', {
            delimiters: ['-', '-'],
            blocks: [3, 3, 4],
            numericOnly: true
        });
    });
</script>
