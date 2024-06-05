<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    public function login(Request $request)
    {

        //make validation
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|max:2550'
        ]);
        //get user
        $user = User::where('email', $request->email)->first();
        //check if user exist and his password
        if ($user && Hash::check($request->password, $user->password)) {

            //generate token
            $token = $user->createToken('LaravelAuthApp')->accessToken;
            return response()->json([
                'token' => $token,
                'data' => new UserResource($user)
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    //revoke token to logout
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->token()->revoke();
            return response()->json(['message' => 'logged out successfully ']);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    //temp response for middleware (auth)
    public static function authView()
    {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
