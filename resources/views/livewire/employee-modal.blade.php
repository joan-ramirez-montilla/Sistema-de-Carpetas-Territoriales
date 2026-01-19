<div>
    <!-- Modal principal del empleado -->
    <div x-data="{
        show: @entangle('showModal'),
        photos: @json(
            $employee
                ? ($employee->photos
                    ? $employee->photos->map(fn($photo) => asset('storage/' . $photo->photo_path))
                    : [])
                : []
        )
    }" x-show="show" x-on:keydown.escape.window="show = false; $wire.closeModal()"
        class="fixed inset-0 z-50 overflow-y-auto" style="display: none;" x-cloak
        x-on:close-modal.window="show = false; $wire.closeModal()">

        <!-- Fondo -->
        <div class="fixed inset-0 bg-black/50 z-40" x-show="show" x-transition.opacity.duration.300ms></div>

        <!-- Contenido -->
        <div class="flex items-center justify-center min-h-screen px-0">
            <div class="inline-block w-full sm:max-w-3xl bg-white rounded-xl shadow-2xl z-50 relative h-[100vh]"
                x-show="show"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                x-on:click.away="show = false; $wire.closeModal()">

                @if ($employee)
                    <div class="p-6 h-full overflow-y-auto">

                        <!-- Header (Botón cerrar) -->
                        <div class="flex justify-end mb-4">
                            <button x-on:click="show = false; $wire.closeModal()"
                                class="text-gray-400 hover:text-gray-600 p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Imagen principal + Nombre (centrado) -->
                        <div class="text-center mb-6">
                            @if ($employee->user->photo_path)
                                <img src="{{ asset('storage/' . $employee->user->photo_path) }}"
                                    alt="{{ $employee->user->name }}"
                                    class="w-40 h-40 rounded-xl object-cover mx-auto shadow">
                            @else
                                <div
                                    class="w-40 h-40 rounded-xl mx-auto flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <span class="text-3xl font-medium text-gray-600">
                                        {{ strtoupper(substr($employee->user->name, 0, 2)) }}
                                    </span>
                                </div>
                            @endif

                            <h3 class="text-2xl font-semibold text-gray-900 mt-4">
                                {{ $employee->user->name }}
                            </h3>

                            <span
                                class="inline-block mt-2 px-3 py-1 text-xs font-medium rounded-full
                                         bg-gray-100 text-gray-800">
                                {{ $employee->status }}
                            </span>
                        </div>

                        <!-- Botón Reservar -->
                        <button
                            class="w-full py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800
                                   transition-colors duration-200 mb-8">
                            Reservar
                        </button>

                        <!-- Galería -->
                        @if ($employee->photos && $employee->photos->count() > 0)
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Galería</h4>
                                <div class="grid grid-cols-2 gap-3">
                                    @foreach ($employee->photos as $photo)
                                        <div class="aspect-square rounded-lg overflow-hidden bg-gray-100">
                                            <img src="{{ asset('storage/' . $photo->photo_path) }}"
                                                alt="Foto {{ $loop->iteration }}" class="w-full h-full object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
