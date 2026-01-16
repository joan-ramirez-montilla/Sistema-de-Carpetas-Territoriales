<div class="space-y-6">

    <div class="flex items-center justify-between">
        <flux:heading size="lg">
            Editar Servicio
        </flux:heading>

        <flux:button
            href="{{ route('services.index') }}"
            variant="ghost"
            icon="arrow-left"
            size="sm">
            Volver atrás
        </flux:button>
    </div>

    <form wire:submit.prevent="save" class="space-y-5">

        {{-- Name --}}
        <flux:field>
            <flux:label>Nombre</flux:label>
            <flux:input
                wire:model.defer="name"
                placeholder="Corte clásico"
                :invalid="$errors->has('name')"
            />
            <flux:error name="name" />
        </flux:field>

        {{-- Description --}}
        <flux:field>
            <flux:label>Descripción</flux:label>
            <flux:input
                wire:model.defer="description"
                placeholder="Descripción del servicio"
                :invalid="$errors->has('description')"
            />
            <flux:error name="description" />
        </flux:field>

        {{-- Price --}}
        <flux:field>
            <flux:label>Precio</flux:label>
            <flux:input
                wire:model.defer="price"
                type="number"
                step="0.01"
                placeholder="0.00"
                :invalid="$errors->has('price')"
            />
            <flux:error name="price" />
        </flux:field>

        {{-- Duration --}}
        <flux:field>
            <flux:label>Duración (minutos)</flux:label>
            <flux:input
                wire:model.defer="duration"
                type="number"
                placeholder="30"
                :invalid="$errors->has('duration')"
            />
            <flux:error name="duration" />
        </flux:field>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <flux:button
                href="{{ route('services.index') }}"
                variant="ghost"
            >
                Cancelar
            </flux:button>

            <flux:button
                type="submit"
                variant="primary"
                icon="check"
            >
                Actualizar
            </flux:button>
        </div>
    </form>
</div>
