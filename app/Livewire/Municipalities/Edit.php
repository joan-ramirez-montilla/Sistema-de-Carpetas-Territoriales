<?php

namespace App\Livewire\Municipalities;

use App\Models\Municipality;
use App\Models\Province;
use Livewire\Component;

class Edit extends Component
{
    public Municipality $municipality;
    public $name = '';
    public $province_id = '';

    public function mount(Municipality $municipality)
    {
        $this->municipality = $municipality;
        $this->name = $municipality->name;
        $this->province_id = $municipality->province_id;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:municipalities,name,' . $this->municipality->id,
            'province_id' => 'required|exists:provinces,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $this->municipality->update([
            'name' => $this->name,
            'province_id' => $this->province_id,
        ]);

        return redirect()->route('municipalities.index')
            ->with('success', 'Municipio actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.municipalities.edit', [
            'provinces' => Province::where('is_active', true)->orderBy('name')->get()
        ]);
    }
}
