<?php

namespace App\Livewire\Positions;

use App\Models\Position;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $positionToDelete = null;
    public $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(Position $position)
    {
        $this->positionToDelete = $position;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->positionToDelete = null;
    }

    public function delete()
    {
        if ($this->positionToDelete) {
            try {
                $this->positionToDelete->delete();
                $this->resetPage();
                $this->dispatch('notify', ['type' => 'success', 'message' => 'Cargo eliminado con éxito.']);
            } catch (QueryException $e) {
                if ($e->getCode() == 23000 || str_contains($e->getMessage(), '23000') || str_contains($e->getMessage(), 'Integrity constraint violation')) {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'No se puede eliminar este cargo porque tiene registros relacionados.']);
                } else {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'Ocurrió un error al intentar eliminar el cargo.']);
                }
            } finally {
                $this->closeDeleteModal();
            }
        }
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
