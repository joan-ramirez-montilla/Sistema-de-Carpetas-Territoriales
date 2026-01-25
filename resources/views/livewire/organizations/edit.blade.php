<div class="space-y-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Editar organización</h1>
    </div>

    {{-- Form --}}
    <form wire:submit="update" class="max-w-2xl space-y-6">

        <flux:field>
            <flux:label for="name">Nombre</flux:label>
            <flux:input wire:model.blur="form.name" id="name" type="text" placeholder="Ej: Comité de Base"
                @error('form.name') error @enderror />
            @error('form.name')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </flux:field>

        {{-- Actions --}}
        <div class="flex gap-3">
            <flux:button type="submit" variant="primary">
                Actualizar
            </flux:button>

            <flux:button href="{{ route('organizations.index') }}" variant="ghost">
                Cancelar
            </flux:button>
        </div>

    </form>

</div>
