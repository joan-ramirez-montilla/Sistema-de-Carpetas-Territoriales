<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Crear municipio</h1>
        </div>

        <flux:button href="{{ route('municipalities.index') }}" variant="ghost" icon="arrow-left" size="sm">
            Volver atrás
        </flux:button>
    </div>

    <form wire:submit.prevent="save" class="space-y-5 max-w-md">

        {{-- Nombre --}}
        <flux:field>
            <flux:label>Nombre</flux:label>
            <flux:input wire:model.defer="name" placeholder="Ej: Distrito Nacional" :invalid="$errors->has('name')" />
            <flux:error name="name" />
        </flux:field>

        {{-- Provincia --}}
        <flux:field>
            <flux:label>Provincia</flux:label>
            <flux:select wire:model.defer="province_id" :invalid="$errors->has('province_id')">
                <option value="">Seleccione una provincia</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="province_id" />
        </flux:field>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <flux:button href="{{ route('municipalities.index') }}" variant="ghost">
                Cancelar
            </flux:button>

            <flux:button type="submit" variant="primary" icon="check">
                Guardar
            </flux:button>
        </div>
    </form>
</div>
