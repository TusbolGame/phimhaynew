<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\VideoPlayback;

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
		$arr = ['src_360p', 'src_720p', 'src_1080p', 'src_2160p'];
		if(!isset($arr[$quality])){
			return response(404);
		}
		if(empty($videoplayback->{$arr[$quality]})){
			return response(404);
		}
		return redirect($videoplayback->{$arr[$quality]});
	}

}
