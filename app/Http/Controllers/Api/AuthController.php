<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = User::query()->create($request->all());

            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => "User created successfully",
                'token' => $token,
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            Auth::attempt($credentials);

            $token = $request->user()->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => "Login successfully",
                'token' => $token,
            ]);
        } catch (\Exception $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();

        // $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
