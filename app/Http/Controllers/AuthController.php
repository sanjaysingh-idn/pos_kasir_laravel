<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function add_user(Request $request)
    {
        // Validation
        $attr = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'email' => $attr['email'],
            'role' => $attr['role'],
            'password' => bcrypt($attr['password'])
        ]);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    public function login(Request $request)
    {
        // Validation
        $attr = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (!Auth::attempt($attr)) {
            return response([
                'message' => 'Email / Password salah.'
            ], 403);
        }
        $user = auth()->user();
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout berhasil.'
        ]);
    }

    public function user()
    {
        return response([
            'user' => User::all(),
        ], 200);
    }

    public function profile()
    {
        return response([
            'user' => auth()->user(),
        ], 200);
    }
}
