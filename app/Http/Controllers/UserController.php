<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('home');
    }
    public function register(){
        return view('register');
    }
    public function login(){
        return view('login');
    }
    public function store(UserRequest $request){
        $person = new User($request->all());
        $person->save();
        return response()->json([
            'saved'=> true,
            'person'=> $person
        ]);
    }
    public function edit(User $person){
        return view('user',compact('person'));
    }
    public function update(Request $request, User $user){
        $user = User::where('id',$request['id']);
        $user->update($request->all());
        return response()->json([
            'updated'=> true,
        ], 200);
    }
}
