<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pilot;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PilotAuthController extends Controller {
    public function register(Request $request) {

        $isPilotExists = Pilot::where('email', $request->email)->exists();

        if ($isPilotExists) {
            return response()->json([
                'result' => 'fail',
                'data' => 'This email is already used'
            ], 400);
        }

        try {
            $registerPilotData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:pilots',
                'password' => 'required|min:8'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'result' => 'fail',
                'data' => $e->errors()
            ], 400);
        }

        $pilot = Pilot::create([
            'name' => $registerPilotData['name'],
            'email' => $registerPilotData['email'],
            'email_verified_at' => now(),
            'password' => $registerPilotData['password'],
        ]);

        return response()->json([
            'result' => 'success',
            'data' => [
                'msg' => 'User created',
                'pilot' => $pilot
            ]
        ]);
    }

    public function login(Request $request) {
        try {
            $loginPilotData = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|min:8'
            ]);

            $pilot = Pilot::where('email', $loginPilotData['email'])->first();

            if (!$pilot) {
                return response()->json([
                    'result' => 'fail',
                    'data' => [
                        'email' => 'Wrong email'
                    ]
                ], 400);
            }

            if (!Hash::check($loginPilotData['password'], $pilot->password)) {
                return response()->json([
                    'result' => 'fail',
                    'data' => [
                        'password' => 'Wrong password'
                    ]
                ], 400);
            }

            $token = $pilot->createToken('default')->plainTextToken;

            return response()->json([
                'result' => 'success',
                'data' => [
                    'token' => $token
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'result' => 'fail',
                'data' => $e->errors()
            ], 400);
        }
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
            'result' => 'success',
            'data' => 'Logged out'
        ]);
    }
}