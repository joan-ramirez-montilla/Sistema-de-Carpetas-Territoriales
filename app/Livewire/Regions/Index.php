<?php

namespace App\Livewire\Regions;

use App\Models\Region;
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

    public function delete(Region $region)
    {
        $region->delete();
        $this->resetPage();
    }

    public function toggleActive(Region $region)
    {
        $region->update(['is_active' => !$region->is_active]);
    }

    public function render()
    {
        $query = Region::query();

        // Búsqueda por nombre
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $regions = $query->latest()->paginate($this->perPage);

        return view('livewire.regions.index', [
            'regions' => $regions
        ]);
    }
}
