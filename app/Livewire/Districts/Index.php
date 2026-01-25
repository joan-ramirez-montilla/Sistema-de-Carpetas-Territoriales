<?php

namespace App\Livewire\Districts;

use App\Models\District;
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

    public function delete(District $district)
    {
        $district->delete();
        $this->resetPage();
    }

    public function toggleActive(District $district)
    {
        $district->update(['is_active' => !$district->is_active]);
    }

    public function render()
    {
        $query = District::query();

        // Búsqueda por nombre
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $districts = $query->latest()->paginate($this->perPage);

        return view('livewire.districts.index', [
            'districts' => $districts
        ]);
    }
}
