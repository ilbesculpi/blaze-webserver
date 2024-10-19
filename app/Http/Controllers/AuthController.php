<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function token(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if( Auth::attempt($credentials) ) {
            $user = Auth::user();
            // issue an access token
            $abilities = $user->role === 'sysadmin' ? ['*'] : [$user->role];
            $access_token = $user->createToken($user->role, $user->getTokenAbilities());
            return response()->json([
                'user' => Auth::user(),
                'access_token' => $access_token->plainTextToken,
            ]);
        }
        return response()->json([
            'result' => false,
            'message' => 'Invalid credentials',
        ]);
    }
}
