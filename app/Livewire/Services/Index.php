<?php

namespace App\Livewire\Services;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;

class Index extends Component
{
    use WithPagination;

    public function delete(Service $service)
    {
        $service->delete();
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.services.index', [
            'services' => Service::latest()->paginate(20)
        ]);
    }
}
