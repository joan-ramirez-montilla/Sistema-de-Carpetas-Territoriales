<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Editar provincia</h1>
        </div>

        <flux:button href="{{ route('provinces.index') }}" variant="ghost" icon="arrow-left" size="sm">
            Volver atrás
        </flux:button>
    </div>

    <form wire:submit.prevent="save" class="space-y-5 max-w-md">

        {{-- Nombre --}}
        <flux:field>
            <flux:label>Nombre</flux:label>
            <flux:input wire:model.defer="name" placeholder="Ej: Santo Domingo" :invalid="$errors->has('name')" />
            <flux:error name="name" />
        </flux:field>

        {{-- Región --}}
        <flux:field>
            <flux:label>Región</flux:label>
            <flux:select wire:model.defer="region_id" :invalid="$errors->has('region_id')">
                <option value="">Seleccione una región</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="region_id" />
        </flux:field>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <flux:button href="{{ route('provinces.index') }}" variant="ghost">
                Cancelar
            </flux:button>

            <flux:button type="submit" variant="primary" icon="check">
                Actualizar
            </flux:button>
        </div>
    </form>
</div>
