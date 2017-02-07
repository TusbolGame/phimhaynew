<?php namespace App\Lib;
/**
* 
*/
use Session;
class UserEncrypt
{
	//mã hóa hash
	// protected $openssl_method = 'aes-128-cbc';
	protected $openssl_method = 'aes128';
	protected $openssl_pass = '1234567812345678';
	protected $openssl_iv = '1234567812345678';
	//
	//tra ve ma hoa
	protected function createOpenSslEncrypt($username)
	{
		//return string --> 16 letter
		return openssl_encrypt($username, $this->openssl_method, $this->openssl_pass, true, $this->openssl_iv);
	}
	//return username, else false
	protected function checkOpenSslDecrypt($username_encrypt)
	{
		return openssl_decrypt($username_encrypt, $this->openssl_method, $this->openssl_pass, true, $this->openssl_iv);
	}
	//pack, converts hex string to raw binary
	protected function packConvertHexStringToRawBinary($hex_string){
		return pack('h*', $hex_string);
	}
	//unpack, converts raw binary to hex, return 1 mang with name 1
	//use $arr[1]
	protected function unpackConvertRawBinaryToHexString($raw){
		return unpack('h*', $raw);
	}
	public function getActivedHash($user_id, $fullname){
		//encrypt user_id
		$id_encrypt = $this->createOpenSslEncrypt($user_id);
		//convert raw to hex
		$id_hex = $this->unpackConvertRawBinaryToHexString($id_encrypt);
		//encrypt md5 fullname random
		$username_md5 = md5($fullname.random_int(1, 30));
		$active_hash = $id_hex[1].'__'.$username_md5;
		return $active_hash;
	}
	public function checkActivedHash($user_id, $active_hash){
		//
		$data = explode('__', $active_hash);
		//id --> data[0], fullname data[1]
		if(count($data) == 2){
			//convert hex to raw
			$id_raw = $this->packConvertHexStringToRawBinary($data[0]);
			//decrypt openssl
			$id_decrypt = $this->checkOpenSslDecrypt($id_raw);
			//check session_user_id with user_id_hash
			if($user_id == $id_decrypt){
				//connect db
				//check is da active chua
				$user = \App\User::find($user_id);
				//chua active
				if($user->actived == 0){
					//get active_hash
					$hash = explode('__', $user->active_hash);
					//check active_hash
					if(count($hash) == 2){
						if($data[1] == $hash[1]){
							return true;
						}
					}
				}
			}
		}
		return false;
	}
	protected function setHash($value)
	{
		// tao hash
		return password_hash($value, PASSWORD_DEFAULT);
	}
	protected function checkHash($value_bd, $value_hash)
	{
		// kt hash
		if(password_verify($value_bd, $value_hash)){
			return true;
		}
		else{
			return false;
		}
	}
	//
}

 ?>