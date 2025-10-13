<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json('Authentication failed', 401);
        }
        $token = Auth::user()->createToken('authToken')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => Auth::user()
        ]);
    }
}
