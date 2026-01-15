<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <flux:heading size="lg">
            Empleados
        </flux:heading>

        <flux:button href="{{ route('employees.create') }}" icon="plus" variant="primary">
            Agregar empleado
        </flux:button>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Name</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Phone</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Position</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Status</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-700 dark:text-gray-200">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($employees as $employee)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $employee->name }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $employee->phone }}
                        </td>

                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                            {{ $employee->position }}
                        </td>

                        <td class="px-4 py-3">
                            <flux:badge :color="$employee->status === 'active' ? 'green' : 'red'">
                                {{ ucfirst($employee->status) }}
                            </flux:badge>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex gap-3">
                                <flux:button href="{{ route('employees.edit', $employee) }}"
                                    size="sm" icon="pencil">
                                    Edit
                                </flux:button>

                                <flux:button wire:click="delete({{ $employee->id }})"
                                    variant="danger" size="sm" icon="trash">
                                    Delete
                                </flux:button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5"
                            class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            No employees found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-end">
        {{ $employees->links('components.flux-pagination') }}
    </div>

</div>
