<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Provincias</h1>
        </div>

        <flux:button href="{{ route('provinces.create') }}" icon="plus" variant="primary">
            Agregar provincia
        </flux:button>
    </div>

    {{-- Search --}}
    <div class="flex gap-4 items-end">
        <div class="flex-1">
            <flux:field>
                <flux:label>Buscar por nombre</flux:label>
                <flux:input wire:model.live.debounce-300ms="search" placeholder="Ej: Santo Domingo"
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
            Resultados encontrados: <span class="font-semibold">{{ $provinces->total() }}</span>
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
                @forelse ($provinces as $province)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $province->name }}
                        </td>

                        <td class="px-4 py-3">
                            <flux:badge :color="$province->is_active ? 'green' : 'gray'">
                                {{ $province->is_active ? 'Activo' : 'Inactivo' }}
                            </flux:badge>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <flux:button href="{{ route('provinces.edit', $province) }}" size="sm"
                                    icon="pencil">
                                    Editar
                                </flux:button>

                                <flux:button wire:click="toggleActive({{ $province->id }})"
                                    variant="{{ $province->is_active ? 'ghost' : 'primary' }}" size="sm"
                                    icon="{{ $province->is_active ? 'x-circle' : 'check-circle' }}"
                                    class="min-w-[120px]">
                                    {{ $province->is_active ? 'Desactivar' : 'Activar' }}
                                </flux:button>

                                <flux:button wire:click="confirmDelete({{ $province->id }})" variant="danger" size="sm"
                                    icon="trash">
                                    Eliminar
                                </flux:button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            @if ($search)
                                No se encontraron provincias que coincidan con "{{ $search }}"
                            @else
                                No se encontraron provincias
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-end">
        {{ $provinces->links('components.flux-pagination') }}
    </div>

    {{-- Delete Confirmation Modal --}}
    <flux:modal name="confirm-delete" wire:model="showDeleteModal" @close="closeDeleteModal" focusable class="max-w-lg">
        <form wire:submit="delete" class="space-y-6">
            <div>
                <flux:heading size="lg">¿Estás seguro de que quieres eliminar esta provincia?</flux:heading>
                <flux:subheading>
                    Esta acción no se puede deshacer. Se eliminará permanentemente la provincia
                    @if($provinceToDelete)
                        <strong>"{{ $provinceToDelete->name }}"</strong>
                    @endif
                </flux:subheading>
            </div>

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="ghost">
                        Cancelar
                    </flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger">
                    Eliminar
                </flux:button>
            </div>
        </form>
    </flux:modal>

</div>
