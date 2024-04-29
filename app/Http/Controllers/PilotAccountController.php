<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PilotAccountController extends Controller {
    public function getCurrentPilot(Request $request) {
        $pilot = $request->user();

        return response()->json([
            'result' => 'success',
            'data' => $pilot
        ]);
    }

    public function getPilotCircuits(Request $request) {
        $circuits = $request->user()->circuits;
        return response()->json([
            'result' => 'success',
            'data' => $circuits
        ]);
    }

    public function deletePilot(Request $request) {
        $pilot = $request->user();

        $pilot->delete();

        return response()->json([
            'result' => 'success',
            'data' => 'Pilot deleted'
        ]);
    }
}