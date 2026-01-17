<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Citas</h1>
        </div>
    </div>


    {{-- Filtros --}}
    <div class="flex flex-col sm:flex-row gap-4 mb-4">

        @if (auth()->user()->role == 'admin')
            {{-- Empleado --}}
            <div>
                <flux:select wire:model="filterEmployee" label="Empleado">
                    <option value="">Todos</option>
                </flux:select>
            </div>
        @endif

        {{-- Fecha --}}
        <div>
            <flux:input type="date" wire:model="filterDate" label="Fecha" />
        </div>

        {{-- Estado --}}
        <div>
            <flux:select wire:model="filterStatus" label="Estado">
                <option value="">Todos</option>
                <option value="scheduled">Agendada</option>
                <option value="completed">Completada</option>
                <option value="canceled">Cancelada</option>
            </flux:select>
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Cliente</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Celular</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Servicio</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Fecha</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Hora</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Estado</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Acciones</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($appointments as $appointment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $appointment->client_name }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $appointment->phone }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $appointment->service->name ?? 'N/A' }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $appointment->appointment_date->format('d/m/Y') }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                        </td>

                        <td class="px-4 py-3">
                            <flux:badge
                                :color="
                                                                $appointment->status === 'scheduled' ? 'blue' :
                                                                ($appointment->status === 'completed' ? 'green' : 'red')
                                ">
                                {{ ucfirst($appointment->status) }}
                            </flux:badge>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <flux:button href="{{ route('appointments.edit', $appointment) }}" size="sm"
                                    icon="pencil">
                                    Editar
                                </flux:button>

                                <flux:button wire:click="delete({{ $appointment->id }})" variant="danger" size="sm"
                                    icon="trash">
                                    Eliminar
                                </flux:button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            No se encontraron citas
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-end">
        {{ $appointments->links('components.flux-pagination') }}
    </div>

</div>
