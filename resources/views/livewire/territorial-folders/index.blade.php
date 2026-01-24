<div class="flex h-full w-full flex-1 flex-col gap-8">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="rounded-lg bg-blue-50 dark:bg-blue-950/30 p-2">
                <i class="fas fa-folder text-blue-600 dark:text-blue-400 text-xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Carpetas Territoriales</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Gestiona y visualiza las estructuras territoriales del partido
                </p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <flux:button wire:click="exportPdf" variant="ghost" class="hidden sm:flex">
                <i class="fas fa-download mr-2"></i>
                Exportar PDF
            </flux:button>
            {{--
                <flux:button href="#" variant="primary" icon="plus">
                    Nueva Carpeta
                </flux:button>
            --}}
        </div>
    </div>

    {{-- Tarjetas de Estadísticas --}}
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        {{-- Total Carpetas --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm
                   transition-all duration-300 hover:shadow-md hover:border-gray-300/50
                   dark:hover:border-gray-700">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                        Total Carpetas
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $totalFolders }}
                    </p>
                </div>
                <div class="rounded-lg bg-blue-50 dark:bg-blue-950/30 p-3">
                    <i class="fas fa-folder text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Miembros Registrados --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800
                   bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm
                   transition-all duration-300 hover:shadow-md hover:border-gray-300/50
                   dark:hover:border-gray-700">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">
                        Miembros Registrados
                    </p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $totalMembers }}
                    </p>
                </div>
                <div class="rounded-lg bg-purple-50 dark:bg-purple-950/30 p-3">
                    <i class="fas fa-users text-purple-600 dark:text-purple-400 text-xl"></i>
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
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activeProvinces }}
                    </p>
                </div>
                <div class="rounded-lg bg-pink-50 dark:bg-pink-950/30 p-3">
                    <i class="fas fa-map-marker-alt text-pink-600 dark:text-pink-400 text-xl"></i>
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
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $activeMunicipalities }}
                    </p>
                </div>
                <div class="rounded-lg bg-purple-50 dark:bg-purple-950/30 p-3">
                    <i class="fas fa-building text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtros --}}
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">

        {{-- Filtro Región --}}
        <flux:field>
            <flux:label>
                <i class="fas fa-paper-plane mr-2 text-gray-500"></i>
                Región
            </flux:label>
            <flux:select wire:model.live="selectedRegion">
                <option value="">Seleccionar Región</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </flux:select>
        </flux:field>

        {{-- Filtro Provincia --}}
        <flux:field>
            <flux:label>
                <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i>
                PROVINCIA
            </flux:label>
            <flux:select wire:model.live="selectedProvince" :disabled="!$selectedRegion">
                <option value="">Seleccionar provincia</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </flux:select>
        </flux:field>

        {{-- Filtro Municipio --}}
        <flux:field>
            <flux:label>
                <i class="fas fa-building mr-2 text-gray-500"></i>
                MUNICIPIO
            </flux:label>
            <flux:select wire:model.live="selectedMunicipality" :disabled="!$selectedProvince">
                <option value="">Seleccionar municipio</option>
                @foreach ($municipalities as $municipality)
                    <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                @endforeach
            </flux:select>
        </flux:field>

        {{-- Filtro DM (Distrito Municipal) --}}
        <flux:field>
            <flux:label>
                <i class="fas fa-building mr-2 text-gray-500"></i>
                DM
            </flux:label>
            <flux:select wire:model.live="selectedDistrict" :disabled="!$selectedMunicipality">
                <option value="">Seleccionar DM</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </flux:select>
        </flux:field>


    </div>

    {{-- Sección de Resultados --}}
    <div class="space-y-6">
        {{-- Header de Resultados --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="rounded-lg bg-blue-50 dark:bg-blue-950/30 p-2">
                    <i class="fas fa-folder text-blue-600 dark:text-blue-400 text-lg"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Resultados</h2>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $folders->count() }} carpetas encontradas
            </p>
        </div>

        {{-- Lista de Carpetas --}}
        <div class="space-y-4">
            @forelse ($folders as $folder)
                <div wire:click="selectFolder({{ $folder['id'] }})"
                    class="cursor-pointer rounded-xl border-2 transition-all duration-200
                           {{ $selectedFolder == $folder['id']
                               ? 'border-amber-400 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-950/30 dark:to-orange-950/30 shadow-lg'
                               : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 hover:border-gray-300 dark:hover:border-gray-600 hover:shadow-md' }}">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <div
                                        class="rounded-lg {{ $selectedFolder == $folder['id'] ? 'bg-amber-100 dark:bg-amber-900/50' : 'bg-blue-50 dark:bg-blue-950/30' }} p-2">
                                        <i
                                            class="fas fa-folder {{ $selectedFolder == $folder['id'] ? 'text-amber-700 dark:text-amber-400' : 'text-blue-600 dark:text-blue-400' }} text-lg"></i>
                                    </div>
                                    <h3
                                        class="text-lg font-semibold {{ $selectedFolder == $folder['id'] ? 'text-amber-900 dark:text-amber-100' : 'text-gray-900 dark:text-white' }}">
                                        {{ $folder['name'] }}
                                    </h3>
                                </div>
                                <div
                                    class="mt-2 text-sm {{ $selectedFolder == $folder['id'] ? 'text-amber-800 dark:text-amber-200' : 'text-gray-600 dark:text-gray-400' }}">
                                    Provincia: {{ $folder['province'] }}
                                    @if ($folder['municipality'])
                                        | Municipio: {{ $folder['municipality'] }}
                                    @endif
                                    @if ($folder['district'])
                                        | DM: {{ $folder['district'] }}
                                    @endif
                                    @if ($folder['region'])
                                        | Zona: {{ $folder['region'] }}
                                    @endif
                                </div>
                            </div>
                            <div class="ml-4">
                                <div
                                    class="rounded-lg {{ $selectedFolder == $folder['id'] ? 'bg-amber-200 dark:bg-amber-800/50' : 'bg-gray-100 dark:bg-gray-800' }} px-3 py-1.5">
                                    <div class="flex items-center gap-2">
                                        <i
                                            class="fas fa-users {{ $selectedFolder == $folder['id'] ? 'text-amber-700 dark:text-amber-300' : 'text-gray-600 dark:text-gray-400' }} text-sm"></i>
                                        <span
                                            class="text-sm font-medium {{ $selectedFolder == $folder['id'] ? 'text-amber-900 dark:text-amber-100' : 'text-gray-700 dark:text-gray-300' }}">
                                            {{ $folder['members_count'] }} miembros
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-12 text-center">
                    <i class="fas fa-folder-open text-4xl text-gray-400 dark:text-gray-600 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">No se encontraron carpetas con los filtros seleccionados
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Tabla de Miembros --}}
        @if ($selectedFolder && $members->count() > 0)
            <div
                class="mt-8 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-200">Cargo
                                </th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-200">Nombre
                                    Completo</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-200">Cédula
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($members as $member)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-100">
                                        {{ $member['position'] }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-100">
                                        {{ $member['full_name'] }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-100">
                                        {{ $member['national_id'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

</div>
