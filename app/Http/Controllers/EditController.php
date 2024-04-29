<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EditController extends Controller {

    public function addCountry(Request $request) {

        $isCountryExists = Country::where('name', $request->name)->exists();

        if ($isCountryExists) {
            return response()->json([
                'result' => 'fail',
                'data' => 'This country is already exists'
            ], 400);
        }

        try {
            $validatedCountry = $request->validate([
                'name' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'result' => 'fail',
                'data' => $e->errors()
            ], 400);
        }

        $newCountry = new Country();
        $newCountry->name = $validatedCountry['name'];
        $newCountry->save();

        return response()->json([
            'result' => 'success',
            'data' => [
                'msg' => 'Country added',
                'country' => $newCountry
            ]
        ]);
    }

    public function addCircuit(Request $request) {

        $isCircuitExists = Circuit::where('name', $request->name)->exists();

        if ($isCircuitExists) {
            return response()->json([
                'result' => 'fail',
                'data' => 'This circuit is already exists'
            ], 400);
        }

        try {
            $validatedCircuit = $request->validate([
                'name' => 'required|string',
                'country_id' => 'required|exists:countries,id',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'result' => 'fail',
                'data' => $e->errors()
            ], 400);
        }

        $circuit = Circuit::create([
            'name' => $validatedCircuit['name'],
            'country_id' => $validatedCircuit['country_id'],
        ]);

        return response()->json([
            'result' => 'success',
            'data' => [
                'msg' => 'Circuit added',
                'circuit' => $circuit
            ]
        ]);
    }

    public function patchCountry(Request $request) {

        $isCountryExists = Country::where('id', $request->id)->exists();

        if (!$isCountryExists) {
            return response()->json([
                'result' => 'fail',
                'data' => 'There is no country with provided id'
            ], 400);
        }

        try {
            $validatedCountry = $request->validate([
                'name' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'result' => 'fail',
                'data' => $e->errors()
            ], 400);
        }

        $country = Country::find($request->id);

        if ($country->name == $validatedCountry['name']) {
            return response()->json([
                'result' => 'fail',
                'data' => 'No changes'
            ], 400);
        }

        $country->name = $validatedCountry['name'];
        $country->save();

        return response()->json([
            'result' => 'success',
            'data' => [
                'msg' => 'Country patched',
                'country' => $country
            ]
        ]);
    }

    public function patchCircuit(Request $request) {

        $isCircuitExists = Circuit::where('id', $request->id)->exists();

        if (!$isCircuitExists) {
            return response()->json([
                'result' => 'fail',
                'data' => 'There is no circuit with provided id'
            ], 400);
        }

        try {
            $validatedCircuit = $request->validate([
                'name' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'result' => 'fail',
                'data' => $e->errors()
            ], 400);
        }

        $circuit = Circuit::find($request->id);

        if ($circuit->name == $validatedCircuit['name']) {
            return response()->json([
                'result' => 'fail',
                'data' => 'No changes'
            ], 400);
        }

        $circuit->update([
            'name' => $validatedCircuit['name']
        ]);

        return response()->json([
            'result' => 'success',
            'data' => [
                'msg' => 'Circuit patched',
                'country' => $circuit
            ]
        ]);
    }

    public function deleteCountry(Request $request) {

        $isCountryExists = Country::where('id', $request->id)->exists();

        if (!$isCountryExists) {
            return response()->json([
                'result' => 'fail',
                'data' => 'There is no country with provided id'
            ], 400);
        }

        $country = Country::find($request->id);
        $country->delete();

        return response()->json([
            'result' => 'success',
            'data' => [
                'msg' => 'Country deleted',
            ]
        ]);
    }

    public function deleteCircuit(Request $request) {

        $isCircuitExists = Circuit::where('id', $request->id)->exists();

        if (!$isCircuitExists) {
            return response()->json([
                'result' => 'fail',
                'data' => 'There is no circuit with provided id'
            ], 400);
        }

        $circuit = Circuit::find($request->id);
        $circuit->delete();

        return response()->json([
            'result' => 'success',
            'data' => [
                'msg' => 'Circuit deleted',
            ]
        ]);
    }
}
