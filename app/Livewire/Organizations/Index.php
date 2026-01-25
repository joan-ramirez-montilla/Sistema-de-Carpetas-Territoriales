<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Organization $organization)
    {
        $organization->delete();
        $this->resetPage();
    }

    public function toggleActive(Organization $organization)
    {
        $organization->update(['is_active' => !$organization->is_active]);
    }

    public function render()
    {
        $query = Organization::query();

        // Búsqueda por nombre
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $organizations = $query->latest()->paginate($this->perPage);

        return view('livewire.organizations.index', [
            'organizations' => $organizations
        ]);
    }
}
