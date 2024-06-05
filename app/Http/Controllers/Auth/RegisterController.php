<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        //make validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        //create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        //we will create token 
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json([
            'token' => $token,
            'data' => new UserResource($user)
        ], 200);
    }
}
