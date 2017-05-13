<?php namespace App\Lib\ProxyStreamingVideos;

/**
* edit
*/
class ProxyStreamingVideo
{
	
	function __construct()
	{
		# code...
	}
	//ok;
	function getStreamDrive($url_video, $cookie){
		
		//http://stackoverflow.com/questions/8401412/php-streaming-video-handler
		$real_file_location_path_or_url = $url_video;
		// ini_set('memory_limit','1024M');
		ini_set('memory_limit','100M'); //10M
		set_time_limit(3600);
		ob_start();
		// do any user checks here - authentication / ip restriction / max downloads / whatever**

		// if check fails, return back error message**

		// if check succeeds, proceed with code below**

		if( isset($_SERVER['HTTP_RANGE']) )

		$opts['http']['header'][0]="Range: ".$_SERVER['HTTP_RANGE'];

		$opts['http']['method']= "HEAD";
		$opts['http']['header'][1]= "Cookie: DRIVE_STREAM=".$cookie->data->DRIVE_STREAM."; path=/; expires=Session; domain=.drive.google.com";

		$conh=stream_context_create($opts);

		$opts['http']['method']= "GET";

		$cong= stream_context_create($opts);

		$out[]= file_get_contents($real_file_location_path_or_url,false,$conh);

		$out[]= $http_response_header;

		ob_end_clean();

		array_map("header",$http_response_header);

		readfile($real_file_location_path_or_url,false,$cong);
		exit;
	}
}


 ?>