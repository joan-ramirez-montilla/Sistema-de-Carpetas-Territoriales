<div class="flex h-full w-full flex-1 flex-col gap-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Visión general del sistema
            </p>
        </div>
    </div>

    {{-- Grid de métricas --}}
    <div class="grid gap-12 md:grid-cols-3">

        {{-- Personas --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm
                   transition-all duration-300 hover:shadow-md hover:border-gray-300/50
                   dark:hover:border-gray-700">

            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                        Personas Registradas
                    </p>
                    <p id="peopleCount"
                       class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $totalPeople }}
                    </p>
                </div>

                <div class="rounded-lg bg-indigo-50 dark:bg-indigo-950/30 p-3">
                    <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Provincias --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm
                   transition-all duration-300 hover:shadow-md hover:border-gray-300/50
                   dark:hover:border-gray-700">

            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                        Provincias Activas
                    </p>
                    <p id="provincesCount"
                       class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activeProvinces }}
                    </p>
                </div>

                <div class="rounded-lg bg-rose-50 dark:bg-rose-950/30 p-3">
                    <svg class="h-6 w-6 text-rose-600 dark:text-rose-400"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 6l9-4 9 4-9 4-9-4zM3 10l9 4 9-4" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Municipios --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm
                   transition-all duration-300 hover:shadow-md hover:border-gray-300/50
                   dark:hover:border-gray-700">

            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                        Municipios Activos
                    </p>
                    <p id="municipalitiesCount"
                       class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activeMunicipalities }}
                    </p>
                </div>

                <div class="rounded-lg bg-emerald-50 dark:bg-emerald-950/30 p-3">
                    <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>
            </div>
        </div>

    </div>
</div>
