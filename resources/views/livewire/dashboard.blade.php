<div class="flex h-full w-full flex-1 flex-col gap-8">

    {{-- Banner de Bienvenida --}}
    <div
        class="relative overflow-hidden rounded-2xl bg-linear-to-r from-blue-600 via-blue-500 to-blue-400 p-8 shadow-lg">
        {{-- Patrón decorativo --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-300/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-blue-300/10 rounded-full blur-2xl"></div>

        <div class="relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
                ¡Bienvenido al Sistema de Carpetas Territoriales!
            </h1>
            <p class="text-blue-50 text-lg mb-2">
                Gestiona y administra las estructuras territoriales del Partido Revolucionario Moderno.
            </p>
            <p class="text-blue-100 text-base mb-6">
                Accede a las carpetas, miembros y estadísticas de cada territorio.
            </p>

        </div>
    </div>

    {{-- Grid de métricas principales --}}
    <div id="estadisticas" class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        {{-- Personas Registradas --}}
        <div class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm
                   transition-all duration-300 hover:shadow-md hover:border-gray-300/50
                   dark:hover:border-gray-700 cursor-pointer"
            onclick="window.location.href='{{ route('people.index') }}'">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                        Personas Registradas
                    </p>
                    <p id="peopleCount" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $totalPeople }}
                    </p>
                </div>
                <div class="rounded-lg bg-indigo-50 dark:bg-indigo-950/30 p-3">
                    <i class="fas fa-users text-indigo-600 dark:text-indigo-400 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Provincias Activas --}}
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
                    <p id="provincesCount" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activeProvinces }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Total: {{ $totalProvinces }}
                    </p>
                </div>
                <div class="rounded-lg bg-rose-50 dark:bg-rose-950/30 p-3">
                    <i class="fas fa-map-marker-alt text-rose-600 dark:text-rose-400 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Municipios Activos --}}
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
                    <p id="municipalitiesCount" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activeMunicipalities }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Total: {{ $totalMunicipalities }}
                    </p>
                </div>
                <div class="rounded-lg bg-emerald-50 dark:bg-emerald-950/30 p-3">
                    <i class="fas fa-building text-emerald-600 dark:text-emerald-400 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Distritos Activos --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm
                   transition-all duration-300 hover:shadow-md hover:border-gray-300/50
                   dark:hover:border-gray-700">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                        Distritos Activos
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activeDistricts }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        Total: {{ $totalDistricts }}
                    </p>
                </div>
                <div class="rounded-lg bg-purple-50 dark:bg-purple-950/30 p-3">
                    <i class="fas fa-map text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de Agrupación por Tablas --}}
    <div class="grid gap-6 lg:grid-cols-2">
        {{-- Estructura Territorial --}}
        <div
            class="rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="rounded-lg bg-blue-50 dark:bg-blue-950/30 p-2">
                    <i class="fas fa-sitemap text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Estructura Territorial
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Organización geográfica del territorio
                    </p>
                </div>
            </div>

            <div class="space-y-3">
                <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-globe text-blue-600 dark:text-blue-400"></i>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Regiones</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $totalRegions }} activas</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </div>

                <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt text-rose-600 dark:text-rose-400"></i>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Provincias</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $activeProvinces }} de
                                {{ $totalProvinces }} activas</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </div>

                <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-building text-emerald-600 dark:text-emerald-400"></i>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Municipios</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $activeMunicipalities }} de
                                {{ $totalMunicipalities }} activos</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </div>

                <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-map text-purple-600 dark:text-purple-400"></i>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Distritos Municipales</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $activeDistricts }} de
                                {{ $totalDistricts }} activos</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </div>
            </div>
        </div>

        {{-- Gestión de Personas y Organizaciones --}}
        <div
            class="rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="rounded-lg bg-indigo-50 dark:bg-indigo-950/30 p-2">
                    <i class="fas fa-users-cog text-indigo-600 dark:text-indigo-400 text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Gestión de Personas
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Administración de miembros y organizaciones
                    </p>
                </div>
            </div>

            <div class="space-y-3">
                <a href="{{ route('people.index') }}"
                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors cursor-pointer">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-users text-indigo-600 dark:text-indigo-400"></i>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Miembros</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $totalPeople }} registrados</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>

                <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-briefcase text-amber-600 dark:text-amber-400"></i>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Cargos</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $totalPositions }} activos</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </div>

                <div
                    class="flex items-center justify-between p-4 rounded-lg bg-gray-50 dark:bg-gray-800/50 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-sitemap text-teal-600 dark:text-teal-400"></i>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Organizaciones</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $totalOrganizations }} activas</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    // Animación de contadores
    document.addEventListener('DOMContentLoaded', function() {
        function animateCount(id, target) {
            const element = document.getElementById(id);
            if (!element) return;

            const duration = 1500;
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Animar contadores
        @if (isset($totalPeople))
            animateCount('peopleCount', {{ $totalPeople }});
        @endif
        @if (isset($activeProvinces))
            animateCount('provincesCount', {{ $activeProvinces }});
        @endif
        @if (isset($activeMunicipalities))
            animateCount('municipalitiesCount', {{ $activeMunicipalities }});
        @endif
    });
</script>
