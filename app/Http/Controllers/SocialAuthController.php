<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use App\User;

use Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function callback()
    {
        $user = Socialite::driver('github')->user();

        $email = $user->getEmail();

        $account = User::where('email', $email)->first();

        if ($account) {
            Auth::loginUsingId($account->id);
        } 

        

        return redirect()->to('/home');
        // $user->token;
    }
}
