<?php

namespace App\Http\Controllers;

use App\Models\Country;

class GlobalController extends Controller {
    public function getCountries() {

        $countries = Country::all();

        return response()->json([
            'result' => 'success',
            'data' => $countries
        ]);
    }

    public function getCountry($id) {

        $country = Country::find($id);

        if (!$country) {
            return response()->json([
                'result' => 'fail',
                'data' => 'There is no country with provided id'
            ], 400);
        }

        return response()->json([
            'result' => 'success',
            'data' => $country
        ]);
    }

    public function getCircuits($id) {

        $country = Country::find($id);

        if (!$country) {
            return response()->json([
                'result' => 'fail',
                'data' => 'There is no country with provided id'
            ], 400);
        }

        $circuits = $country->circuits;

        return response()->json([
            'result' => 'success',
            'data' => $circuits
        ]);
    }
}
