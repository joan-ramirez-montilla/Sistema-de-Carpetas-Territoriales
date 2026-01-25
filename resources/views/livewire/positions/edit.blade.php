<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Editar cargo</h1>
        </div>

        <flux:button href="{{ route('positions.index') }}" variant="ghost" icon="arrow-left" size="sm">
            Volver atrás
        </flux:button>
    </div>

    <form wire:submit.prevent="save" class="space-y-5 max-w-md">

        {{-- Nombre --}}
        <flux:field>
            <flux:label>Nombre</flux:label>
            <flux:input wire:model.defer="name" placeholder="Ej: Coordinador de Base" :invalid="$errors->has('name')" />
            <flux:error name="name" />
        </flux:field>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <flux:button href="{{ route('positions.index') }}" variant="ghost">
                Cancelar
            </flux:button>

            <flux:button type="submit" variant="primary" icon="check">
                Actualizar
            </flux:button>
        </div>
    </form>
</div>
