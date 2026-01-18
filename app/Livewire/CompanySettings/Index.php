<?php

namespace App\Livewire\CompanySettings;

use Livewire\Component;
use App\Traits\HasSchedule;
use Livewire\WithFileUploads;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads, HasSchedule;

    public $companySetting;
    public $name;
    public $logo;
    public $phone;
    public $email;
    public $map_url;
    public $primary_color;
    public $secondary_color;
    public $schedule = [];
    public $facebook;
    public $instagram;
    public $twitter;
    public $whatsapp;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $location_description;

    public function mount()
    {
        // Cargar configuración existente o crear nueva
        $this->companySetting = CompanySetting::first() ?? new CompanySetting();

        $this->schedule = $this->mergeSchedule($this->companySetting->schedule);

        // Rellenar propiedades
        $this->fill([
            'name'                 => $this->companySetting->name,
            'phone'                => $this->companySetting->phone,
            'email'                => $this->companySetting->email,
            'map_url'              => $this->companySetting->map_url,
            'primary_color'        => $this->companySetting->primary_color ?? '#000000',
            'secondary_color'      => $this->companySetting->secondary_color ?? '#ffffff',
            'schedule'             => $this->mergeSchedule($this->companySetting->schedule),
            'facebook'             => $this->companySetting->facebook,
            'instagram'            => $this->companySetting->instagram,
            'twitter'              => $this->companySetting->twitter,
            'whatsapp'             => $this->companySetting->whatsapp,
            'seo_title'            => $this->companySetting->seo_title,
            'seo_description'      => $this->companySetting->seo_description,
            'seo_keywords'         => $this->companySetting->seo_keywords,
            'location_description' => $this->companySetting->location_description
        ]);
    }

    protected function rules()
    {
        return [
            'name'                    => 'required|string|max:255',
            'logo'                    => 'nullable|image',
            'phone'                   => 'nullable|string|max:50',
            'email'                   => 'nullable|email|max:255',
            'primary_color'           => 'nullable|string|size:7',
            'secondary_color'         => 'nullable|string|size:7',
            'schedule'                => 'nullable|array',
            'facebook'                => 'nullable|url|max:255',
            'instagram'               => 'nullable|url|max:255',
            'twitter'                 => 'nullable|url|max:255',
            'whatsapp'                => 'nullable|url|max:255',
            'seo_title'               => 'nullable|string|max:255',
            'seo_description'         => 'nullable|string|max:500',
            'seo_keywords'            => 'nullable|string|max:255',
            'map_url'                 => 'nullable|url|max:500',
            'location_description'    => 'nullable|string|max:255',
        ];
    }

    public function save()
    {
        $this->validate();

        // Guardar el logo si se subió uno nuevo
        $logoName = $this->companySetting->logo ?? null;

        $this->schedule = $this->mergeSchedule($this->schedule);

        $this->validateSchedule();

        if ($this->getErrorBag()->any()) {
            return;
        }

        if ($this->logo) {
            // Eliminar el logo anterior si existe
            if ($logoName && Storage::disk('public')->exists('logos/' . $logoName)) {
                Storage::disk('public')->delete('logos/' . $logoName);
            }

            // Generar nombre único y aleatorio
            $extension = $this->logo->getClientOriginalExtension();
            $logoName = 'logo-' . uniqid() . '-' . rand(1000, 9999) . '.' . $extension;

            // Guardar el archivo
            $this->logo->storeAs('logos', $logoName, 'public');
        }

        // Actualizar o crear la configuración
        CompanySetting::updateOrCreate(
            ['id' => $this->companySetting->id ?? null],
            [
                'name' => $this->name,
                'logo' => $logoName,
                'phone' => $this->phone,
                'email' => $this->email,
                'map_url' => $this->map_url,
                'primary_color' => $this->primary_color,
                'secondary_color' => $this->secondary_color,
                'schedule' => $this->schedule,
                'facebook' => $this->facebook,
                'instagram' => $this->instagram,
                'twitter' => $this->twitter,
                'whatsapp' => $this->whatsapp,
                'seo_title' => $this->seo_title,
                'seo_description' => $this->seo_description,
                'seo_keywords' => $this->seo_keywords,
                'location_description' => $this->location_description,
            ]
        );

        // Recargar los datos
        $this->companySetting = CompanySetting::first();
        $this->logo = null;

        return redirect()
            ->route('company-settings.index')
            ->with('success', 'Configuración guardada exitosamente.');
    }

    public function render()
    {
        return view('livewire.company-settings.index',[
            'logo_path' => $this->companySetting->logo
        ]);
    }
}
