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
use App\VideoPlayback;

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
		$quality = (int)$quality;
		$id_decrypt = Crypt::decrypt($id);
		$videoplayback = VideoPlayback::find((int)$id_decrypt);
		if(count($videoplayback) == 0){
			return response(404);
		}
		//resolution
		$arr = ['src_360p', 'src_480p', 'src_720p', 'src_1080p', 'src_2160p'];
		if(!isset($arr[$quality])){
			return response(404);
		}
		if(empty($videoplayback->{$arr[$quality]})){
			return response(404);
		}
		$config = json_decode($videoplayback->config, true);
		$cookie = [];
		$cookie['drive_cookie'] = $config['drive_cookie'];
		// echo $videoplayback->{$arr[$quality]};
		// exit;
		$proxy = new ProxyStreamingVideo();
		$proxy->getStreamDrive($videoplayback->{$arr[$quality]}, $cookie);
	}
}
