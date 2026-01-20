<div>
    @php
        $primaryColor = $companySetting->primary_color;
        $secondaryColor = $companySetting->secondary_color;
        $lightColor = '#ffffff';
    @endphp

    <div
        style="--color-primary: {{ $primaryColor }}; --color-secondary: {{ $secondaryColor }}; --color-light: {{ $lightColor }}; font-family: 'Inter', sans-serif;">

        {{-- HEADER --}}
        <header class="py-8 px-6 bg-white">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full" style="background: var(--color-primary);"></div>
                    <span class="text-xl font-semibold tracking-tight">{{ $companySetting->name }}</span>
                </div>

                <div class="text-right">
                    <h1 class="text-2xl font-bold">Agendar Cita</h1>
                    <p class="text-gray-500 text-sm">Selecciona un barbero disponible</p>
                </div>
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="py-6 px-6 bg-white">
            <div class="max-w-4xl mx-auto">

                {{-- 1. CLIENT DATA --}}
                <section class="mb-8">
                    <h2 class="text-xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">
                        1. Datos personales
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" wire:model="customer_name"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"
                            placeholder="Nombre">

                        <input type="text" wire:model="customer_phone"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)]"
                            placeholder="Teléfono">
                    </div>
                </section>

{{-- 2. SERVICES SELECTION --}}
<section class="mb-10">
    <h2 class="text-xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">
        2. Selecciona el servicio
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach ($services as $service)
            <div
                wire:click="selectService({{ $service->id }})"
                class="cursor-pointer flex flex-col items-center gap-3"
            >
                {{-- Image wrapper --}}
                <div
                    class="relative w-30 h-30 rounded-full flex items-center justify-center"
                    style="background: {{ $service->color }};"
                >
                    {{-- Check --}}
                    <div
                        class="absolute top-1 right-1 w-5 h-5 rounded-full
                               flex items-center justify-center"
                        style="
                            background:
                                {{ $selectedService && $selectedService->id === $service->id
                                    ? 'var(--color-primary)'
                                    : 'rgba(255,255,255,0.7)' }};
                        "
                    >
                        @if ($selectedService && $selectedService->id === $service->id)
                            <i class="fas fa-check text-white text-xs"></i>
                        @endif
                    </div>

                    {{-- Image --}}
                    @if ($service->image)
                        <img
                            src="{{ asset('storage/services/' . $service->image) }}"
                            alt="{{ $service->name }}"
                            class="w-15 h-15 object-contain"
                        >
                    @else
                        <span class="text-base text-white">
                            {{ strtoupper(substr($service->name, 0, 1)) }}
                        </span>
                    @endif
                </div>

                {{-- Text --}}
                <p class="text-sm text-center">
                    {{ $service->name }}
                </p>
            </div>
        @endforeach
    </div>
