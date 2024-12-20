<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $user = Auth::user();

            return response()->json(['token' => $user->createToken('API Token')->plainTextToken]);
        }

        return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out successfully']);
    }
}
