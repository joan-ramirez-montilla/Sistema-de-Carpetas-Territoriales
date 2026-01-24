<?php

namespace App\Livewire\People;

use App\Models\Person;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete(Person $person)
    {
        $person->delete();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.people.index', [
            'people' =>  Person::latest()->paginate(10)
        ]);
    }
}
