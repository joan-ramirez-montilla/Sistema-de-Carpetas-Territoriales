<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{CompanySetting,Employee};

class HomeContent extends Component
{
    public $companySetting, $employees;

    public function mount()
    {
        $this->companySetting = CompanySetting::first() ?? new CompanySetting();
        $employees = Employee::where('status', 'active')->get();
    }

    public function render()
    {
        return view('livewire.home-content')->layout('layouts.home');
    }
}
