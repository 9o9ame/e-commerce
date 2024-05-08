<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // return 'not work';
        $user = Socialite::driver('google')->user();
        // Now you can do whatever you want with the user, for example, register or login
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        return "hello";
        $user = Socialite::driver('facebook')->user();

        // Now you can do whatever you want with the user, for example, register or login
    }

    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        $user = Socialite::driver('apple')->user();

        // Now you can do whatever you want with the user, for example, register or login
    }

    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedInCallback()
    {
        $user = Socialite::driver('linkedin')->user();

        // Now you can do whatever you want with the user, for example, register or login
    }
}
