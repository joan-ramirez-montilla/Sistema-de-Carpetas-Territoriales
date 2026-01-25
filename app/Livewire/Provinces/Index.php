<?php

namespace App\Livewire\Provinces;

use App\Models\Province;
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

    public function delete(Province $province)
    {
        $province->delete();
        $this->resetPage();
    }

    public function toggleActive(Province $province)
    {
        $province->update(['is_active' => !$province->is_active]);
    }

    public function render()
    {
        $query = Province::query();

        // Búsqueda por nombre
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $provinces = $query->latest()->paginate($this->perPage);

        return view('livewire.provinces.index', [
            'provinces' => $provinces
        ]);
    }
}
