<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Profile Settings') }}</flux:heading>

    <x-settings.layout heading="Perfil" subheading="Actualice su foto, nombre y dirección de correo electrónico">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">

            <flux:input wire:model="photo" label="Foto" type="file" accept="image/*" />

            <div class="mb-4">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}" class="w-25 h-25 rounded-full object-cover">
                @elseif (Auth::user()->photo_path)
                    <img src="{{ asset('storage/' . Auth::user()->photo_path) }}"
                        class="w-25 h-25 rounded-full object-cover">
                @else
                    <div class="w-25 h-25 rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Foto</span>
                    </div>
                @endif
            </div>

            <flux:input wire:model="name" label="Nombre" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" label="Correo electrónico" type="email" required
                    autocomplete="email" />

                @if ($this->hasUnverifiedEmail)
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="text-sm cursor-pointer"
                                wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">Guardar</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    Guardado.
                </x-action-message>
            </div>
        </form>

        @if (false)
            <livewire:settings.delete-user-form />
        @endif
    </x-settings.layout>
</section>
