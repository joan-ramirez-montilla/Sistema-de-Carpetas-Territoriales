<?php

namespace App\Livewire\Regions;

use App\Models\Region;
use Livewire\Component;

class Create extends Component
{
    public $name = '';

    protected $rules = [
        'name' => 'required|string|min:3|unique:regions,name',
    ];

    public function save()
    {
        $this->validate();

        Region::create([
            'name' => $this->name,
            'is_active' => true,
        ]);

        return redirect()->route('regions.index')
            ->with('success', 'Región creada con éxito.');
    }

    public function render()
    {
        return view('livewire.regions.create');
    }
}
