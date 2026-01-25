<?php

namespace App\Livewire\Municipalities;

use App\Models\Municipality;
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

    public function delete(Municipality $municipality)
    {
        $municipality->delete();
        $this->resetPage();
    }

    public function toggleActive(Municipality $municipality)
    {
        $municipality->update(['is_active' => !$municipality->is_active]);
    }

    public function render()
    {
        $query = Municipality::query();

        // Búsqueda por nombre
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $municipalities = $query->latest()->paginate($this->perPage);

        return view('livewire.municipalities.index', [
            'municipalities' => $municipalities
        ]);
    }
}
