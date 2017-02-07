<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;

use App\SocialAccountService;
class SocialAuthController extends Controller {

	public function redirectFacebook()
    {
    	//echo 'ss';die();
        return Socialite::driver('facebook')->redirect();   
    }
    public function callbackFacebook(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->route('home');
    }
}
