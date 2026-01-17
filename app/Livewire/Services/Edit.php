<?php

namespace App\Livewire\Services;

use Livewire\{Component, WithFileUploads};
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public Service $service;

    public $name;
    public $description;
    public $price;
    public $duration;
    public $image;
    public $color;

    protected function rules()
    {
        return [
            'name'        => 'required|string|min:3',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0|max:1000000',
            'duration'    => 'required|integer|min:1|max:1000',
            'image'       => 'nullable|image',
            'color'       => 'nullable|string',
        ];
    }

    public function mount(Service $service)
    {
        $this->service = $service;

        $this->fill(
            $service->only([
                'name',
                'description',
                'price',
                'duration',
                'color',
            ])
        );
    }

    public function save()
    {
        $validated = $this->validate();

        // Si el usuario sube una nueva imagen
        if ($this->image) {

            // Eliminar imagen anterior si existe
            if ($this->service->image && Storage::disk('public')->exists('services/' . $this->service->image)) {
                Storage::disk('public')->delete('services/' . $this->service->image);
            }

            // Guardar nueva imagen
            $extension = $this->image->getClientOriginalExtension();
            $imageName = 'service-' . uniqid() . '-' . rand(1000, 9999) . '.' . $extension;
            $this->image->storeAs('services', $imageName, 'public');

            $validated['image'] = $imageName;
        }

        $this->service->update($validated);

        return redirect()
            ->route('services.index')
            ->with('success', 'Servicio actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.services.edit');
    }
}
