<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // Google user object dari google
        $userFromGoogle = Socialite::driver('google')->user();

        // Ambil user dari database berdasarkan google user id
        $userFromDatabase = User::where('google_id', $userFromGoogle->getId())->first();

        // Jika tidak ada user, maka buat user baru
        if (!$userFromDatabase) {
            $newUser = new User([
                'google_id' => $userFromGoogle->getId(),
                'name' => $userFromGoogle->getName(),
                'email' => $userFromGoogle->getEmail(),
                'password' => bcrypt('password'),
                'slug' => Str::slug($userFromGoogle->getName()),
            ]);

            $newUser->save();
            $newUser->assignRole(RoleEnum::USER->value);

            // Login user yang baru dibuat
            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('/');
        }

        // Jika ada user langsung login saja
        auth('web')->login($userFromDatabase);
        session()->regenerate();

        return redirect('/');
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(): RedirectResponse
    {
        $userFromFacebook = Socialite::driver('facebook')->user();
        $userFromDatabase = User::where('facebook_id', $userFromFacebook->getId())->first();
        if (!$userFromDatabase) {
            $newUser = new User([
                'google_id' => $userFromFacebook->getId(),
                'name' => $userFromFacebook->getName(),
                'email' => $userFromFacebook->getEmail(),
                'password' => bcrypt('password'),
                'slug' => Str::slug($userFromFacebook->getName()),
            ]);

            $newUser->save();
            $newUser->assignRole(RoleEnum::USER->value);

            auth('web')->login($newUser);
            session()->regenerate();

            return redirect('/');
        }

        auth('web')->login($userFromDatabase);
        session()->regenerate();

        return redirect('/');
    }
}
