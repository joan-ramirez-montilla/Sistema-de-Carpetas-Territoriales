<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Region,
    Province,
    Municipality,
    District
};

class DominicanRepublicSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('provincias_municipios_distritos.data.json');

        if (!File::exists($path)) {
            throw new \Exception("Archivo JSON no encontrado en: {$path}");
        }

        $json = json_decode(File::get($path), true);

        DB::transaction(function () use ($json) {

            /**
             * ==========================
             * 1️⃣ REGIONS
             * ==========================
             */
            $regionsMap = [];

            foreach ($json['regions'] as $regionData) {
                $region = Region::firstOrCreate(
                    ['id' => $regionData['id']],
                    [
                        'name' => $regionData['name'],
                        'is_active' => true
                    ]
                );

                // Mapa para lookup rápido
                $regionsMap[$regionData['id']] = $region->id;
            }

            /**
             * ==========================
             * 2️⃣ PROVINCES
             * ==========================
             */
            foreach ($json['provinces'] as $provinceData) {

                $province = Province::firstOrCreate(
                    ['id' => $provinceData['id']],
                    [
                        'name' => $provinceData['name'],
                        'region_id' => $regionsMap[$provinceData['region_id']] ?? null,
                        'is_active' => true
                    ]
                );

                /**
                 * ==========================
                 * 3️⃣ MUNICIPALITIES
                 * ==========================
                 */
                foreach ($provinceData['municipalities'] as $municipalityData) {

                    $municipality = Municipality::firstOrCreate(
                        ['id' => $municipalityData['id']],
                        [
                            'name' => $municipalityData['name'],
                            'province_id' => $province->id,
                            'is_active' => true
                        ]
                    );

                    /**
                     * ==========================
                     * 4️⃣ DISTRICTS
                     * ==========================
                     */
                    foreach ($municipalityData['districts'] as $districtName) {

                        District::firstOrCreate(
                            [
                                'name' => $districtName,
                                'municipality_id' => $municipality->id
                            ],
                            ['is_active' => true]
                        );
                    }
                }
            }
        });
    }
}
