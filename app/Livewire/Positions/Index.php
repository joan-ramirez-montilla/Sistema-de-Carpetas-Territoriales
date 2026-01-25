<?php

namespace App\Livewire\Positions;

use App\Models\Position;
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

    public function delete(Position $position)
    {
        $position->delete();
        $this->resetPage();
    }

    public function toggleActive(Position $position)
    {
        $position->update(['is_active' => !$position->is_active]);
    }

    public function render()
    {
        $query = Position::query();

        // Búsqueda por nombre
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $positions = $query->latest()->paginate($this->perPage);

        return view('livewire.positions.index', [
            'positions' => $positions
        ]);
    }
}
