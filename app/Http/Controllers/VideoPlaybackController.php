<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\VideoPlayback;
use App\FilmSource;

class VideoPlaybackController extends Controller {

	public function getRedirect($id, $resolution)
	{
		//
		$quality = (int)$resolution;
		$videoplayback = VideoPlayback::find($id);
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
		$film_source = FilmSource::findOrFail($videoplayback->film_source_id);
		if($film_source->film_src_name == 'local'){
			return redirect()->route('videoStream.getVideoStream', [$videoplayback->{$arr[$quality]}]);
		}elseif($film_source->film_src_name == 'google drive'){
			$config = json_decode($videoplayback->config, true);
			//using proxy
			if(isset($config['proxy']) && $config['proxy']){
				return redirect()->route('videoStream.getProxy', [$videoplayback->id, $quality]);
			}
			//get not using proxy
		}
		//remote
		// return redirect($videoplayback->{$arr[$quality]});
	}

}
