<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\DominicanRepublicSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(DominicanRepublicSeeder::class);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);
    }
}
