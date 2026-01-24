<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = storage_path('cargo.data.json');

        if (!File::exists($path)) {
            throw new \Exception("Archivo JSON no encontrado en: {$path}");
        }

        $json = json_decode(File::get($path), true);

        DB::transaction(function () use ($json) {

            foreach ($json['positions'] as $positionData) {

                Position::firstOrCreate(
                    ['id' => $positionData['id']],
                    [
                        'name' => $positionData['name'],
                        'is_active' => true
                    ]
                );
            }

        });
    }
}
