<div class="space-y-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Crear organización</h1>
    </div>

    {{-- Form --}}
    <form wire:submit.prevent="save" class="max-w-2xl space-y-6">

        <flux:field>
            <flux:label>Nombre</flux:label>
            <flux:input wire:model.defer="name" placeholder="Ej: Comité de Base" :invalid="$errors->has('name')" />
            <flux:error name="name" />
        </flux:field>

        {{-- Actions --}}
        <div class="flex gap-3">
            <flux:button type="submit" variant="primary">
                Guardar
            </flux:button>

            <flux:button href="{{ route('organizations.index') }}" variant="ghost">
                Cancelar
            </flux:button>
        </div>

    </form>

</div>
