<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Crear persona</h1>
        </div>

        <flux:button href="{{ route('people.index') }}" variant="ghost" icon="arrow-left" size="sm">
            Volver atrás
        </flux:button>
    </div>

    <form wire:submit.prevent="save" class="space-y-5">

        {{-- Nombre completo --}}
        <flux:field>
            <flux:label>Nombre completo</flux:label>
            <flux:input wire:model.defer="full_name" placeholder="Juan Pérez" :invalid="$errors->has('full_name')" />
            <flux:error name="full_name" />
        </flux:field>

        {{-- Cédula --}}
        <flux:field>
            <flux:label>Cédula</flux:label>
            <flux:input wire:model.defer="national_id" placeholder="000-0000000-0"
                :invalid="$errors->has('national_id')" />
            <flux:error name="national_id" />
        </flux:field>

        {{-- Teléfono --}}
        <flux:field>
            <flux:label>Teléfono</flux:label>
            <flux:input wire:model.defer="phone" placeholder="809-000-0000" :invalid="$errors->has('phone')" />
            <flux:error name="phone" />
        </flux:field>

        {{-- Celular --}}
        <flux:field>
            <flux:label>Celular</flux:label>
            <flux:input wire:model.defer="mobile" placeholder="829-000-0000" :invalid="$errors->has('mobile')" />
            <flux:error name="mobile" />
        </flux:field>

        {{-- Teléfono oficina --}}
        <flux:field>
            <flux:label>Teléfono oficina</flux:label>
            <flux:input wire:model.defer="office_phone" placeholder="809-000-0000"
                :invalid="$errors->has('office_phone')" />
            <flux:error name="office_phone" />
        </flux:field>

        {{-- Email --}}
        <flux:field>
            <flux:label>Email</flux:label>
            <flux:input type="email" wire:model.defer="email" placeholder="correo@ejemplo.com"
                :invalid="$errors->has('email')" />
            <flux:error name="email" />
        </flux:field>

        {{-- Dirección --}}
        <flux:field>
            <flux:label>Dirección</flux:label>
            <flux:textarea wire:model.defer="address" rows="3" :invalid="$errors->has('address')" />
            <flux:error name="address" />
        </flux:field>

        {{-- Provincia --}}
        <flux:field>
            <flux:label>Provincia</flux:label>
            <flux:select wire:model.live="province_id">
                <option value="">Seleccione una provincia</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="province_id" />
        </flux:field>

        {{-- Municipio --}}
        <flux:field>
            <flux:label>Municipio</flux:label>
            <flux:select wire:model.live="municipality_id" :disabled="!$province_id">
                <option value="">Seleccione un municipio</option>
                @foreach ($municipalities as $municipality)
                    <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="municipality_id" />
        </flux:field>

        {{-- Distrito --}}
        <flux:field>
            <flux:label>Distrito municipal</flux:label>
            <flux:select wire:model.live="district_id" :disabled="!$municipality_id">
                <option value="">Seleccione un distrito</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="district_id" />
        </flux:field>

        {{-- Circunscripción --}}
        <flux:field>
            <flux:label>Circunscripción</flux:label>
            <flux:select wire:model.live="circumscription">
                <option value="">Seleccione una circunscripción</option>
                @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </flux:select>
            <flux:error name="circumscription" />
        </flux:field>

        {{-- Cargo / Posición --}}
        <flux:field>
            <flux:label>Posición</flux:label>
            <flux:select wire:model.live="position_id">
                <option value="">Seleccione una posición</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="position_id" />
        </flux:field>

        {{-- Organización --}}
        <flux:field>
            <flux:label>Organización</flux:label>
            <flux:select wire:model.live="organization_id">
                <option value="">Seleccione una organización</option>
                @foreach ($organizations as $organization)
                    <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                @endforeach
            </flux:select>
            <flux:error name="organization_id" />
        </flux:field>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <flux:button href="{{ route('people.index') }}" variant="ghost">
                Cancelar
            </flux:button>

            <flux:button type="submit" variant="primary" icon="check">
                Guardar
            </flux:button>
        </div>
    </form>
</div>
