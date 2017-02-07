<?php namespace App\Lib\SessionTimeouts;
use Session;
class SessionActiveUser extends SessionTimeout
{
	//
	private $session_uses_key = 'session_key_recover_user';
	private $session_uses_timeout = 600; //300s = 5p*60s
	//block cac truy cap trai phep neu ko recover, time 2h,session
	private $session_uses_block = 'session_block_recover_user';
	//
	function __construct()
	{
		$this->setSessionTimeout($this->session_uses_key, $this->session_uses_timeout);
	}
	public function createSessionUses(){
		$this->createSessionTimeout();
	}
	public function checkSessionUses(){
		return $this->checkSessionTimeout();
	}
	public function createSessionUsesBlock(){
		if(Session::has($this->session_uses_block)){
			Session::forget($this->session_uses_block);
		}
		Session::put($this->session_uses_block, time());
		//Session::save();
	}
	public function checkSessionUsesBlock(){
		if(Session::has($this->session_uses_block)){
			return true;
		}
		return false;
	}
	public function forgetSessionUsesBlock(){
		if(Session::has($this->session_uses_block)){
			Session::forget($this->session_uses_block);
		}
	}
	public function forgetSessionUses(){
		//forget timeout
		$this->forgetSessionTimeout();
		$this->forgetSessionUsesBlock();
	}
}

 ?>