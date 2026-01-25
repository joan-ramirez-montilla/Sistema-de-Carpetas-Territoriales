<?php

namespace App\Livewire\Districts;

use App\Models\District;
use App\Models\Municipality;
use Livewire\Component;

class Create extends Component
{
    public $name = '';
    public $municipality_id = '';

    protected $rules = [
        'name' => 'required|string|min:3|unique:districts,name',
        'municipality_id' => 'required|exists:municipalities,id',
    ];

    public function save()
    {
        $this->validate();

        District::create([
            'name' => $this->name,
            'municipality_id' => $this->municipality_id,
            'is_active' => true,
        ]);

        return redirect()->route('districts.index')
            ->with('success', 'Distrito creado con éxito.');
    }

    public function render()
    {
        return view('livewire.districts.create', [
            'municipalities' => Municipality::where('is_active', true)->orderBy('name')->get()
        ]);
    }
}
