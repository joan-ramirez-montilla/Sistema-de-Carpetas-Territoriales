<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Organizaciones</h1>
        </div>

        <flux:button href="{{ route('organizations.create') }}" icon="plus" variant="primary">
            Agregar organización
        </flux:button>
    </div>

    {{-- Search --}}
    <div class="flex gap-4 items-end">
        <div class="flex-1">
            <flux:field>
                <flux:label>Buscar por nombre</flux:label>
                <flux:input wire:model.live.debounce-300ms="search" placeholder="Ej: Comité de Base"
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
            Resultados encontrados: <span class="font-semibold">{{ $organizations->total() }}</span>
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Nombre</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Estado</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($organizations as $organization)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $organization->name }}
                        </td>

                        <td class="px-4 py-3">
                            <flux:badge :color="$organization->is_active ? 'green' : 'gray'">
                                {{ $organization->is_active ? 'Activo' : 'Inactivo' }}
                            </flux:badge>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <flux:button href="{{ route('organizations.edit', $organization) }}" size="sm"
                                    icon="pencil">
                                    Editar
                                </flux:button>

                                <flux:button wire:click="toggleActive({{ $organization->id }})"
                                    variant="{{ $organization->is_active ? 'ghost' : 'primary' }}" size="sm"
                                    icon="{{ $organization->is_active ? 'x-circle' : 'check-circle' }}">
                                    {{ $organization->is_active ? 'Desactivar' : 'Activar' }}
                                </flux:button>

                                <flux:button wire:click="delete({{ $organization->id }})" variant="danger"
                                    size="sm" icon="trash">
                                    Eliminar
                                </flux:button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            @if ($search)
                                No se encontraron organizaciones que coincidan con "{{ $search }}"
                            @else
                                No se encontraron organizaciones
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-end">
        {{ $organizations->links('components.flux-pagination') }}
    </div>

</div>
