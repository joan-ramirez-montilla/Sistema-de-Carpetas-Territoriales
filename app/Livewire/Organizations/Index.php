<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $organizationToDelete = null;
    public $showDeleteModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete(Organization $organization)
    {
        $this->organizationToDelete = $organization;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->organizationToDelete = null;
    }

    public function delete()
    {
        if ($this->organizationToDelete) {
            try {
                $this->organizationToDelete->delete();
                $this->resetPage();
                $this->dispatch('notify', ['type' => 'success', 'message' => 'Organización eliminada con éxito.']);
            } catch (QueryException $e) {
                if ($e->getCode() == 23000 || str_contains($e->getMessage(), '23000') || str_contains($e->getMessage(), 'Integrity constraint violation')) {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'No se puede eliminar esta organización porque tiene registros relacionados.']);
                } else {
                    $this->dispatch('notify', ['type' => 'error', 'message' => 'Ocurrió un error al intentar eliminar la organización.']);
                }
            } finally {
                $this->closeDeleteModal();
            }
        }
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
