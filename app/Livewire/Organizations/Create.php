<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use Livewire\Component;

class Create extends Component
{
    public $name = '';

    protected $rules = [
        'name' => 'required|string|min:3|unique:organizations,name',
    ];

    public function save()
    {
        $this->validate();

        Organization::create([
            'name' => $this->name,
            'is_active' => true,
        ]);

        return redirect()->route('organizations.index')
            ->with('success', 'Organización creada con éxito.');
    }

    public function render()
    {
        return view('livewire.organizations.create');
    }
}
