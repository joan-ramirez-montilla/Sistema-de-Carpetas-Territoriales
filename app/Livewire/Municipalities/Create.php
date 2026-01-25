<?php

namespace App\Livewire\Municipalities;

use App\Models\Municipality;
use App\Models\Province;
use Livewire\Component;

class Create extends Component
{
    public $name = '';
    public $province_id = '';

    protected $rules = [
        'name' => 'required|string|min:3|unique:municipalities,name',
        'province_id' => 'required|exists:provinces,id',
    ];

    public function save()
    {
        $this->validate();

        Municipality::create([
            'name' => $this->name,
            'province_id' => $this->province_id,
            'is_active' => true,
        ]);

        return redirect()->route('municipalities.index')
            ->with('success', 'Municipio creado con éxito.');
    }

    public function render()
    {
        return view('livewire.municipalities.create', [
            'provinces' => Province::where('is_active', true)->orderBy('name')->get()
        ]);
    }
}
