<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Country::create(['name' => 'USA']);
        Country::create(['name' => 'UK']);
        Country::create(['name' => 'France']);
        Country::create(['name' => 'Germany']);
        Country::create(['name' => 'Italy']);
    }
}
