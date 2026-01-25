<?php

namespace App\Livewire\Regions;

use App\Models\Region;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $regionToDelete = null;
    public $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(Region $region)
    {
        $this->regionToDelete = $region;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->regionToDelete = null;
    }

    public function delete()
    {
        if ($this->regionToDelete) {
            try {
                $this->regionToDelete->delete();
                $this->resetPage();
                $this->dispatch('notify', ['type' => 'success', 'message' => 'Región eliminada con éxito.']);
            } catch (QueryException $e) {
                if ($e->getCode() == 23000 || str_contains($e->getMessage(), '23000') || str_contains($e->getMessage(), 'Integrity constraint violation')) {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'No se puede eliminar esta región porque tiene registros relacionados.']);
                } else {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'Ocurrió un error al intentar eliminar la región.']);
                }
            } finally {
                $this->closeDeleteModal();
            }
        }
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
