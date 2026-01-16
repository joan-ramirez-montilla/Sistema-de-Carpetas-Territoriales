<div class="flex h-full w-full flex-1 flex-col gap-8 p-6">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Galería de Cortes</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
            Arrastra y suelta tus fotos de cortes aquí o haz clic para agregar.
        </p>
    </div>

    {{-- Dropzone --}}
    <div x-data x-on:click="$refs.fileInput.click()"
        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-12 text-center text-gray-400 cursor-pointer hover:border-gray-500 transition-colors">
        <i class="fas fa-cloud-upload-alt text-4xl mb-4"></i>
        <p class="text-sm">Arrastra tus imágenes aquí o haz clic para seleccionar</p>
        <input type="file" x-ref="fileInput" wire:model="photos" multiple class="hidden" accept="image/*">
    </div>

    @error('photos.*')
        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
    @enderror

    {{-- Galería --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-4">
        @foreach ($employeePhotos as $photo)
            <div class="relative group overflow-hidden rounded-lg shadow-md bg-white dark:bg-gray-800">
                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Corte de cabello"
                    class="w-full h-full object-cover aspect-square transition-transform duration-300 group-hover:scale-105">

                {{-- Botón eliminar con icono de basurero --}}
                <button wire:click="deletePhoto({{ $photo->id }})"
                    class="absolute top-2 right-2 text-white bg-red-500 rounded-full p-3 shadow-md hover:bg-red-600 transition-colors flex items-center justify-center"
                    title="Eliminar">
                    <i class="fas fa-trash-alt text-lg"></i> <!-- aquí aumentamos el tamaño -->
                </button>

            </div>
        @endforeach
    </div>
</div>
