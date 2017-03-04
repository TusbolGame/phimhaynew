<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use Request;
use Response;
use File;
class VideoStreamController extends Controller {

	//
	public function getVideoStream($filename){
		// Pasta dos videos.
		/* stream load all
	    $videosDir = base_path('resources/phim/movies');
	    if (file_exists($filePath = $videosDir."/".$filename)) {
	        $stream = new \App\Lib\VideoStreams\VideoStream($filePath);
	        return response()->stream(function() use ($stream) {
	            $stream->start();
	        });
	    }
	    return response("File doesn't exists", 404);
	    */
	    /*
	    	     //500 error
	    Response::macro('streamed', function($type, $size, $name, $callback) {
		    $start = 0;
		    $length = $size;
		    $status = 200;
		    $headers = [
		        'Content-Type' => $type,
		        'Content-Length' => $size,
		        'Accept-Ranges' => 'bytes'
		    ];
		    if (false !== $range = Request::server('HTTP_RANGE', false)) {
		        list($param, $range) = explode('=', $range);
		        if (strtolower(trim($param)) !== 'bytes') {
		            header('HTTP/1.1 400 Invalid Request');
		            exit;
		        }
		        list($from, $to) = explode('-', $range);
		        if ($from === '') {
		            $end = $size - 1;
		            $start = $end - intval($from);
		        } elseif ($to === '') {
		            $start = intval($from);
		            $end = $size - 1;
		        } else {
		            $start = intval($from);
		            $end = intval($to);
		        }
		        if ($end >= $length) {
		            $end = $length - 1;
		        }
		        $length = $end - $start + 1;
		        $status = 206;
		        $headers['Content-Range'] = sprintf('bytes %d-%d/%d', $start, $end, $size);
		        $headers['Content-Length'] = $length;
		    }
		    return Response::stream(function() use ($start, $length, $callback) {
		        call_user_func($callback, $start, $length);
		    }, $status, $headers);
		});
		// Usage
		// $path = storage_path('secured_video.mp4');

		$path = base_path('resources/phim/movies'."/".$filename);
		$name = basename($path);
		if(!File::exists($path)){
			return response('Not found');exit;
		}
		$size = File::size($path);

		$type = 'video/mp4';
		// die();
		return Response::streamed($type, $size, $name, function($offset, $length) use ($path) {
			//code 500 error

		    $stream = GuzzleHttp\Stream\Stream::factory(fopen($path, 'r'));
		    $stream->seek($offset);
		    while (!$stream->eof()) {
		        echo $stream->read($length);
		    }
		    $stream->close();
		});
		*/



		//ok good
		
	$contentType = "video/mp4";
    $path = base_path('resources/phim/movies')."/".$filename;
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
	public function getPlayer(){
		// var_dump(base_path('secured_video.mp4'));die();
		// $video = "test-video.mp4";
		$video = "anacondas2.mp4";
	    $mime = "video/mp4";
	    $title = "Os Simpsons";
	    return view('phimhay.video-stream.player')->with(compact('video', 'mime', 'title'));
	}
}
