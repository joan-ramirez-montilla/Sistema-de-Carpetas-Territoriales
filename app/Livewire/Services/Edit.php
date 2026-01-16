<?php

namespace App\Livewire\Services;

use Livewire\Component;
use App\Models\Service;

class Edit extends Component
{
    public Service $service;

    public $name;
    public $description;
    public $price;
    public $duration;

    protected function rules()
    {
        return [
            'name'        => 'required|string|min:3',
            'description' => 'nullable|string',
            'price'       => 'nullable|numeric|min:0',
            'duration'    => 'required|integer|min:1',
        ];
    }

    public function mount(Service $service)
    {
        $this->service = $service;

        $this->fill(
            $service->only([
                'name',
                'description',
                'price',
                'duration',
            ])
        );
    }

    public function save()
    {
        $validated = $this->validate();

        $this->service->update($validated);

        return redirect()
            ->route('services.index')
            ->with('success', 'Corte actualizado con éxito.');
    }

    public function render()
    {
        return view('livewire.services.edit');
    }
}
