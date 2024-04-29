<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Circuit;

class CircuitSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $countries = \App\Models\Country::all();

        $circuits = [
            'Spa',
            'Nürburgring',
            'Monza',
            'Silverstone',
            'Suzuka',
            'Interlagos',
            'Monaco',
            'Portimão',
            'Imola',
            'Austin',
            'Sakhir',
            'Le Mans',
        ];

        $circuitsPerCountry = floor(count($circuits) / count($countries));
        $remainingCircuits = count($circuits) % count($countries);

        $index = 0;
        foreach ($countries as $country) {
            $circuitsToCreate = $circuitsPerCountry + ($remainingCircuits > 0 ? 1 : 0);
            for ($i = 0; $i < $circuitsToCreate; $i++) {
                Circuit::create([
                    'name' => $circuits[$index],
                    'country_id' => $country->id,
                ]);
                $index++;
            }
            $remainingCircuits--;
        }
    }
}
