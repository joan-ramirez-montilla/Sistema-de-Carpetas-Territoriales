<?php

namespace App\Livewire\Municipalities;

use App\Models\Municipality;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $municipalityToDelete = null;
    public $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(Municipality $municipality)
    {
        $this->municipalityToDelete = $municipality;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->municipalityToDelete = null;
    }

    public function delete()
    {
        if ($this->municipalityToDelete) {
            try {
                $this->municipalityToDelete->delete();
                $this->resetPage();
                $this->dispatch('notify', ['type' => 'success', 'message' => 'Municipio eliminado con éxito.']);
            } catch (QueryException $e) {
                if ($e->getCode() == 23000 || str_contains($e->getMessage(), '23000') || str_contains($e->getMessage(), 'Integrity constraint violation')) {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'No se puede eliminar este municipio porque tiene registros relacionados.']);
                } else {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'Ocurrió un error al intentar eliminar el municipio.']);
                }
            } finally {
                $this->closeDeleteModal();
            }
        }
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
