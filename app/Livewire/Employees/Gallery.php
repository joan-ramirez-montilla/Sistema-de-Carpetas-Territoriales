<?php

namespace App\Livewire\Employees;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\EmployeePhoto;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class Gallery extends Component
{
    use WithFileUploads;

    public $employee;
    public $photos = [];

    protected function rules()
    {
        return [
            'photos.*' => 'image|max:5120',
        ];
    }

    public function mount()
    {
        // Obtener el empleado asociado al usuario autenticado
        $this->employee = Auth::user()->employee;

        // Si no hay empleado asociado, puedes manejar el error
        if (!$this->employee) {
            // Puedes redirigir o mostrar un mensaje de error
            // Por ejemplo, si el usuario no tiene empleado asociado
            session()->flash('error', 'No tienes un perfil de empleado asociado.');
        }
    }

    public function updatedPhotos()
    {
        $this->validate();

        // Verificar que existe un empleado
        if (!$this->employee) {
            session()->flash('error', 'No se puede subir fotos sin un perfil de empleado.');
            return;
        }

        foreach ($this->photos as $photo) {
            // Generar nombre único
            $extension = $photo->getClientOriginalExtension();
            $photoName = 'employee-' . $this->employee->id . '-' . uniqid() . '.' . $extension;

            // Guardar en storage
            $photo->storeAs('employee_photos', $photoName, 'public');

            // Guardar registro en DB
            EmployeePhoto::create([
                'employee_id' => $this->employee->id,
                'photo_path' => 'employee_photos/' . $photoName,
            ]);
        }

        // Limpiar selección
        $this->photos = [];

        // Mostrar mensaje de éxito
        session()->flash('success', 'Fotos subidas exitosamente.');
    }

    public function deletePhoto($id)
    {
        $photo = EmployeePhoto::findOrFail($id);

        // Verificar que la foto pertenezca al empleado actual
        if ($photo->employee_id !== $this->employee->id) {
            session()->flash('error', 'No tienes permiso para eliminar esta foto.');
            return;
        }

        if (file_exists(storage_path('app/public/' . $photo->photo_path))) {
            unlink(storage_path('app/public/' . $photo->photo_path));
        }
        $photo->delete();

        session()->flash('success', 'Foto eliminada exitosamente.');
    }

    public function render()
    {
        if ($this->employee) {
            $employeePhotos = EmployeePhoto::where('employee_id', $this->employee->id)->get();
        } else {
            $employeePhotos = collect();
        }

        return view('livewire.employees.gallery', [
            'employeePhotos' => $employeePhotos,
        ]);
    }
}
