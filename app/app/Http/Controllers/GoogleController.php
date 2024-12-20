<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleController extends Controller
{

    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(): JsonResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $googleUser->getEmail(),
        ],
            [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16))
            ]);

        Auth::login($user);

        return response()->json(['token' => $user->createToken('Google API Token')
            ->plainTextToken,
        ]);

    }
}
