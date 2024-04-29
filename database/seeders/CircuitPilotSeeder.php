<?php

namespace Database\Seeders;

use App\Models\CircuitPilot;
use Illuminate\Database\Seeder;


class CircuitPilotSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        CircuitPilot::factory(30)->create();
    }
}
