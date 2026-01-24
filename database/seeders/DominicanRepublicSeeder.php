<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\{Province, Municipality, District};
use Illuminate\Support\Facades\DB;

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

            foreach ($json['provinces'] as $provinceData) {

                $province = Province::firstOrCreate(
                    ['name' => $provinceData['name']],
                    ['is_active' => true]
                );

                foreach ($provinceData['municipalities'] as $municipalityData) {

                    $municipality = Municipality::firstOrCreate(
                        [
                            'name' => $municipalityData['name'],
                            'province_id' => $province->id,
                        ],
                        ['is_active' => true]
                    );

                    foreach ($municipalityData['districts'] as $districtName) {

                        District::firstOrCreate(
                            [
                                'name' => $districtName,
                                'municipality_id' => $municipality->id,
                            ],
                            ['is_active' => true]
                        );
                    }
                }
            }
        });
    }
}
