<?php

namespace App\Imports;

use App\Models\{
    Person,
    Province,
    Municipality,
    District,
    Position,
    Organization
};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;


class PeopleImport implements ToCollection
{
    protected $provinces;
    protected $municipalities;
    protected $districts;
    protected $positions;
    protected $organizations;

    public function __construct()
    {
        // Cargar catálogos en memoria (CLAVE)
        $this->provinces = Province::all()
            ->keyBy(fn($p) => strtoupper(trim($p->name)));

        $this->municipalities = Municipality::all()
            ->keyBy(fn($m) => strtoupper(trim($m->name)));

        $this->districts = District::all()
            ->keyBy(fn($d) => strtoupper(trim($d->name)));

        $this->positions = Position::all()
            ->keyBy(fn($p) => strtoupper(trim($p->name)));

        $this->organizations = Organization::all()
            ->keyBy(fn($o) => strtoupper(trim($o->name)));
    }

    public function collection(Collection $rows)
    {

        foreach ($rows->skip(1) as $row) {

            $provinceName = $this->normalize($row[0]);
            $municipalityName = $this->normalize_V2($row[1]);
            $districtName = $this->normalize_V2($row[2]);
            $circumscription =  $this->normalizeCircumscription($row[3]);
            $positionName = $this->normalize_V2(strtoupper(trim(preg_replace('/\s+/', ' ', $row[4]))));
            $organizationName  = strtoupper(trim(preg_replace('/\s+/', ' ', $row[5])));
            $email = $this->normalizeEmail($row[14]);

            $province = $provinceName ? ($this->provinces[$provinceName] ?? null) : null;
            $municipality = $municipalityName ? ($this->municipalities[$municipalityName] ?? null) : null;
            $district = $districtName ? ($this->districts[$districtName] ?? null) : null;
            $position = $this->positions[$positionName] ?? null;
            $organization = $this->organizations[$organizationName] ?? null;

            // Si faltan FK obligatorias → skip
            if (!$position || !$organization) {

                Log::warning('Fila omitida por FK', [
                    'position' => $position,
                    'positionName' => $positionName,
                    '$row[4]' => $row[4],
                    'organization' => $organization,
                    'organizationName' => $organizationName,
                    '$row[5]' => $row[5],
                ]);

                continue;
            }

            // validar provincia, municipio y distrito
            if (!$province || !$municipality || !$district) {

                Log::warning('Fila omitida por provincia, municipio o distrito', [
                    'province-id' => $province?->id,
                    'provinceName' => $provinceName,
                    '$row[0]' => $row[0],
                    'municipality-id' => $municipality?->id,
                    'municipalityName' => $municipalityName,
                    '$row[1]' => $row[1],
                    'district-id' => $district?->id,
                    'districtName' => $districtName,
                    '$row[2]' => $row[2],
                ]);
            }


            Person::updateOrCreate(
                ['national_id' => trim($row[8])],
                [
                    'full_name' => trim($row[7]),
                    'phone' => $row[9] ?? null,
                    'mobile' => $row[10] ?? null,
                    'office_phone' => $row[11] ?? null,
                    'email' => $email,
                    'address' => $row[12] ?? null,
                    'circumscription' => $circumscription,
                    'province_id' => $province?->id,
                    'municipality_id' => $municipality?->id,
                    'district_id' => $district?->id,
                    'position_id' => $position->id,
                    'organization_id' => $organization->id,
                ]
            );
        }
    }

    private function normalize($value): ?string
    {
        $value = strtoupper(trim((string)$value));

        return in_array($value, ['NO APLICA', 'N/A', '']) ? null : $value;
    }

        private function normalize_V2($value): ?string
    {
        $value = strtoupper(trim((string)$value));

        return in_array($value, ['NO APLICA', 'N/A', '']) ? 'N/A' : $value;
    }

    private function normalizeEmail($value): ?string
    {
          // Normalizar
            $email = is_string($value) ? trim($value) : null;

            // Convertir vacíos a null
            if ($email === '' || strtolower($email) === 'n/a') {
                $email = null;
            }

            return $email;
    }


    private function normalizeCircumscription($value): ?string
{
    if ($value === null) {
        return '1';
    }

    $value = strtoupper(trim((string)$value));

    // N/A o vacío → 1
    if ($value === '' || $value === 'N/A' || $value === 'NO APLICA') {
        return '1';
    }

    // CIR. 01, CIR 02, CIR-03, etc
    if (preg_match('/(\d+)/', $value, $matches)) {
        $number = (int) $matches[1];

        // Validar rango del enum
        if ($number >= 1 && $number <= 8) {
            return (string) $number;
        }
    }

    return '1'; // fallback seguro
}
}
