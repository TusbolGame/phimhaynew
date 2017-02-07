<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//
use App\Lib\CaptchaImages\CaptchaSessionLoginUser;
use App\Lib\CaptchaImages\CaptchaSessionRegisterUser;
use App\Lib\CaptchaImages\CaptchaSessionRecoverUser;
class CaptchaController extends Controller {

	public function getCaptchaLoginUser($id){
		$captcha_login = new CaptchaSessionLoginUser();
		$captcha_login->forgetCaptchaSessionUses();
		$captcha_login->createAndGetCaptchaSessionUses();
	}
	public function getCaptchaRegisterUser($id){
		$captcha_register = new CaptchaSessionRegisterUser();
		$captcha_register->forgetCaptchaSessionUses();
		$captcha_register->createAndGetCaptchaSessionUses();
	}
	public function getCaptchaRecoverUser($id){
		$captcha_recover = new CaptchaSessionRecoverUser();
		$captcha_recover->forgetCaptchaSessionUses();
		$captcha_recover->createAndGetCaptchaSessionUses();
	}
}