</section>




                {{-- 2. BARBERS SELECTION --}}
                <section class="mb-8">
                    <h2 class="text-xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">
                        2. Selecciona tu barbero
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($employees as $employee)
                            <div class="relative cursor-pointer group" wire:click="selectBarber({{ $employee->id }})">

                                {{-- SELECTION INDICATOR --}}
                                <div class="absolute top-2 right-2 z-10 w-7 h-7 rounded-full flex items-center justify-center border-2 transition-all duration-300"
                                    style="border-color: var(--color-primary);
                                            background: {{ $selectedEmployee && $selectedEmployee->id == $employee->id ? 'var(--color-primary)' : 'transparent' }};">
                                    @if ($selectedEmployee && $selectedEmployee->id == $employee->id)
                                        <i class="fas fa-check text-white"></i>
                                    @endif
                                </div>

                                {{-- EMPLOYEE PHOTO --}}
                                <div class="relative rounded-2xl overflow-hidden shadow-lg">
                                    @if ($employee->user->photo_path)
                                        <img src="{{ asset('storage/' . $employee->user->photo_path) }}"
                                            class="w-full h-40 object-cover" alt="{{ $employee->user->name }}">
                                    @else
                                        <div class="w-full h-40 flex items-center justify-center bg-gray-200">
                                            <span class="text-4xl font-bold text-gray-700">
                                                {{ strtoupper(substr($employee->user->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- EMPLOYEE NAME --}}
                                <div class="text-center mt-3">
                                    <p class="font-semibold text-gray-800">
                                        {{ $employee->user->name }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                {{-- 3. DATE SELECTION --}}
                @if ($currentMonth)
                    <section class="mb-8">
                        <h2 class="text-xl font-bold mb-4" style="font-family:'Playfair Display', serif;">
                            3. Selecciona la fecha
                        </h2>

                        <div class="flex items-center justify-between mb-4">
                            <button wire:click="previousMonth" class="p-2 rounded-full hover:bg-gray-100"
                                @disabled($currentMonthIndex === 0)>
                                ‹
                            </button>

                            <div class="text-lg font-bold">
                                {{ $currentMonth['monthName'] }} {{ $currentMonth['year'] }}
                            </div>

                            <button wire:click="nextMonth" class="p-2 rounded-full hover:bg-gray-100"
                                @disabled($currentMonthIndex === count($availableMonths) - 1)>
                                ›
                            </button>
                        </div>

                        <div class="grid grid-cols-7 gap-1 text-center">
                            @foreach (['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                                <div class="text-xs font-bold text-gray-500">{{ $day }}</div>
                            @endforeach

                            @php
                                $firstDate = \Carbon\Carbon::parse($currentMonth['dates'][0]['value']);
                                $blankDays = $firstDate->dayOfWeekIso - 1;
                            @endphp

                            @for ($i = 0; $i < $blankDays; $i++)
                                <div class="h-16"></div>
                            @endfor

                            @foreach ($currentMonth['dates'] as $date)
                                <div wire:click="$set('selectedDate','{{ $date['value'] }}')"
                                    class="h-16 flex flex-col items-center justify-center rounded-xl cursor-pointer transition
                                    {{ $selectedDate === $date['value'] ? 'text-white' : 'bg-white border border-gray-200' }}"
                                    style="{{ $selectedDate === $date['value']
                                        ? 'background: var(--color-primary); border-color: var(--color-primary);'
                                        : '' }}">
                                    <span class="font-semibold">{{ $date['number'] }}</span>
                                    <span class="text-[10px] text-gray-400">{{ $date['day'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- 4. TIME SELECTION --}}
                <section class="mb-8">
                    <h2 class="text-xl font-bold mb-4" style="font-family: 'Playfair Display', serif;">
                        4. Selecciona el horario
                    </h2>

                    <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
                        @foreach ($timeSlots as $time)
                            <label wire:click="$set('selectedTime', '{{ $time }}')"
                                class="flex items-center justify-center border rounded-xl h-12 cursor-pointer transition-all duration-200
                                      {{ $selectedTime == $time ? 'bg-[var(--color-primary)] text-white border-[var(--color-primary)]' : 'bg-white text-gray-800 border-gray-200' }}">
                                <input type="radio" value="{{ $time }}" class="hidden">
                                <span class="font-semibold">{{ $time }}</span>
                            </label>
                        @endforeach
                    </div>
                </section>



                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
                        <div class="flex items-start gap-3">
                            <div class="text-red-600 text-xl">⚠️</div>
                            <div>
                                <h3 class="font-semibold text-red-700 mb-2"> Corrige los siguientes errores: </h3>
                                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif



                {{-- SUBMIT BUTTON --}}
                <div class="mt-8 text-right">
                    <button wire:click="storeAppointment" wire:loading.attr="disabled"
                        class="px-10 py-3.5 rounded-full font-medium transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5"
                        style="background: var(--color-primary); color: var(--color-light);">
                        Agendar cita
                    </button>
                </div>

            </div>
        </main>

        {{-- FOOTER --}}
        <footer class="py-16 mt-15 px-6" style="background: var(--color-secondary); color: var(--color-light);">
            <div class="max-w-6xl mx-auto">
                {{-- Main grid --}}
                <div class="grid md:grid-cols-3 gap-10 pb-12 border-b border-white/10">
                    {{-- Logo and name --}}
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

                    {{-- Social media --}}
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

                    {{-- Contact information --}}
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
    </div>
</div>
