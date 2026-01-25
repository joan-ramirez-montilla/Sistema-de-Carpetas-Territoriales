<?php

namespace App\Livewire\People;

use App\Models\Person;
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

    public function delete(Person $person)
    {
        $person->delete();
        $this->resetPage();
    }

    public function render()
    {
        $query = Person::query();

        // Búsqueda por nombre o cédula
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('full_name', 'like', '%' . $this->search . '%')
                  ->orWhere('national_id', 'like', '%' . $this->search . '%');
            });
        }

        $people = $query->latest()->paginate($this->perPage);

        return view('livewire.people.index', [
            'people' => $people
        ]);
    }
}
