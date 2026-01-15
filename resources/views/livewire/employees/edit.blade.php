<div class="space-y-6">

    <div class="flex items-center justify-between">
        <flux:heading size="lg">
            Editar empleado
        </flux:heading>

        <flux:button
            href="{{ route('employees.index') }}"
            variant="ghost"
            icon="arrow-left"
            size="sm">
            Volver atras
        </flux:button>
    </div>

    <form wire:submit.prevent="save" class="space-y-5">

        {{-- Name --}}
        <flux:field>
            <flux:label>Name</flux:label>
            <flux:input
                wire:model.defer="name"
                placeholder="John Doe"
                :invalid="$errors->has('name')"
            />
            <flux:error name="name" />
        </flux:field>

        {{-- Phone --}}
        <flux:field>
            <flux:label>Phone</flux:label>
            <flux:input
                wire:model.defer="phone"
                placeholder="809-000-0000"
                :invalid="$errors->has('phone')"
            />
            <flux:error name="phone" />
        </flux:field>

        {{-- Email --}}
        <flux:field>
            <flux:label>Email</flux:label>
            <flux:input
                wire:model.defer="email"
                placeholder="email@example.com"
                :invalid="$errors->has('email')"
            />
            <flux:error name="email" />
        </flux:field>

        {{-- Position --}}
        <flux:field>
            <flux:label>Position</flux:label>
            <flux:input
                wire:model.defer="position"
                placeholder="Cashier"
                :invalid="$errors->has('position')"
            />
            <flux:error name="position" />
        </flux:field>

        {{-- Status --}}
        <flux:field>
            <flux:label>Status</flux:label>
            <flux:select
                wire:model.defer="status"
                :invalid="$errors->has('status')"
            >
                <option value="">Select status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </flux:select>
            <flux:error name="status" />
        </flux:field>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <flux:button
                href="{{ route('employees.index') }}"
                variant="ghost"
            >
                Cancel
            </flux:button>

            <flux:button
                type="submit"
                variant="primary"
                icon="check"
            >
                Update
            </flux:button>
        </div>
    </form>
</div>
