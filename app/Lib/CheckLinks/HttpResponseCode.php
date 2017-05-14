<?php namespace App\Lib\CheckLinks;

/**
* 
*/
class HttpResponseCode
{
	protected $header = null;
	protected $status_code = null;
	protected $status_code_error = ['404' => '', '403' => 'gg', '500' => '', '303' => ''];

	function __construct($url = ''){
		$this->header = @get_headers($url);
		$this->status_code = substr($this->header[0], 9, 3);
	}
	public function setUrl($url){
		$this->header = null;
		$this->status_code = null;
		$this->header = @get_headers($url);
		$this->status_code = substr($this->header[0], 9, 3);
	}
	public function setUrlWithCookieDrive($url, $cookie){
		$opts['http']['method']= "HEAD";
		$opts['http']['header'][0]= "Cookie: DRIVE_STREAM=".$cookie->data->DRIVE_STREAM."; path=/; expires=Session; domain=.drive.google.com";
		stream_context_set_default($opts);
		$this->header = @get_headers($url);
		$this->status_code = substr($this->header[0], 9, 3);
	}
	public function getStatusCode(){
		return $this->status_code;
	}
	public function checkHttpResponseCode200(){
		// if(strpos($this->header[0],'200')===false)
		// 	return false;
		if(!empty($this->status_code)){
			if(isset($this->status_code_error[$this->status_code])){
				return false;
			}
		}
		return true;
	}
	public function getStatusCodeName(){
		if(!empty($this->status_code)){
			$status_name = array('200' => 'OK', '404' => 'File Not Found', '403' => 'Permission - Không có quyền truy cập');
			if(isset($status_name[$this->status_code])){
				return $status_name[$this->status_code];
			}
			return 'Dont know status...';
		}
	}
}


 ?>