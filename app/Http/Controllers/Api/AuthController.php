<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            return response()->json(['message' => 'Invalid credentials.'], 422);
        }

        $user = Auth::user();
        $tokenName = $credentials['device_name'] ?? 'api-token';
        $token = $user->createToken($tokenName)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => new UserResource($user->load(['roles', 'permissions', 'warehouse'])),
        ]);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user()->load(['roles', 'permissions', 'warehouse']));
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out successfully.']);
    }
}
