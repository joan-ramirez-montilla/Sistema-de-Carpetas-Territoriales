<?php

namespace App\Livewire\Districts;

use App\Models\District;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $districtToDelete = null;
    public $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(District $district)
    {
        $this->districtToDelete = $district;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->districtToDelete = null;
    }

    public function delete()
    {
        if ($this->districtToDelete) {
            try {
                $this->districtToDelete->delete();
                $this->resetPage();
                $this->dispatch('notify', ['type' => 'success', 'message' => 'Distrito eliminado con éxito.']);
            } catch (QueryException $e) {
                if ($e->getCode() == 23000 || str_contains($e->getMessage(), '23000') || str_contains($e->getMessage(), 'Integrity constraint violation')) {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'No se puede eliminar este distrito porque tiene registros relacionados.']);
                } else {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'Ocurrió un error al intentar eliminar el distrito.']);
                }
            } finally {
                $this->closeDeleteModal();
            }
        }
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
