<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => auth()->guard('api')->user()
        ]);
    }

    public function logout()
    {
        auth()->guard('api')->logout();
        return response()->json(['message' => 'Logged out']);
    }
}

  


