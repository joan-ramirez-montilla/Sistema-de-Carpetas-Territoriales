<div class="space-y-10">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <flux:heading size="lg">
            Configuración de la Empresa
        </flux:heading>
    </div>

    <form wire:submit.prevent="save" class="space-y-8" enctype="multipart/form-data">

        {{-- Sección: Información General --}}
        <div class="space-y-4">
            <flux:heading size="md">Información General</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Ingresa los datos básicos de tu empresa, como nombre, logo, teléfono, correo y ubicación.
            </p>



            <flux:field>
                <flux:label>Nombre de la empresa</flux:label>
                <flux:input wire:model.defer="name" placeholder="Barberia" :invalid="$errors->has('name')" />
                @error('name')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>

            <flux:field>
                <flux:label>Logo</flux:label>

                @if ($logo_path)
                    <img src="{{ asset('storage/logos/' . $logo_path) }}" alt="Logo"
                    class="h-30 mt-2 mb-2">
                @endif

                <flux:input type="file" wire:model="logo" accept="image/*" :invalid="$errors->has('logo')" />
                @error('logo')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>

            <flux:field>
                <flux:label>Teléfono</flux:label>
                <flux:input wire:model.defer="phone" placeholder="809-000-0000" />
                @error('phone')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>

            <flux:field>
                <flux:label>Correo electrónico</flux:label>
                <flux:input wire:model.defer="email" type="email" placeholder="contacto@empresa.com" />
                @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>

            <flux:field>
                <flux:label>Ubicación (Google Maps URL)</flux:label>
                <flux:input wire:model.defer="map_url" placeholder="https://maps.google.com/..." />
                @error('map_url')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>
        </div>

        {{-- Sección: Colores y Branding --}}
        <div class="space-y-4">
            <flux:heading size="md">Colores y Branding</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Define los colores principales de tu marca para mantener consistencia en tu diseño y branding.
            </p>

            <flux:field>
                <flux:label>Color primario</flux:label>
                <flux:input wire:model.defer="primary_color" type="color" title="Color Primario" />
                @error('primary_color')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>

            <flux:field>
                <flux:label>Color secundario</flux:label>
                <flux:input wire:model.defer="secondary_color" type="color" title="Color Secundario" />
                @error('secondary_color')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </flux:field>
        </div>

        {{-- Sección: Calendario y Horario --}}
        <div class="space-y-4">
            <flux:heading size="md">Calendario y Horario</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Activa los días de atención y define el horario de apertura y cierre.
            </p>

            <div class="flex flex-col gap-3">
                @php
                    $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                    $hours = [];
                    for ($h = 6; $h <= 22; $h++) {
                        $hours[] = sprintf('%02d:00', $h);
                        $hours[] = sprintf('%02d:30', $h);
                    }
                    function format12($time) { return date('h:i A', strtotime($time)); }
                @endphp

                @foreach ($days as $day)
                    <flux:field>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" wire:model.defer="schedule.{{ $day }}.active"
                                class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 checked:bg-primary checked:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                            <span class="w-24 text-gray-700 dark:text-gray-200">{{ $day }}</span>

                            <select wire:model.defer="schedule.{{ $day }}.start"
                                class="border border-gray-300 dark:border-gray-700 rounded-md px-2 py-1 text-sm focus:ring-1 focus:ring-primary focus:border-primary"
                                @if (!($schedule[$day]['active'] ?? false)) disabled @endif>
                                @foreach ($hours as $hour)
                                    <option value="{{ $hour }}">{{ format12($hour) }}</option>
                                @endforeach
                            </select>

                            <span class="mx-1 text-gray-500">a</span>

                            <select wire:model.defer="schedule.{{ $day }}.end"
                                class="border border-gray-300 dark:border-gray-700 rounded-md px-2 py-1 text-sm focus:ring-1 focus:ring-primary focus:border-primary"
                                @if (!($schedule[$day]['active'] ?? false)) disabled @endif>
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

        {{-- Sección: Redes Sociales --}}
        <div class="space-y-4">
            <flux:heading size="md">Redes Sociales</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Agrega las URLs de tus redes sociales para mostrar en tu sitio web o contacto.
            </p>

            <flux:field>
                <flux:label>Facebook</flux:label>
                <flux:input wire:model.defer="facebook" placeholder="https://facebook.com/tuempresa" />
                @error('facebook') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Instagram</flux:label>
                <flux:input wire:model.defer="instagram" placeholder="https://instagram.com/tuempresa" />
                @error('instagram') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Twitter</flux:label>
                <flux:input wire:model.defer="twitter" placeholder="https://twitter.com/tuempresa" />
                @error('twitter') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </flux:field>

            <flux:field>
                <flux:label>WhatsApp</flux:label>
                <flux:input wire:model.defer="whatsapp" placeholder="https://wa.me/1234567890" />
                @error('whatsapp') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </flux:field>
        </div>

        {{-- Sección: SEO --}}
        <div class="space-y-4">
            <flux:heading size="md">SEO</flux:heading>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Completa la información SEO para mejorar la visibilidad en buscadores.
            </p>

            <flux:field>
                <flux:label>Title</flux:label>
                <flux:input wire:model.defer="seo_title" placeholder="Barberia" />
                @error('seo_title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Description</flux:label>
                <flux:textarea wire:model.defer="seo_description" placeholder="" />
                @error('seo_description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </flux:field>

            <flux:field>
                <flux:label>Keywords</flux:label>
                <flux:input wire:model.defer="seo_keywords" placeholder="" />
                @error('seo_keywords') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </flux:field>
        </div>

        {{-- Acciones --}}
        <div class="flex justify-end gap-3 pt-6">
            <flux:button type="submit" variant="primary" icon="check">
                Guardar
            </flux:button>
        </div>

    </form>
</div>
