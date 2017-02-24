<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RecoverRequest;
use Hash;
use Auth;
use App\Lib\UserEncrypt;
use Session;
use App\Lib\CaptchaImages\CaptchaSessionLoginUser;
use App\Lib\CaptchaImages\CaptchaSessionRegisterUser;
use App\Lib\SessionTimeouts\SessionActiveUser;
use App\Lib\SessionTimeouts\SessionTimeout;
use App\Lib\RandomGenerates\RandomGenerate;
use App\User;
use Mail;
use Request;
use App\UserSession;
class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	//
	// 
	public function getLogin(){
		return view('phimhay.user.login');
	}
	public function postLogin(LoginRequest $request){
		$captcha_login = new CaptchaSessionLoginUser();
		$captcha_login->createCheckCaptchaSessionUses($request->txtCaptchaLogin);
		//check captcha
		if($captcha_login->checkCaptchaSessionUses()){
			//all user_login
			$login = [
				'username' => $request->txtUsername,
				'password' => $request->txtPassword,
				'actived' => 1,
				'blocked' => 0
			];
			//var_dump($login);
			if($request->has('chkRemember')){
				//co remember
				if($this->auth->attempt($login, true)){
					//count user login
					//UserSession::updateCurrent();
					//$key = $this->auth->getRecallerName();
					// Adding the cookie to the next outgoing response, with a one-day expiry.
					//cookie()->queue($key, cookie()->get($key), 1440);
					return redirect('/');
				}else{
					return redirect()->back()->with('errors_login', '* Tài khoản hoặc Mật khẩu không đúng hoặc chưa kích hoạt, hoặc bị khóa!!');
				}
			}else{
				//ko co remember
				if($this->auth->attempt($login)){
					return redirect('/');
				}else{
					return redirect()->back()->with('errors_login', '* Tài khoản hoặc Mật khẩu không đúng hoặc chưa kích hoạt, hoặc bị khóa!!');
				}
			}
			
		}else{
			return redirect()->back()->with('errors_captcha_login', '* Sai Mã bảo vệ hoặc hết thời gian Timeout!!');
		}
		
		
	}
	//register
	public function getRegister(){
		return view('phimhay.user.register');
	}
	
	public function postRegister(RegisterRequest $request){
		//check captcha
		$captcha_register = new CaptchaSessionRegisterUser();
		$captcha_register->createCheckCaptchaSessionUses($request->txtCaptchaRegister);
		//check captcha
		if($captcha_register->checkCaptchaSessionUses()){
			//delete captcha register session
			$captcha_register->forgetCaptchaSessionUses();
			$user = new User();
			$user->username = $request->txtUsername;
			$user->password = Hash::make($request->txtPass);
			$user->first_name = $request->txtFirstName;
			$user->last_name = $request->txtLastName;
			$user->email = $request->txtEmail;
			$user->level = 2; //is member
			$user->actived = 1; //is active
			$user->blocked = 0;
			$user->active_hash = null;
			$user->recover_hash = null;
			$user->remember_token = $request->_token;
			$user->save();
			//dk thanh cong
			return redirect()->route('auth.getActiveMessage')->with(['message_active'=>'is_active_success']);
			
		}
		//sai captcha or het timeout
		return redirect()->back()->with(['errors_captcha_register'=>'Sai mã bảo vệ hoặc hết thời gian timeout!'])->withInput();	
	}
	//is active with email
	public function postRegisterActive(RegisterRequest $request){
		//check captcha
		$captcha_register = new CaptchaSessionRegisterUser();
		$captcha_register->createCheckCaptchaSessionUses($request->txtCaptchaRegister);
		//check captcha
		if($captcha_register->checkCaptchaSessionUses()){
			//delete captcha register session
			$captcha_register->forgetCaptchaSessionUses();
			$user = new User();
			$user->username = $request->txtUsername;
			$user->password = Hash::make($request->txtPass);
			$user->first_name = $request->txtFirstName;
			$user->last_name = $request->txtLastName;
			$user->email = $request->txtEmail;
			$user->level = 2; //is member
			$user->actived = 0; //chua active
			$user->blocked = 0;
			$user->active_hash = null;
			$user->recover_hash = null;
			$user->remember_token = $request->_token;
			$user->save();
			//
			//gerena code active 
			$user_encrypt = new UserEncrypt();
			$user_id = $user->id;
			$username = $user->username;
			$fullname = $user->first_name.' '.$user->last_name;
			$email = $user->email;
			//update active_hash
			$user = User::find($user_id);
			//create active_hash
			//2 ts: id, username
			$user->active_hash = $user_encrypt->getActivedHash($user_id, $fullname);
			$user->save();
			//echo route('auth.getActive', $user->active_hash);
			//test not mail
			//active_timeout->createSessionUses($user_id, $user->active_hash);
			//end test not mail
			die();
			//send mail code active
			//send mail  if success thi insert db, else back()
			if($this->sendMailActiveUser($username, $fullname, $email, $user->active_hash)){
				//set timeout, send mail success
				$active_timeout = new SessionActiveUser();
				$active_timeout->createSessionUses($user_id, $user->active_hash);
				//redirect, message validate active mail
				return redirect()->route('auth.getActiveMessage')->with(['message_active'=>'send_active_success', 'email' => $email]);
			}else{
				//send mail not success
				//delete user_id
				$user = User::find($user_id);
				$user->delete();
				return redirect()->back()->with(['mail_active_not_success' => 'Email không tồn tại!'])->withInput();
			}
		}
		//sai captcha or het timeout
		return redirect()->back()->with(['errors_captcha_register'=>'Sai mã bảo vệ hoặc hết thời gian timeout!'])->withInput();	
	}
	public function getActive($code){
		var_dump(Session::all());
		var_dump(time());
		// die();
		$active_timeout = new SessionActiveUser();
		//echo $active_timeout->getSessionTimeoutKey();
		// die();
		//check timeout
		if($active_timeout->checkSessionUses()){
			//con timeout
			$user_id_ss = $active_timeout->getSessionUsesUserId();
			//kt active_hash
			$user_encrypt = new UserEncrypt();
			if($user_encrypt->checkActivedHash($user_id_ss, $code)){
				//is active
				//update active user
				$user = User::find((int)$user_id_ss);
				$user->actived = 1;
				$user->save();
				//forget all session active
				$active_timeout->forgetSessionUses();
				echo 'yes';
				//redirect active-message
				//return redirect()->route('auth.getActiveMessage')->with(['message_active'=>'active_success']);
			}
			echo 'not active';
			//return redirect()->route('auth.getActiveMessage')->with(['message_active'=>'active_not_success']);
		}

		//ko exixst request
		echo 'ko co yc';
		//return redirect()->route('auth.getActiveMessage');
	}
	public function getLogout(){
		if (Auth::check()) {
			Auth::logout();
		}
		return redirect()->route('home');
	}
	protected function sendMailActiveUser($username, $fullname, $email, $code){
		Mail::send('phimhay.user.mail-active-user', ['username' => $username, 'fullname' => $fullname, 'code' => $code], function ($message) use ($email)
        {

            $message->from(env('MAIL_USERNAME'), 'PhimHay Administrator');

            $message->to($email);
            $message->subject('PhimHay - Kích hoạt tài khoản');
        });
       	if(count(Mail::failures())>0){
       		return false;
       	}
       	return true;
	}
	protected function sendMailRecoverUser($username, $fullname, $email, $pass_new){
		Mail::send('phimhay.user.mail-recover-user', ['username' => $username, 'fullname' => $fullname, 'pass_new' => $pass_new], function ($message) use ($email)
        {

            $message->from(env('MAIL_USERNAME'), 'PhimHay Administrator');

            $message->to($email);
            $message->subject('PhimHay - Kích hoạt tài khoản');
        });
       	if(count(Mail::failures())>0){
       		return false;
       	}
       	return true;
	}
	public function getActiveMessage(){
		return view('phimhay.user.active-message');
	}
	public function getActiveSend(){
	}
	public function postActiveSend(){
		echo 'waiting...';
		//check block active
		$active_timeout = new SessionActiveUser();
		if($active_timeout->checkSessionUses()){

			//get infor
			$user_encrypt = new UserEncrypt();
			//neu ton tai session active hash
			if($user_encrypt->checkActivedHash($active_timeout->getSessionUsesUserId(), $active_timeout->getSessionUsesHash())){
				//chua active
				//get id
				$user_id = $active_timeout->getSessionUsesUserId();

				$user = User::find($user_id);
				//random lai active hash
				$active_hash = $user_encrypt->getActivedHash($user_id, $user->username);
				//send email
				if($this->sendMailActiveUser($user->username, $user->first_name.' '.$user->last_name, $user->email, $active_hash)){
					//
					//set timeout, send mail success
					$active_timeout->createSessionUses($user_id, $active_hash);
					//update active hash
					$user->active_hash = $active_hash;
					$user->save();
					//echo $active_hash;
					return redirect()->route('auth.getActiveMessage')->with(['message_active'=>'send_active_success_again', 'email' => $user->email]);
				}else{
					//not success send mail
				}
			}
			
		}
		//ko exixst request
		return redirect()->route('auth.getActiveMessage');
	}
	//reco
	public function getRecover(){
		return view('phimhay.user.recover');
		

	}
	public function postRecover(RecoverRequest $request){
		$user = User::where('username', $request->txtUsername)->first();
		if(count($user) == 1){
			//ton tai user
			//check email
			if($user->email == $request->txtEmail){
				//email dung
				//random pass
				$random = new RandomGenerate();
				$pass_new = $random->getGeneratePassword();
				//send mail recover
				if($this->sendMailRecoverUser($user->username, $user->first_name.' '.$user->last_name, $user->email, $pass_new)){
					$user2 = User::find($user->id);
					$user->password = Hash::make($pass_new);
					$user->save();
					return redirect()->route('auth.getRecoverMessage')->with(['recover-result' => 'recover_sucess']);
				}
			}
			//email sai
			return redirect()->back()->withErrors('Sai Email')->withInput();
		}
		//ko ton tai user
		return redirect()->back()->withErrors('Thành viên không tồn tại')->withInput();
	}
	public function getRecoverMessage(){
		return view('phimhay.user.recover-message');
		

	}

}
?>
