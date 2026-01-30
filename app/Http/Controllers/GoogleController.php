<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        $previus = url()->previous();

        if (!str_contains($previus, route('login'))) {
            session()->put('url.intended', $previus);
        }

        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'avatar' => $googleUser->getAvatar(),
                    ]);
                }
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(),
                    'status' => true,
                    'password' => null,
                ]);

                $user->assignRole('Usuario');
            }

            Auth::login($user);

            $intended = session()->pull('url.intended');

            if (!$intended || str_contains($intended, route('login'))) {
                $intended = route('home');
            }

            return redirect($intended);
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Error al iniciar sesión con Google. Por favor intenta nuevamente.');
        }
    }
}
