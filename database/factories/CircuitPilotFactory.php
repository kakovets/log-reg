<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CircuitPilot;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CircuitPilot>
 */
class CircuitPilotFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array {
        return [
            'circuit_id' => $this->faker->numberBetween(1, 12),
            'pilot_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
