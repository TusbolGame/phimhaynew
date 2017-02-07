<?php namespace App\Lib\SessionTimeouts;
use Session;
class SessionTimeout
{
	//
	private $session_key = null;
	private $session_value = null;
	private $session_timeout = null; 
	//
	public function setSessionTimeout($key, $timeout){
		$this->session_key = $key;
		//$this->session_value = $value;
		$this->session_timeout = $timeout;
	}
	public function createSessionTimeout(){
		if(Session::has($this->session_key)){
			//forget
			Session::forget($this->session_key);
		}
		//create
		$this->session_value = time() + $this->session_timeout;
		Session::put($this->session_key, $this->session_value);
		//Session::save();
	}
	public function checkSessionTimeout(){
		if(Session::has($this->session_key)){
			//check timeout
			//get timeout->value
			if(Session::get($this->session_key) >= time()){
				return true;
			}	 
		}
		return false;
	}
	public function forgetSessionTimeout(){
		if(Session::has($this->session_key)){
			//forget
			Session::forget($this->session_key);
		}
	}
	public function getSessionTimeoutKey(){
		return $this->session_key;
	}
	public function getSessionTimeoutValue(){
		return $this->session_value;
	}
	public function getSessionTimeoutTimeout(){
		return $this->session_timeout;
	}
}
 ?>