<?php namespace App\Lib\CaptchaImages;

use Session;
use App\Lib\SessionTimeouts\SessionTimeout;
class CaptchaSession
{
	
	//
	private $captcha_name = null;
	private $captcha_value = null;
	//timeout
	private $captcha_timeout = null;
	//SessionTimeout
	private $session_timeout = null;
	private $session_timeout_name = null;
	//check
	private $captcha_value_input = null;

	//
	public function setCaptchaSession($name, $value, $timeout)
	{
		$this->captcha_name = $name;
		$this->captcha_value = $value;
		$this->captcha_timeout = $timeout;
		$this->session_timeout = new SessionTimeout();
		$this->setSessionTimeoutName($this->captcha_name);
	}

	public function createCaptchaSession(){
		//session store
		if(Session::has($this->captcha_name)){
			//forget
			Session::forget($this->captcha_name);
		}
		Session::put($this->captcha_name , $this->captcha_value);
		//timeout
		$this->session_timeout->setSessionTimeout($this->session_timeout_name, $this->captcha_timeout);
		//create
		$this->session_timeout->createSessionTimeout();
	}
	public function createCheckCaptchaSession($name, $captcha_input){
		$this->captcha_name = $name; // name captcha
		$this->captcha_value_input = $captcha_input;
		//set sessiontimeout name
		$this->setSessionTimeoutName($this->captcha_name);
		//
		$this->session_timeout = new SessionTimeout();
		$this->session_timeout->setSessionTimeout($this->session_timeout_name, '');
	}
	//check
	public function checkCaptchaSession(){
		//check timeout
		if($this->session_timeout->checkSessionTimeout()){
			// session captcha
			if(Session::has($this->captcha_name)){
				//so sanh 2 gia tri
				if(Session::get($this->captcha_name) == $this->captcha_value_input){					
					return true;
				}
			}
		}
		return false;
	}
	public function forgetCaptchaSession(){
		if(Session::has($this->captcha_name)){
			Session::forget($this->captcha_name);
		}
		if(!empty($this->session_timeout)){
			$this->session_timeout->forgetSessionTimeout();
		}
		
	}
	public function setSessionTimeoutName($name){
		$this->session_timeout_name = $name.'_timeout';
	}
}

?>