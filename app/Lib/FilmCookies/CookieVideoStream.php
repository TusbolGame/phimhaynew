<?php namespace App\Lib\FilmCookies;
use Cookie;
//name cookie -> vd.mp4 -> to -> vd
//

class CookieVideoStream
{
	private $cookie_name = null;
	private $cookie_value = null;
	private $cookie_time = 240;// 4h
	function __construct($name)
	{
		//cookie name: ko chua ki tu dau cham "."
		// $this->cookie_name = $name;
		$this->cookie_name = str_replace('.', '-', $name);
		$this->cookie_value = time() + (int)$this->cookie_time*60;
		//

	}
	public function createCookie(){
		Cookie::queue($this->getCookieNameEncrypt(), $this->cookie_value, $this->cookie_time);
	}
	public function checkCookie(){
		//check
		if(Cookie::get($this->getCookieNameEncrypt($this->cookie_name))){
			if((int)Cookie::get($this->getCookieNameEncrypt()) > time()){
				return true;
			}
		}
		return false;
	}
	public function getCookieName(){
		return $this->cookie_name;
		// return $this->cookie_time;
	}
	protected function getCookieNameEncrypt(){
		// return Crypt::encrypt($this->cookie_name);
		return $this->cookie_name;
	}
}
?>
