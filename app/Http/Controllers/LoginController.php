<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials, true)) {
            return response()->json([
                'logged' => true,
                'user' => User::select(['email', 'id'])->whereId(Auth::id())->first()
            ], 200);
        } else {
            return response()->json([
                'logged' => false,
                'errors' => 'Email or Password are Incorrect!'
            ], 422);
        }
    }
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'logout' => true
        ]);
    }
}
