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




        return redirect('https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=77bgrv06l154k7&redirect_uri=http://localhost:8000/auth/linkedin/callback&state=987654321&scope=openid,profile,email');
    }

    public function handleLinkedInCallback()
    {
        $data = Socialite::driver('linkedin');
        dd($data);
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
            'Authorization: Bearer AQVZNEaLWlZwL_0SOWXOCaHBcnP6o1XUgHPaug6XmhHhliK1GvCdBn3q6u5P3RR1DT_CNXwNHlANxazveOfKYRH0tPTmAeuuVH15yDZ9ssLha-pgyH-5Ov5UYtZdTwXwx5dLLcUEdiun1Du-Ee37iYp35vaXE1bvVhFjIGUHUAFpCu354VZ1qs24kb2XSygMclpYMiGNH1q3bZOe9ua4PpRLR3FhiJYO9W-_nmbB7CB_Vssa5DJDGCD21k_4eFClFlz5t_SsIWbAzcABK6IPfUURHzQlUS5jvGHOns6StrjET8JGJchpqEjcUzsKZ5Rx-2CVIQK1_pGnph_KszQo0FIyZpDCxA',
            'Cookie: lidc="b=VB08:s=V:r=V:a=V:p=V:g=5096:u=417:x=1:i=1715955110:t=1716036774:v=2:sig=AQHr6Uh1QUvThwT5-IDrIq6jnIX3rYVv"; bcookie="v=2&18a64836-8371-43fa-8b5f-22d8017b066d"'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        dd(json_decode($response));
        $user = Socialite::driver('linkedin')->user();
        dd($user);

        // Now you can do whatever you want with the user, for example, register or login
    }
}
