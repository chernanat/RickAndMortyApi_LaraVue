<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->all(), true)) {
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
