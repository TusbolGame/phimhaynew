<?php namespace App\Lib\SessionTimeouts;
use Session;
class SessionDownloadFilm extends SessionTimeout
{
	//session timeout for film_id
	private $session_uses_key = 'session_download_film_id_timeout_';
	private $session_uses_timeout = 10800; //3h = 60*3*60
	//UserId cac truy cap trai phep neu ko register, default timeout
	//change
	private $session_uses_id = 'session_active_film_id_';
	private $id = null;
	//
	function __construct($id)
	{
		$this->id = $id;
		$this->session_uses_id = $this->session_uses_id.$this->id;
		$this->setSessionTimeout($this->session_uses_key, $this->session_uses_timeout);
	}
	public function createSessionUses(){
		$this->createSessionTimeout();
		$this->createSessionUsesId();
	}
	public function checkSessionUses(){
		if($this->checkSessionUsesId()){
			if($this->checkSessionTimeout()){
				return true;
			}
		}
		return false;
	}
	//session user id
	protected function createSessionUsesId(){
		if(Session::has($this->session_uses_id)){
			Session::forget($this->session_uses_id);
		}
		Session::put($this->session_uses_id, $this->id);
		//Session::save();
	}
	protected function checkSessionUsesId(){
		if(Session::has($this->session_uses_id)){
			return true;
		}
		return false;
	}
	protected function forgetSessionUsesId(){
		if(Session::has($this->session_uses_id)){
			Session::forget($this->session_uses_id);
		}
	}
	public function getSessionUsesId(){
		if(Session::has($this->session_uses_id)){
			return Session::get($this->session_uses_id);
		}
		return false;
	}
	//
	//
	public function forgetSessionUses(){
		//forget timeout
		$this->forgetSessionTimeout();
		$this->forgetSessionUsesId();
	}
}

 ?>