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
        if($user->blocked == 1){
            return redirect()->route('auth.getLogin')->withErrors(['Tài khoản đã bị khóa! Vui lòng liên hệ Admin để biết thêm chi tiết']);
        }
        auth()->login($user);

        return redirect()->route('home');
    }
}
