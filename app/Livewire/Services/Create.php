<?php

namespace App\Livewire\Services;

use Livewire\{Component, WithFileUploads};
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name, $description, $price, $duration, $image, $color;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric|min:0|max:1000000',
        'duration' => 'required|integer|min:1|max:1000',
        'image' => 'nullable|image',
        'color' => 'nullable|string',
    ];

    public function save()
    {
        $this->validate();

        $imageName = null;

        if ($this->image) {
            // Generar nombre único
            $extension = $this->image->getClientOriginalExtension();
            $imageName = 'service-' . uniqid() . '-' . rand(1000, 9999) . '.' . $extension;

            // Guardar imagen en storage/app/public/services
            $this->image->storeAs('services', $imageName, 'public');
        }

        Service::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
            'image' => $imageName,
            'color' => $this->color,
        ]);

        return redirect()->route('services.index')
            ->with('success', 'Servicio creado con éxito.');
    }

    public function render()
    {
        return view('livewire.services.create');
    }
}
