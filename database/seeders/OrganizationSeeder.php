<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('organismos.data.json');

        if (!File::exists($path)) {
            throw new \Exception("Archivo JSON no encontrado en: {$path}");
        }

        $json = json_decode(File::get($path), true);

        DB::transaction(function () use ($json) {

            foreach ($json['organizations'] as $organizationData) {

                Organization::firstOrCreate(
                    ['id' => $organizationData['id']],
                    [
                        'name' => $organizationData['name'],
                        'is_active' => true
                    ]
                );
            }

        });
    }
}
