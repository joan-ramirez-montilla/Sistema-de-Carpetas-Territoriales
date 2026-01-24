<?php

namespace App\Livewire\People;

use Livewire\Component;
use App\Models\{District, Municipality, Person, Province};

class Edit extends Component
{
    public Person $person;

    public $full_name, $national_id, $phone, $circumscription, $mobile, $office_phone, $email, $address;
    public $province_id, $municipality_id, $district_id;

    public $provinces = [];
    public $municipalities = [];
    public $districts = [];

    protected function rules()
    {
        return [
            'full_name'       => 'required|string|min:3',
            'email'           => 'nullable|email|max:255|unique:people,email,' . $this->person->id,
            'province_id'     => 'required|exists:provinces,id',
            'municipality_id' => 'required|exists:municipalities,id',
            'district_id'     => 'nullable|exists:districts,id',
            'circumscription' => 'required|in:1,2,3,4,5,6,7,8',
        ];
    }

    public function mount(Person $person)
    {
        $this->person = $person;

        // Provincias
        $this->provinces = Province::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Cargar datos actuales
        $this->fill([
            'full_name'       => $person->full_name,
            'national_id'     => $person->national_id,
            'phone'           => $person->phone,
            'mobile'          => $person->mobile,
            'office_phone'    => $person->office_phone,
            'email'           => $person->email,
            'address'         => $person->address,
            'province_id'     => $person->province_id,
            'municipality_id' => $person->municipality_id,
            'district_id'     => $person->district_id,
            'circumscription' => $this->circumscription
        ]);

        // Precargar dependencias
        if ($this->province_id) {
            $this->municipalities = Municipality::where('province_id', $this->province_id)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        }

        if ($this->municipality_id) {
            $this->districts = District::where('municipality_id', $this->municipality_id)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        }
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

    public function update()
    {
        $this->validate();

        $this->person->update([
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
        ]);

        return redirect()
            ->route('people.index')
            ->with('success', 'Persona actualizada con éxito.');
    }

    public function render()
    {
        return view('livewire.people.edit');
    }
}
