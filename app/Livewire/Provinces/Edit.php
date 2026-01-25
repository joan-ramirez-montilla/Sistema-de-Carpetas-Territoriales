<?php

namespace App\Livewire\Provinces;

use App\Models\Province;
use App\Models\Region;
use Livewire\Component;

class Edit extends Component
{
    public Province $province;
    public $name = '';
    public $region_id = '';

    public function mount(Province $province)
    {
        $this->province = $province;
        $this->name = $province->name;
        $this->region_id = $province->region_id;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:provinces,name,' . $this->province->id,
            'region_id' => 'required|exists:regions,id',
        ];
    }

    public function save()
    {
        $this->validate();

        $this->province->update([
            'name' => $this->name,
            'region_id' => $this->region_id,
        ]);

        return redirect()->route('provinces.index')
            ->with('success', 'Provincia actualizada con éxito.');
    }

    public function render()
    {
        return view('livewire.provinces.edit', [
            'regions' => Region::where('is_active', true)->orderBy('name')->get()
        ]);
    }
}
