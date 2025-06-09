<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login user dengan email dan password.
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (empty($data['email']) || empty($data['password'])) {
            return response()->json([
                'status_code' => 400,
                'message' => 'Email dan password harus diisi',
            ], 400);
        }

        if (!Auth::attempt($data)) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'message' => 'Login berhasil',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
            ],
            'token' => $token,
        ], 200);
    }

    /**
     * Logout user yang sedang login.
     */
    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'message' => 'Logout berhasil',
        ], 200);
    }
}