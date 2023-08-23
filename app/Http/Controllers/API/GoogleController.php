<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function CallbackGoogle()
    {
        try{
            $google_user = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user){
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId()
                ]);

                Auth::login($new_user);

                return redirect()->intended('dashboard');
            }
            else{
                Auth::login($user);

                return redirect()->intended('dashboard');
            }

        } catch (\Throwable $th) {
            ('Something went wrong! '. $th->getMessage());
        }
    }
}