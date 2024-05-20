<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        dd(Socialite::driver('google')->user());
        $user = Socialite::driver('google')->user();
        dd($user);
        // Now you can do whatever you want with the user, for example, register or login
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        dd(Socialite::driver('facebook')->user());
        $user = Socialite::driver('facebook')->user();
        dd($user);

        // Now you can do whatever you want with the user, for example, register or login
    }

    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        dd(Socialite::driver('apple'));
        $user = Socialite::driver('apple')->user();
        dd($user);

        // Now you can do whatever you want with the user, for example, register or login
    }


    public function redirectToLinkedIn()
    {
        // return "sdf";
        // return Socialite::driver('linkedin')->redirect();


        return redirect('https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=77bgrv06l154k7&redirect_uri=http://localhost:8000/auth/linkedin/callback&state=foobar&scope=openid,profile,email');

        return redirect('https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=77bgrv06l154k7&redirect_uri=http://localhost:8000/auth/linkedin/callback&state=987654321&scope=openid,profile,email');
    }

    public function handleLinkedInCallback()
    {
        $data = Socialite::driver('linkedin');
        $code = $_GET['code'];
        // dd($data);
        // dd($_GET['code']);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.linkedin.com/oauth/v2/accessToken',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=authorization_code&code=' . $code . '&client_id=77bgrv06l154k7&client_secret=WPL_AP0.tFWe9WSkPIAsD5Sk.NDkzNjU1NDY0&redirect_uri=http%3A%2F%2Flocalhost%3A8000%2Fauth%2Flinkedin%2Fcallback',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: bcookie="v=2&18a64836-8371-43fa-8b5f-22d8017b066d"; lang=v=2&lang=en-us; lidc="b=VB08:s=V:r=V:a=V:p=V:g=5111:u=417:x=1:i=1716187260:t=1716258984:v=2:sig=AQGovATzVUkScGCHnBJ9dhlPOzIgn6ht"; bscookie="v=1&2024052006315865e1f790-d3ab-4f42-82d5-1cd7ed2c5d01AQGc-Ve6CAZhaWHpOBn6yEOnjijzX6gB"'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $access_token = json_decode($response)->access_token;


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.linkedin.com/v2/userinfo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $access_token,
                'Cookie: lidc="b=VB08:s=V:r=V:a=V:p=V:g=5096:u=417:x=1:i=1715955110:t=1716036774:v=2:sig=AQHr6Uh1QUvThwT5-IDrIq6jnIX3rYVv"; bcookie="v=2&18a64836-8371-43fa-8b5f-22d8017b066d"'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        dd(json_decode($response));
        // $user = Socialite::driver('linkedin')->user();
        // dd($user);

        // Now you can do whatever you want with the user, for example, register or login
    }
}
