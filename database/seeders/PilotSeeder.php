<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pilot;

class PilotSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Pilot::factory(10)->create();
    }
}
