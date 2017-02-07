<?php namespace App\Lib\SessionTimeouts;
use Session;
class SessionActiveUser extends SessionTimeout
{
	//session timeout
	private $session_uses_key = 'session_active_user_timeout';
	private $session_uses_timeout = 600; //300s = 5p*60s
	//UserId cac truy cap trai phep neu ko register, default timeout
	private $session_uses_user_id = 'session_active_user_id';
	//
	private $session_uses_hash_name = 'session_active_hash';
	function __construct()
	{
		$this->setSessionTimeout($this->session_uses_key, $this->session_uses_timeout);
	}
	public function createSessionUses($user_id, $hash){
		$this->createSessionTimeout();
		$this->createSessionUsesUserId($user_id);
		$this->createSessionUsesHash($hash);
	}
	public function checkSessionUses(){
		if($this->checkSessionUsesUserId()){
			if($this->checkSessionTimeout()){
				if($this->checkSessionUsesHash()){
					return true;
				}
			}
		}
		return false;
	}
	//session user id
	protected function createSessionUsesUserId($user_id){
		if(Session::has($this->session_uses_user_id)){
			Session::forget($this->session_uses_user_id);
		}
		Session::put($this->session_uses_user_id, $user_id);
		//Session::save();
	}
	protected function checkSessionUsesUserId(){
		if(Session::has($this->session_uses_user_id)){
			return true;
		}
		return false;
	}
	protected function forgetSessionUsesUserId(){
		if(Session::has($this->session_uses_user_id)){
			Session::forget($this->session_uses_user_id);
		}
	}
	public function getSessionUsesUserId(){
		if(Session::has($this->session_uses_user_id)){
			return Session::get($this->session_uses_user_id);
		}
		return false;
	}
	//
	//session user active hash
	protected function createSessionUsesHash($hash){
		$this->forgetSessionUsesHash();
		//create ss
		Session::put($this->session_uses_hash_name, $hash);
	}
	protected function forgetSessionUsesHash(){
		if(Session::has($this->session_uses_hash_name)){
			Session::forget($this->session_uses_hash_name);
		}
	}
	public function getSessionUsesHash(){
		if(Session::has($this->session_uses_hash_name)){
			return Session::get($this->session_uses_hash_name);
		}
		return false;
	}
	protected function checkSessionUsesHash(){
		if(Session::has($this->session_uses_hash_name)){
			return true;
		}
		return false;
	}
	//
	public function forgetSessionUses(){
		//forget timeout
		$this->forgetSessionTimeout();
		$this->forgetSessionUsesUserId();
		$this->forgetSessionUsesHash();
	}
}

 ?>