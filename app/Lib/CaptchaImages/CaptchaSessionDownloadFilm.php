<?php namespace App\Lib\CaptchaImages;

class CaptchaSessionDownloadFilm extends CaptchaSession
{
	private $captcha_name_name = 'download_film';
	private $captcha_uses_name = null;
	private $captcha_uses_value = null;
	//timeout
	private $captcha_uses_timeout = 200; //200s

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