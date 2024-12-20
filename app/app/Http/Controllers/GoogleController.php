<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user=User::firstOrCreate([
           'email' => $googleUser->getEmail(),
        ],
        [
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id'=>$googleUser->getId(),
            'password' => bcrypt(Str::random(16))
        ]);

        Auth::login($user);

        return response()->json(['token' => $user->createToken('Google API Token')
            ->plainTextToken,
        ]);

    }
}
