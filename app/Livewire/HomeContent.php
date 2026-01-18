<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompanySetting;

class HomeContent extends Component
{
    public $companySetting;

    public function mount()
    {
        $this->companySetting = CompanySetting::first() ?? new CompanySetting();
    }

    public function render()
    {
        return view('livewire.home-content')->layout('layouts.home');
    }
}
