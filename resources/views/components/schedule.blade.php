@php
    $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
    $hours = [];
    for ($h = 6; $h <= 22; $h++) {
        $hours[] = sprintf('%02d:00', $h);
        $hours[] = sprintf('%02d:30', $h);
    }
    function format12($time) { return date('h:i A', strtotime($time)); }

    // Valores por defecto si no se pasan desde el include
    $title = $title ?? 'Calendario y Horario';
    $description = $description ?? 'Activa los días de atención y define el horario de apertura y cierre.';
@endphp

<div class="space-y-4">
    <flux:heading size="md">{{ $title }}</flux:heading>
    <p class="text-sm text-gray-500 dark:text-gray-400">
        {{ $description }}
    </p>

    <div class="flex flex-col gap-3">
        @foreach ($days as $day)
            <flux:field>
                <div class="flex items-center gap-3">
                    <input type="checkbox" wire:model.defer="schedule.{{ $day }}.active"
                        class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 checked:bg-primary checked:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    <span class="w-24 text-gray-700 dark:text-gray-200">{{ $day }}</span>

                    <select wire:model.defer="schedule.{{ $day }}.start"
                        class="border border-gray-300 dark:border-gray-700 rounded-md px-2 py-1 text-sm focus:ring-1 focus:ring-primary focus:border-primary">
                        @foreach ($hours as $hour)
                            <option value="{{ $hour }}">{{ format12($hour) }}</option>
                        @endforeach
                    </select>

                    <span class="mx-1 text-gray-500">a</span>

                    <select wire:model.defer="schedule.{{ $day }}.end"
                        class="border border-gray-300 dark:border-gray-700 rounded-md px-2 py-1 text-sm focus:ring-1 focus:ring-primary focus:border-primary">
                        @foreach ($hours as $hour)
                            <option value="{{ $hour }}">{{ format12($hour) }}</option>
                        @endforeach
                    </select>
                </div>
                @error("schedule.$day.active")
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
                @error("schedule.$day.start")
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
                @error("schedule.$day.end")
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>
        @endforeach
    </div>
</div>
