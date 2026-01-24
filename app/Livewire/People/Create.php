<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\{District, Municipality, Person, Province};

class Create extends Component
{
    public $full_name, $national_id, $phone, $mobile, $circumscription, $office_phone, $email, $address;

    public $province_id;
    public $municipality_id;
    public $district_id;

    public $provinces = [];
    public $municipalities = [];
    public $districts = [];

    protected $rules = [
        'full_name'         => 'required|string|min:3',
        'email'             => 'nullable|email|max:255|unique:people,email',
        'province_id'       => 'required|exists:provinces,id',
        'municipality_id'   => 'required|exists:municipalities,id',
        'district_id'       => 'nullable|exists:districts,id',
        'circumscription' => 'required|in:1,2,3,4,5,6,7,8'
    ];

    public function mount()
    {
        $this->provinces = Province::where('is_active', true)->orderBy('name')->get();
    }

    public function updatedProvinceId($value)
    {
        $this->municipality_id = null;
        $this->district_id = null;

        $this->municipalities = Municipality::where('province_id', $value)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $this->districts = [];
    }

    public function updatedMunicipalityId($value)
    {
        $this->district_id = null;

        $this->districts = District::where('municipality_id', $value)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function save()
    {
        $this->validate();

        Person::create([
            'full_name'       => $this->full_name,
            'national_id'     => $this->national_id,
            'phone'           => $this->phone,
            'mobile'          => $this->mobile,
            'office_phone'    => $this->office_phone,
            'email'           => $this->email,
            'address'         => $this->address,
            'province_id'     => $this->province_id,
            'municipality_id' => $this->municipality_id,
            'district_id'     => $this->district_id,
            'circumscription' => $this->circumscription
        ]);

        return redirect()->route('people.index')
            ->with('success', 'Persona creada con éxito.');
    }

    public function render()
    {
        return view('livewire.people.create');
    }
}
