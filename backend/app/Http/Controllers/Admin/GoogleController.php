<?php

namespace App\Http\Controllers\Admin;

use Google_Client;
use Google_Service_Gmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // return "oisfdgoi";
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->addScope(Google_Service_Gmail::GMAIL_READONLY);
        $client->addScope(Google_Service_Gmail::GMAIL_SEND);
        $client->addScope(Google_Service_Gmail::GMAIL_MODIFY);

        return redirect()->away($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        // dd($request);
        $client = new Google_Client();
        $client->setClientId(config('google.client_id'));
        $client->setClientSecret(config('google.client_secret'));
        $client->setRedirectUri(config('google.redirect_uri'));

        if ($request->input('code')) {
            $client->authenticate($request->input('code'));
            $token = $client->getAccessToken();
            Session::put('google_token', $token);
            return redirect('/emails');
        }

        return redirect('/')->with('error', 'Failed to authenticate with Google.');
    }

    public function listEmails()
    {
        $client = new Google_Client();
        $client->setAccessToken(Session::get('google_token'));

        if ($client->isAccessTokenExpired()) {
            return redirect('/auth/google-gmail');
        }

        $service = new Google_Service_Gmail($client);
        $messages = $service->users_messages->listUsersMessages('me', ['maxResults' => 10]);

        $emails = [];
        foreach ($messages->getMessages() as $message) {
            $email = $service->users_messages->get('me', $message->getId());
            $emails[] = $email;
        }

        dd($emails);
        return view('emails.list', ['messages' => $messages]);
    }

    public function sendEmail(Request $request)
    {
        $client = new Google_Client();
        $client->setAccessToken(Session::get('google_token'));

        if ($client->isAccessTokenExpired()) {
            return redirect('/auth/google-gmail');
        }

        $service = new Google_Service_Gmail($client);

        $message = new \Google_Service_Gmail_Message();
        $rawMessage = "From: " . $request->input('from') . "\r\n";
        $rawMessage .= "To: " . $request->input('to') . "\r\n";
        $rawMessage .= "Subject: " . $request->input('subject') . "\r\n\r\n";
        $rawMessage .= $request->input('body');

        $message->setRaw(strtr(base64_encode($rawMessage), array('+' => '-', '/' => '_')));
        $service->users_messages->send('me', $message);

        return redirect('/emails')->with('success', 'Email sent!');
    }
}
