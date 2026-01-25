<?php

namespace App\Livewire\Provinces;

use App\Models\Province;
use App\Models\Region;
use Livewire\Component;

class Create extends Component
{
    public $name = '';
    public $region_id = '';

    protected $rules = [
        'name' => 'required|string|min:3|unique:provinces,name',
        'region_id' => 'required|exists:regions,id',
    ];

    public function save()
    {
        $this->validate();

        Province::create([
            'name' => $this->name,
            'region_id' => $this->region_id,
            'is_active' => true,
        ]);

        return redirect()->route('provinces.index')
            ->with('success', 'Provincia creada con éxito.');
    }

    public function render()
    {
        return view('livewire.provinces.create', [
            'regions' => Region::where('is_active', true)->orderBy('name')->get()
        ]);
    }
}
