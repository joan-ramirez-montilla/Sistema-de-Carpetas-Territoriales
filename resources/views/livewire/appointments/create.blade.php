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

        /* Animaciones para la pantalla de confirmación */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        .animate-slideUp {
            animation: slideUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Fondo decorativo para confirmación */
        .confirmation-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }

        .confirmation-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 300px;
            background: linear-gradient(135deg,
                    rgba(var(--color-primary-rgb, 59, 130, 246), 0.05) 0%,
                    rgba(var(--color-primary-rgb, 59, 130, 246), 0.02) 100%);
            z-index: 0;
        }

        .confirmation-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .checkmark-circle {
            background: linear-gradient(135deg, var(--color-primary) 0%,
                    color-mix(in srgb, var(--color-primary) 80%, #ffffff 20%) 100%);
            box-shadow: 0 10px 30px rgba(var(--color-primary-rgb, 59, 130, 246), 0.3);
        }

        .confirmation-code {
            background: linear-gradient(135deg,
                    rgba(var(--color-primary-rgb, 59, 130, 246), 0.1) 0%,
                    rgba(var(--color-primary-rgb, 59, 130, 246), 0.05) 100%);
            border: 2px solid rgba(var(--color-primary-rgb, 59, 130, 246), 0.2);
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
        }
    </style>


    {{-- Verification Modal --}}
    @if ($showVerificationModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            {{-- Modal --}}
            <div class="w-full max-w-md p-6 bg-white rounded-xl shadow-lg">
                <div class="space-y-6">
                    {{-- Title & description --}}
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            Confirma tu código
                        </h2>

                        <p class="mt-2 text-sm text-gray-600">
                            Hemos enviado un <strong>código de verificación</strong> a tu número de WhatsApp.
                            Ingresa el código para confirmar tu cita.
                        </p>
                    </div>

                    {{-- Code input --}}
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">
                            Código de verificación
                        </label>

                        <input
                            type="text"
                            inputmode="numeric"
                            maxlength="6"
                            wire:model.defer="enteredVerificationCode"
                            placeholder="Ej: 123456"
                            class="w-full px-3 py-2 text-center tracking-widest border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                        />

                        @error('enteredVerificationCode')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-1 text-xs text-gray-500">
                            Revisa tu WhatsApp e ingresa el código que recibiste.
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex justify-end space-x-3">
                        <button
                            type="button"
                            wire:click="$set('showVerificationModal', false)"
                            class="px-4 py-2 text-sm border rounded-lg hover:bg-gray-100"
                        >
                            Cancelar
                        </button>

                        <button
                            type="button"
                            wire:click="confirmVerificationCode"
                            wire:loading.attr="disabled"
                            class="px-4 py-2 text-sm text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 disabled:opacity-50"
                        >
                            Confirmar código
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    {{-- COMPONENTE HEADER REUTILIZABLE --}}
    @php
        function renderHeader($companySetting, $primaryColor)
        {
            return '
                <header class="py-6 px-4 sm:px-6 bg-white shadow-sm sticky top-0 z-40">
                    <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: ' .
                $primaryColor .
                ';">
                                <i class="fas fa-cut text-white"></i>
                            </div>
                            <div>
                                <span class="text-xl font-bold text-gray-900">' .
                $companySetting->name .
                '</span>
                                <p class="text-sm text-gray-500 hidden sm:block">Barbería Profesional</p>
                            </div>
                        </div>

                        <div class="text-center sm:text-right">
                            <h1 class="text-2xl font-bold text-gray-900">Agendar Cita</h1>
                            <p class="text-gray-500 text-sm">Reserva tu cita en pocos pasos</p>
                        </div>
                    </div>
                </header>
            ';
        }
    @endphp

    {{-- PANTALLA DE CONFIRMACIÓN COMPLETA --}}
    @if ($appointmentConfirmed && $lastAppointment)
        <div class="confirmation-bg animate-fadeIn"
            style="--color-primary-rgb: {{ implode(', ', sscanf($primaryColor, '#%02x%02x%02x')) }};">

            {{-- HEADER --}}
            {!! renderHeader($companySetting, $primaryColor) !!}

            <main class="py-8 px-4 sm:px-6">
                <div class="max-w-lg mx-auto">
                    {{-- Tarjeta principal de confirmación --}}
                    <div class="confirmation-card p-6 mb-6 animate-slideUp">
                        {{-- Icono y título --}}
                        <div class="text-center mb-6">
                            <div
                                class="w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 checkmark-circle">
                                <i class="fas fa-check text-white text-2xl"></i>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">¡Confirmado!</h1>
                            <p class="text-gray-600">Cita agendada exitosamente</p>
                        </div>

                        {{-- Código de confirmación --}}
                        <div class="text-center mb-6">
                            <p class="text-xs text-gray-500 mb-2 uppercase tracking-wider">Código</p>
                            <div class="confirmation-code inline-block px-6 py-3 rounded-xl">
                                <span class="text-xl font-bold tracking-wider" style="color: var(--color-primary);">
                                    {{ $lastAppointment->confirmation_code }} 3232
                                </span>
                            </div>
                        </div>

                        {{-- Detalles compactos --}}
                        <div class="mb-6">
                            <div class="space-y-3">
                                @php
                                    $details = [
                                        [
                                            'icon' => 'user',
                                            'label' => 'Cliente',
                                            'value' => $lastAppointment->client_name,
                                        ],
                                        [
                                            'icon' => 'scissors',
                                            'label' => 'Servicio',
                                            'value' => $lastAppointment->service->name,
                                        ],
                                        [
                                            'icon' => 'user-tie',
                                            'label' => 'Barbero',
                                            'value' => $lastAppointment->employee->user->name,
                                        ],
                                        [
                                            'icon' => 'calendar-alt',
                                            'label' => 'Fecha',
                                            'value' => \Carbon\Carbon::parse(
                                                $lastAppointment->appointment_date,
                                            )->format('d/m/Y'),
                                        ],
                                        [
                                            'icon' => 'clock',
                                            'label' => 'Hora',
                                            'value' => \Carbon\Carbon::parse(
                                                $lastAppointment->appointment_time,
                                            )->format('g:i A'),
                                        ],
                                    ];
                                @endphp

                                @foreach ($details as $detail)
                                    <div class="flex items-center justify-between py-2">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                                                style="background: rgba(var(--color-primary-rgb, 59, 130, 246), 0.1);">
                                                <i class="fas fa-{{ $detail['icon'] }} text-xs"
                                                    style="color: var(--color-primary);"></i>
                                            </div>
                                            <span class="text-sm text-gray-600">{{ $detail['label'] }}</span>
                                        </div>
                                        <span
                                            class="text-sm font-semibold text-gray-900 text-right">{{ $detail['value'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- WhatsApp compacto --}}
                        <div class="bg-green-50 border border-green-100 rounded-xl p-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <i class="fab fa-whatsapp text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-green-800">WhatsApp enviado</p>
                                    <p class="text-xs text-green-700">Recordatorio 2h antes</p>
                                </div>
                            </div>
                        </div>

                        {{-- Instrucciones compactas --}}
                        <div class="mb-6">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex items-start gap-2 p-2 bg-gray-50 rounded-lg">
                                    <i class="fas fa-clock text-xs mt-1" style="color: var(--color-primary);"></i>
                                    <div>
                                        <p class="text-xs font-medium text-gray-800">10 min antes</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2 p-2 bg-gray-50 rounded-lg">
                                    <i class="fas fa-qrcode text-xs mt-1" style="color: var(--color-primary);"></i>
                                    <div>
                                        <p class="text-xs font-medium text-gray-800">Muestra código</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Acciones compactas --}}
                        <div class="space-y-3">
                            <button onclick="window.print()"
                                class="w-full py-3 rounded-lg font-medium border transition-all duration-200 hover:shadow-md flex items-center justify-center gap-2 text-sm"
                                style="border-color: var(--color-primary); color: var(--color-primary);">
                                <i class="fas fa-print"></i>
                                Imprimir
                            </button>

                            <a href="{{ route('home') }}"
                                class="w-full py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center gap-2 text-sm"
                                style="background: var(--color-primary); color: white;">
                                <i class="fas fa-home"></i>
                                Volver al inicio
                            </a>
                        </div>
                    </div>

                    {{-- Contacto rápido --}}
                    <div class="text-center">
                        <p class="text-xs text-gray-500 mb-2">¿Necesitas ayuda?</p>
                        <a href="tel:{{ $companySetting->phone }}"
                            class="inline-flex items-center gap-2 text-sm font-medium"
                            style="color: var(--color-primary);">
                            <i class="fas fa-phone"></i>
                            {{ $companySetting->phone }}
                        </a>
                    </div>
                </div>
            </main>

            {{-- FOOTER --}}
            @include('partials.footer', [
                'companySetting' => $companySetting,
                'primaryColor' => $primaryColor,
            ])
        </div>
    @else
        {{-- FORMULARIO ORIGINAL (solo se muestra si NO hay confirmación) --}}
        <div style="font-family: 'Inter', sans-serif; background: #f8fafc;">

            {{-- HEADER --}}
            {!! renderHeader($companySetting, $primaryColor) !!}

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
                                        style="background: {{ $selectedService && $selectedService->id === $service->id ? 'var(--color-primary)' : 'rgba(255,255,255,0.9)' }};
                                               border: 2px solid {{ $selectedService && $selectedService->id === $service->id ? 'var(--color-primary)' : '#e5e7eb' }};">
                                        @if ($selectedService && $selectedService->id === $service->id)
                                            <i class="fas fa-check text-white text-xs"></i>
                                        @endif
                                    </div>

                                    <div class="relative w-20 h-20 rounded-full flex items-center justify-center overflow-hidden"
                                        style="background: {{ $service->color }};">

                                        {{-- Image --}}
                                        @if ($service->image)
                                            <img src="{{ asset('storage/services/' . $service->image) }}"
                                                alt="{{ $service->name }}" class="w-12 h-12 object-contain">
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
                    @if ($selectedService)
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
                                        {{ $selectedEmployee && $selectedEmployee->id == $employee->id ? 'employee-selected' : 'hover:scale-[1.02]' }}">

                                        {{-- Selection indicator sin fondo blanco --}}
                                        <div class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-300"
                                            style="border-color: var(--color-primary);
                                               background: {{ $selectedEmployee && $selectedEmployee->id == $employee->id ? 'var(--color-primary)' : 'transparent' }};">
                                            @if ($selectedEmployee && $selectedEmployee->id == $employee->id)
                                                <i class="fas fa-check text-white text-sm"></i>
                                            @endif
                                        </div>

                                        {{-- Employee photo --}}
                                        <div class="relative rounded-xl overflow-hidden">
                                            @if ($employee->user->photo_path)
                                                <img src="{{ asset('storage/' . $employee->user->photo_path) }}"
                                                    class="w-full h-40 object-cover group-hover:scale-110 transition-transform duration-500"
                                                    alt="{{ $employee->user->name }}">
                                            @else
                                                <div
                                                    class="w-full h-40 flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                                    <span class="text-3xl font-bold text-gray-700">
                                                        {{ strtoupper(substr($employee->user->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Employee info --}}
                                        <div class="text-center mt-4">
                                            <p class="font-bold text-gray-900">{{ $employee->user->name }}</p>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ $employee->specialty ?? 'Barbero Profesional' }}</p>
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
                                        <div class="text-sm font-semibold text-gray-500 py-2">{{ $day }}
                                        </div>
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
                                            style="{{ $selectedDate === $date['value'] ? 'background: var(--color-primary);' : '' }}">
                                            <span class="font-bold text-sm">{{ $date['number'] }}</span>
                                            <span
                                                class="text-xs mt-1 {{ $selectedDate === $date['value'] ? 'text-white/90' : 'text-gray-400' }}">
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
                    @if ($errors->any() && !$showVerificationModal)
                        <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5 animate-pulse">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
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
                    @if ($selectedService && $selectedEmployee && $selectedDate && $selectedTime)
                        <div
                            class="mb-8 rounded-2xl bg-gradient-to-r from-gray-50 to-white p-6 border border-gray-200 shadow-sm">
                            <h3 class="text-lg font-bold mb-4 text-gray-900">Resumen de tu cita</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
                                            <i class="fas fa-user text-[var(--color-primary)]"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Cliente</p>
                                            <p class="font-medium">{{ $customer_name ?: 'Por completar' }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
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
                                        <div
                                            class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
                                            <i class="fas fa-user-tie text-[var(--color-primary)]"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Barbero</p>
                                            <p class="font-medium">{{ $selectedEmployee->user->name }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-[var(--color-primary)]/10 flex items-center justify-center">
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
                        <button wire:click="storeAppointment" wire:loading.attr="disabled"
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

            {{-- FOOTER --}}
            @include('partials.footer', [
                'companySetting' => $companySetting,
                'primaryColor' => $primaryColor,
            ])
        </div>
    @endif



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
