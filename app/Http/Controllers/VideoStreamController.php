<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use Request;
use Response;
use Cookie;
use File;
use App\Lib\FilmCookies\CookieVideoStream;
use App\Lib\GetLinkVideo\GetLinkVideo;
use App\Lib\CheckLinks\HttpResponseCode;
use App\Lib\ProxyStreamingVideos\ProxyStreamingVideo;
use App\FilmEpisode;
use App\FilmTrailer;

class VideoStreamController extends Controller {

	//
	public function getVideoStream($filename){

		//ok good
			
		$contentType = "video/mp4";
	    $path = 'resources/phim/movies/'.$filename;
	    $cookie_video = new CookieVideoStream($filename);
	    //check cookie
	 //    if(!$cookie_video->checkCookie()){
		// 	return response('Unauthorized action.', 403);
		// 	exit;
		// }
	    //
	    // $path = $filename;
	    //http://stackoverflow.com/questions/35278486/memory-allocation-problems-while-using-a-stream-through-php
		//
	    if ($i = ob_get_level()) {
	    # Clear buffering:
	    while ($i-- && ob_end_clean());
		    if (!ob_get_level()) header('Content-Encoding: ');
		}

		ob_implicit_flush();
	    $fullsize = filesize($path);
	    $size = $fullsize;
	    $stream = fopen($path, "r");
	    $response_code = 200;
	    $headers = array("Content-type" => $contentType);
	    
	    // Check for request for part of the stream
	    //
	    $range = Request::header('Range');
	    if($range != null) {
	        $eqPos = strpos($range, "=");
	        $toPos = strpos($range, "-");
	        $unit = substr($range, 0, $eqPos);
	        $start = intval(substr($range, $eqPos+1, $toPos));
	        $success = fseek($stream, $start);
	        if($success == 0) {
	            $size = $fullsize - $start;
	            $response_code = 206;
	            $headers["Accept-Ranges"] = $unit;
	            $headers["Content-Range"] = $unit . " " . $start . "-" . ($fullsize-1) . "/" . $fullsize;
	        }
	    }
	    
	    $headers["Content-Length"] = $size;
	    
	    return Response::stream(function () use ($stream) {
	        fpassthru($stream);
	    }, $response_code, $headers);
	    
	}
	public function getPlayer($filename){
		$cookie_video = new CookieVideoStream($filename);
		$cookie_video->createCookie();
	    return view('phimhay.video-stream.player')->with(compact('filename'));
	}
	public function getProxy($id, $quality){
		//check
		$film_episode = null;
		if(Request::get('trailer') == 'yes'){
			$film_episode = FilmTrailer::find($id);
		}else{
			$film_episode = FilmEpisode::find($id);
		}
		if(count($film_episode) != 1){
			return response('404');
			exit;
		}
		$q = 'film_src_'.$quality;
		$arr_check = ['360p' => '', '480p' => '', '720p' => '', '1080p' => '', '2160p' => ''];
		//check quality
		if(!isset($arr_check[$quality])){
			return response('404');
			exit;
		}
		if(empty($film_episode->{$q})){
			return response('404');
			exit;
		}
		//
		$c = json_decode($film_episode->drive_cookie);
		$link_check = $film_episode->{$q};
		$http = new HttpResponseCode();
		//set url with cookie drive
		$http->setUrlWithCookieDrive($link_check, $c);
		// var_dump($http->getStatusCode());
		// exit;
		if(!$http->checkHttpResponseCode200()){
			//error
			$get_link_video = new GetLinkVideo();
			$get_link_video->getLinkDriveUseProxy($film_episode->film_src_full);
			$film_episode->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_episode->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_episode->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_episode->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_episode->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
			//add cookie
			$cookie = $get_link_video->getCookie();
			if(!empty($cookie['data'])){
				$film_episode->drive_cookie = json_encode($cookie);
			}
			//update cookie
			$c = json_decode($film_episode->drive_cookie);
			$film_episode->save();

		}
		// var_dump($c);
		$proxy = new ProxyStreamingVideo();
		$proxy->getStreamDrive($film_episode->{$q}, $c);
	}
}
