<?php

namespace App\Livewire\Positions;

use App\Models\Position;
use Livewire\Component;

class Edit extends Component
{
    public Position $position;
    public $name = '';

    public function mount(Position $position)
    {
        $this->position = $position;
        $this->name = $position->name;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:positions,name,' . $this->position->id,
        ];
    }

    public function save()
    {
        $this->validate();

        $this->position->update([
            'name' => $this->name,
        ]);

        return redirect()->route('positions.index')
            ->with('success', 'Cargo actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.positions.edit');
    }
}
