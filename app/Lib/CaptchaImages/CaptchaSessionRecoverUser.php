<?php namespace App\Lib\CaptchaImages;

class CaptchaSessionRecoverUser extends CaptchaSession
{
	//change name
	private $captcha_name_name = 'recover_user';
	//captcha
	private $captcha_uses_name = null;
	private $captcha_uses_value = null;
	//timeout
	private $captcha_uses_timeout = 600; //10p

	//
	function __construct()
	{
		$this->captcha_uses_name = 'captcha_session_'.$this->captcha_name_name;
	}
	public function createAndGetCaptchaSessionUses(){
		$image = new CaptchaImage();
		$this->captcha_uses_value = $image->getShowCaptchaImage();
		//
		$this->setCaptchaSession($this->captcha_uses_name, $this->captcha_uses_value, $this->captcha_uses_timeout);
		$this->createCaptchaSession();
	}
	public function createCheckCaptchaSessionUses($captcha_input){
		$this->createCheckCaptchaSession($this->captcha_uses_name, $captcha_input);
	}
	//check
	public function checkCaptchaSessionUses(){
		return $this->checkCaptchaSession();
	}
	public function forgetCaptchaSessionUses(){
		$this->forgetCaptchaSession();
	}

}

?>