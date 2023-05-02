<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Google\Client;
use Socialite;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GoogleController extends Controller
{

    public function redirectToProvider()
    {
        dd("xxx");
        $client = new Client([
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
        ]);

        $authUrl = $client->createAuthUrl(['openid', 'email', 'profile']);

        return redirect()->away($authUrl);
    }

    public function handleProviderCallback(Request $request)
    {
        // ...

        // Here, you can create or retrieve a user record in your database
        // based on the information retrieved from Google.

        $user = User::where('email', $userInfo->getEmail())->first();

        if (!$user) {
            $user = new User();
            $user->name = $userInfo->getName();
            $user->email = $userInfo->getEmail();
            $user->password = Hash::make(Str::random(20));
            $user->save();
        }

        // Auth::login($User);

        // //jika berhasil maka login
        // $tokenResult = $user->createToken('authToken')->plainTextToken;
    
        // return $this->sendResponse([
        //     'access_token' => $tokenResult,
        //         'token_type' => 'Bearer',
        //         'user' => $user
        // ], 'Authenticated');
    }
}