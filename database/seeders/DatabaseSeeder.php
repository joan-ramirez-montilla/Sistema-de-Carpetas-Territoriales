<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\DominicanRepublicSeeder;
use Database\Seeders\OrganizationSeeder;
use Database\Seeders\PositionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(DominicanRepublicSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(PositionSeeder::class);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);
    }
}
