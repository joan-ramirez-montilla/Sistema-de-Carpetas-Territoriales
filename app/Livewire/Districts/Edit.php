<?php

namespace App\Livewire\Districts;

use App\Models\District;
use App\Models\Municipality;
use Livewire\Component;

class Edit extends Component
{
    public District $district;
    public $name = '';
    public $municipality_id = '';

    public function mount(District $district)
    {
        $this->district = $district;
        $this->name = $district->name;
        $this->municipality_id = $district->municipality_id;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:districts,name,' . $this->district->id,
            'municipality_id' => 'required|exists:municipalities,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $this->district->update([
            'name' => $this->name,
            'municipality_id' => $this->municipality_id,
        ]);

        return redirect()->route('districts.index')
            ->with('success', 'Distrito actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.districts.edit', [
            'municipalities' => Municipality::where('is_active', true)->orderBy('name')->get()
        ]);
    }
}
