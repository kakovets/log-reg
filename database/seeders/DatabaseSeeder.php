<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(CountrySeeder::class);
        $this->call(CircuitSeeder::class);
        $this->call(PilotSeeder::class);
        $this->call(CircuitPilotSeeder::class);
    }
}
