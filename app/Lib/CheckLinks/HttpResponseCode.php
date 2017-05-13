<?php namespace App\Lib\CheckLinks;

/**
* 
*/
class HttpResponseCode
{
	protected $header = null;
	protected $status_code = null;

	function __construct($url = ''){
		$this->header = @get_headers($url);
		$this->status_code = substr($this->header[0], 9, 3);
	}
	public function setUrl($url){
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
		if(!empty($this->status_code) && ($this->status_code == '404' || $this->status_code == '403')){
			return false;
		}
		return true;
	}
	public function getStatusCodeName(){
		if(!empty($this->status_code)){
			switch ($this->status_code) {
				case '200':
					return 'OK';
					break;
				case '404':
					return 'File Not Found';
					break;
				case '403':
					return 'Permission - Không có quyền truy cập';
					break;
				default:
					return 'Status not found';
					break;
			}
		}
	}
}


 ?>