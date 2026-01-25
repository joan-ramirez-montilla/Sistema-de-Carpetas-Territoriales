<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Editar persona
        </h1>

        <flux:button href="{{ route('people.index') }}" variant="ghost" icon="arrow-left" size="sm">
            Volver atrás
        </flux:button>
    </div>

    <form wire:submit.prevent="update" class="space-y-5">

        {{-- Nombre completo --}}
        <flux:field>
            <flux:label>Nombre completo</flux:label>
            <flux:input wire:model.defer="full_name" :invalid="$errors->has('full_name')" />
            <flux:error name="full_name" />
        </flux:field>

        {{-- Cédula --}}
        <flux:field>
            <flux:label>Cédula</flux:label>
            <flux:input wire:model.defer="national_id" x-data="dominicanoInput('national_id')" @input="formatNationalId"
                placeholder="000-0000000-0" maxlength="13" :invalid="$errors->has('national_id')" />
            <flux:error name="national_id" />
        </flux:field>

        {{-- Teléfono --}}
        <flux:field>
            <flux:label>Teléfono</flux:label>
            <flux:input wire:model.defer="phone" x-data="dominicanoInput('phone')" @input="formatPhone" placeholder="809-000-0000"
                maxlength="12" :invalid="$errors->has('phone')" />
            <flux:error name="phone" />
        </flux:field>

        {{-- Celular --}}
        <flux:field>
            <flux:label>Celular</flux:label>
            <flux:input wire:model.defer="mobile" x-data="dominicanoInput('mobile')" @input="formatPhone"
                placeholder="829-000-0000" maxlength="12" :invalid="$errors->has('mobile')" />
            <flux:error name="mobile" />
        </flux:field>

        {{-- Teléfono oficina --}}
        <flux:field>
            <flux:label>Teléfono oficina</flux:label>
            <flux:input wire:model.defer="office_phone" x-data="dominicanoInput('office_phone')" @input="formatPhone"
                placeholder="809-000-0000" maxlength="12" :invalid="$errors->has('office_phone')" />
            <flux:error name="office_phone" />
        </flux:field>

        {{-- Email --}}
        <flux:field>
            <flux:label>Email</flux:label>
            <flux:input type="email" wire:model.defer="email" />
            <flux:error name="email" />
        </flux:field>

        {{-- Dirección --}}
        <flux:field>
            <flux:label>Dirección</flux:label>
            <flux:textarea wire:model.defer="address" rows="3" />
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


        {{-- Posición --}}
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
                Actualizar
            </flux:button>
        </div>
    </form>
</div>

<script>
    function dominicanoInput(fieldName) {
        return {
            formatNationalId(e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.length > 11) {
                    value = value.slice(0, 11);
                }

                if (value.length <= 3) {
                    e.target.value = value;
                } else if (value.length <= 10) {
                    e.target.value = value.slice(0, 3) + '-' + value.slice(3);
                } else {
                    e.target.value = value.slice(0, 3) + '-' + value.slice(3, 10) + '-' + value.slice(10);
                }

                // Actualizar wire:model
                @this.set(fieldName, e.target.value);
            },
            formatPhone(e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.length > 10) {
                    value = value.slice(0, 10);
                }

                if (value.length <= 3) {
                    e.target.value = value;
                } else if (value.length <= 6) {
                    e.target.value = value.slice(0, 3) + '-' + value.slice(3);
                } else {
                    e.target.value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6);
                }

                // Actualizar wire:model
                @this.set(fieldName, e.target.value);
            }
        }
    }
</script>
