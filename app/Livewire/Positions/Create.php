<?php

namespace App\Livewire\Positions;

use App\Models\Position;
use Livewire\Component;

class Create extends Component
{
    public $name = '';

    protected $rules = [
        'name' => 'required|string|min:3|unique:positions,name',
    ];

    public function save()
    {
        $this->validate();

        Position::create([
            'name' => $this->name,
            'is_active' => true,
        ]);

        return redirect()->route('positions.index')
            ->with('success', 'Cargo creado con éxito.');
    }

    public function render()
    {
        return view('livewire.positions.create');
    }
}
