<?php namespace App\Lib\CheckLinks;

/**
* chua fix
*/
class FilmCheckLink extends HttpResponseCode
{
	
	protected $film_successes = [];
	protected $film_errors = [];
	protected $http_response_code = null;

	//
	function __construct($url){
		$this->setUrl($url);
	}
	//
	public function checkImagePoster(){

	}
}


 ?>