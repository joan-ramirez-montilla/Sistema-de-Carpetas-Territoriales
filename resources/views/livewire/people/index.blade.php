<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Personas</h1>
        </div>

        <flux:button href="{{ route('people.create') }}" icon="plus" variant="primary">
            Agregar persona
        </flux:button>
    </div>

    {{-- Search --}}
    <div class="flex gap-4 items-end">
        <div class="flex-1">
            <flux:field>
                <flux:label>Buscar por nombre o cédula</flux:label>
                <flux:input wire:model.live.debounce-300ms="search" placeholder="Ej: Juan Pérez o 001-0000000-0"
                    icon="magnifying-glass" />
            </flux:field>
        </div>

        @if ($search)
            <flux:button wire:click="$set('search', '')" variant="ghost" icon="x-mark" size="sm">
                Limpiar
            </flux:button>
        @endif
    </div>

    {{-- Results count --}}
    @if ($search)
        <div class="text-sm text-gray-600 dark:text-gray-400">
            Resultados encontrados: <span class="font-semibold">{{ $people->total() }}</span>
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Nombre</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Cédula</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Número de teléfono</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($people as $person)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $person->full_name }}
                        </td>

                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300 text-xs">
                            {{ $person->national_id ?? '-' }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $person->phone ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <flux:button href="{{ route('people.edit', $person) }}" size="sm" icon="pencil">
                                    Editar
                                </flux:button>

                                <flux:button wire:click="delete({{ $person->id }})" variant="danger" size="sm"
                                    icon="trash">
                                    Eliminar
                                </flux:button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            @if ($search)
                                No se encontraron personas que coincidan con "{{ $search }}"
                            @else
                                No se encontraron personas
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-end">
        {{ $people->links('components.flux-pagination') }}
    </div>

</div>
