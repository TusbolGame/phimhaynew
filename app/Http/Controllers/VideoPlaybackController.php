<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\VideoPlayback;
use App\FilmSource;
use Crypt;

class VideoPlaybackController extends Controller {

	public function getRedirect($id, $resolution)
	{
		//

		$decrypted = Crypt::decrypt($id);

		// if(!$decrypted){
		// 	return response(404);
		// }
		$quality = (int)$resolution;
		$videoplayback = VideoPlayback::find((int)$decrypted);
		// var_dump($decrypted);
		// exit;
		if(count($videoplayback) == 0){
			return response(404);
		}
		$id_encrypt = Crypt::encrypt($videoplayback->id);
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
				return redirect()->route('videoStream.getProxy', [$id_encrypt, $quality]);
			}
			//get not using proxy
		}
		//remote
		return redirect($videoplayback->{$arr[$quality]});
	}

}
