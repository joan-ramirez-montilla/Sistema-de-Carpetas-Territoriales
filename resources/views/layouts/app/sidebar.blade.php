<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <x-alert />

    <flux:sidebar sticky collapsible="mobile"
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group heading="Plataforma" class="grid">
                <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')">
                    Inicio
                </flux:sidebar.item>

                @if (auth()->user()->role == 'admin')
                    <flux:sidebar.item icon="folder-git-2" :href="route('employees.index')"
                        :current="request()->routeIs('employees.*')" wire:navigate>
                        Empleados
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="book-open-text" :href="route('services.index')"
                        :current="request()->routeIs('services.*')" wire:navigate>
                        Servicios
                    </flux:sidebar.item>
                @endif

                @if (auth()->user()->role == 'employee')
                    <flux:sidebar.item icon="book-open-text" :href="route('employees.gallery')"
                        :current="request()->routeIs('employees.gallery')" wire:navigate>
                        Galería de Cortes
                    </flux:sidebar.item>
                @endif

                <flux:sidebar.item icon="book-open-text" :href="route('appointments.index')"
                    :current="request()->routeIs('appointments.*')" wire:navigate>
                    Citas
                </flux:sidebar.item>

            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />


        @if (auth()->user()->role == 'admin')
            <flux:sidebar.nav>
                <flux:sidebar.item icon="home" :href="route('company-settings.index')"
                    :current="request()->routeIs('company-settings.*')" wire:navigate>
                    Empresa
                </flux:sidebar.item>
            </flux:sidebar.nav>
        @endif

        <x-desktop-user-menu class="hidden lg:block" :name="auth()->user()->name" />
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
