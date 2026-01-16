<?php

namespace App\Livewire\Services;

use Livewire\Component;
use App\Models\Service;

class Create extends Component
{
    public $name, $description, $price, $duration;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable|string',
        'price' => 'nullable|numeric|min:0',
        'duration' => 'required|integer|min:1',
    ];

    public function save()
    {
        $this->validate();

        Service::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration' => $this->duration,
        ]);

        return redirect()->route('services.index')
            ->with('success', 'Corte creado con éxito.');
    }

    public function render()
    {
        return view('livewire.services.create');
    }
}
