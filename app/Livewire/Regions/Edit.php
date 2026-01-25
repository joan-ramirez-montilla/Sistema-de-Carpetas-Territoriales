<?php

namespace App\Livewire\Regions;

use App\Models\Region;
use Livewire\Component;

class Edit extends Component
{
    public Region $region;
    public $name = '';

    public function mount(Region $region)
    {
        $this->region = $region;
        $this->name = $region->name;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:regions,name,' . $this->region->id,
        ];
    }

    public function save()
    {
        $this->validate();

        $this->region->update([
            'name' => $this->name,
        ]);

        return redirect()->route('regions.index')
            ->with('success', 'Región actualizada con éxito.');
    }

    public function render()
    {
        return view('livewire.regions.edit');
    }
}
