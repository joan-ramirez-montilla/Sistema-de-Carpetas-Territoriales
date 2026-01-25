<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use Livewire\Component;

class Edit extends Component
{
    public Organization $organization;
    public $name = '';

    public function mount(Organization $organization)
    {
        $this->organization = $organization;
        $this->name = $organization->name;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:organizations,name,' . $this->organization->id,
        ];
    }

    public function save()
    {
        $this->validate();

        $this->organization->update([
            'name' => $this->name,
        ]);

        return redirect()->route('organizations.index')
            ->with('success', 'Organización actualizada con éxito.');
    }

    public function render()
    {
        return view('livewire.organizations.edit');
    }
}
