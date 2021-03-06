<?php namespace App\Lib;

use App\VideoPlayback;
use App\FilmSource;
use Crypt;
// use \NptNguyen\Libs\GetLinkVideos\GetLinkVideo;
/**
* 
*/
class ProcessVideoLink
{
	protected $data;
	protected $drive_proxy = false;
	protected $drive_embed = true;
	
	function __construct()
	{
	}
	function getVideoPlayback($film_id, $film_source){
		//uu tien get link
		$get_link_video = new \NptNguyen\Libs\GetLinkVideos\GetLinkVideo();
		$time = time();
		$cache_link = $time + 3*60*60; //3h
		//local
		//youtube
		//get error?
		//proxy
		//embed
		$this->data['film_src_name'] = $film_source->film_src_name;
		//
		$videoplayback = new VideoPlayback();
		// $videoplayback->id = hash('crc32', $time);
		$videoplayback->film_id = $film_id;
		$videoplayback->film_source_id = $film_source->id;
		$videoplayback->time = $cache_link;
		$videoplayback->save();
		//
		$id_crypt = Crypt::encrypt($videoplayback->id);
		//
		if($film_source->film_src_name == 'youtube'){
			//insert videoplayback	
			$videoplayback->src_360p = $film_source->film_src_full;
			//youtube error redirect
			// $this->data['film_src_full'] = route('videoPlayback', $videoplayback->id);
			$this->data['film_src_full'] = $film_source->film_src_full;
		}else{
			//get link
			//
			// if(true){
			if((int)$film_source->time == 0 || (int)$film_source->time < $time){
				if($film_source->film_src_name == 'zing tv'){
					$get_link_video->getLinkZingTv($film_source->film_src_full);
				}elseif($film_source->film_src_name == 'google photos'){
					$get_link_video->getLinkVideoGooglePhotos($film_source->film_src_full);
				}
				elseif($film_source->film_src_name == 'google drive'){
					// $get_link_video->getLinkVideoIo($film_source->film_src_full);
					//using proxy drive
					$get_link_video->getLinkDriveUseProxy($film_source->film_src_full);
					$cookie = $get_link_video->getCookie();
					$config = ['proxy' => true, 'drive_cookie' => ['DRIVE_STREAM' => $cookie['data']['DRIVE_STREAM']]];
					$videoplayback->config = json_encode($config);
					$film_source->config = json_encode($config);

				}
				if(!empty($get_link_video->getSrcVideoJson())){
					//get ok
					//update source
					$film_source->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
					$film_source->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
					$film_source->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
					$film_source->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
					$film_source->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
					$film_source->time = $cache_link;
					$film_source->save();
				}
			}
			//is cache
			//update data_source
			//update if drive using proxy
			$videoplayback->config = $film_source->config;
			//
			if(!empty($film_source->film_src_360p)){
				$videoplayback->src_360p = $film_source->film_src_360p;
				$this->data['film_src_360p'] = route('videoPlayback', [$id_crypt, 0]);

			}
			if(!empty($film_source->film_src_480p)){
				$videoplayback->src_480p = $film_source->film_src_480p;
				$this->data['film_src_480p'] = route('videoPlayback', [$id_crypt, 1]);
			}
			if(!empty($film_source->film_src_720p)){
				$videoplayback->src_720p = $film_source->film_src_720p;
				$this->data['film_src_720p'] = route('videoPlayback', [$id_crypt, 2]);
			}
			if(!empty($film_source->film_src_1080p)){
				$videoplayback->src_1080p = $film_source->film_src_1080p;
				$this->data['film_src_1080p'] = route('videoPlayback', [$id_crypt, 3]);
			}
			if(!empty($film_source->film_src_2160p)){
				$videoplayback->src_2160p = $film_source->film_src_2160p;
				$this->data['film_src_2160p'] = route('videoPlayback', [$id_crypt, 4]);
			}
			
		} // end else
		//save videoplayback
		$videoplayback->save();
	}
	function getData(){
		return $this->data;
	}
	protected function randomString($len = 8){
		//echo hash('crc32', '0000000001'); // gives 6c13f76e
		# get random character length between minimum and maximum length
     	// $length = rand($min, $max);
     	$length = $len;
     	$string = '';
     	# character index [0-9a-zA-Z] etc
     	$index = '0123456789bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ';
     
     	for ($i=0; $i < $length; $i++) {
	        # get random character index
	        $index = str_shuffle($index);
	        $string .= $index[mt_rand(0, strlen($index) -1)];
     	}
 		return $string;
	}
	// public function postAdd($film_id, Request $request){
	// 	//check domain, status http
	// 	if($request->film_src_name != 'local'){
	// 		//check
	// 		$path_url_info = new ParseUrlInfo($request->film_src_full);
	// 		if($request->film_src_name == 'google drive'){
	// 			if($path_url_info->getHost() != 'drive.google.com'){
	// 				return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Drive'])->withInput();
	// 			}
	// 		}elseif($request->film_src_name == 'google photos'){
	// 			if($path_url_info->getHost() != 'photos.google.com'){
	// 				return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Photos'])->withInput();
	// 			}
	// 		}elseif($request->film_src_name == 'youtube'){
	// 			if($path_url_info->getHost() != 'www.youtube.com'){
	// 				return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Youtube'])->withInput();
	// 			}
	// 		}
	// 		//check http status code film_src_full
	// 		$http_response_code = new HttpResponseCode();
	// 		$http_response_code->setUrl($request->film_src_full);
	// 		if(!$http_response_code->checkHttpResponseCode200()){
	// 			//error
	// 			return redirect()->back()->with(['flash_message_error' => 'Source Episode Status '.$http_response_code->getStatusCode().'! '.$http_response_code->getStatusCodeName()])->withInput();
	// 		}
	// 	}

	// 	//check track
	// 	if($request->film_track_type != ''){
	// 		$track_src = $request->file('film_track_src');
	// 		if(!empty($track_src)){
	// 			//get extension
	// 			$track_extension = $track_src->getClientOriginalExtension();
	// 			if($request->film_track_type == 'vtt'){
	// 				if($track_extension != 'vtt'){
	// 					return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .vtt !!'])->withInput();
	// 				}
	// 			}
	// 			else if($request->film_track_type == 'ass'){
	// 				if($track_extension != 'ass'){
	// 					return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .ass !!'])->withInput();
	// 				}
	// 			}else{
	// 				return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track, File Track phải là .vtt or .ass  !!'])->withInput();
	// 			}
	// 		}
	// 	}
	// 	//
	// 	//chua xet film_episode
	// 	$film_source = new FilmSource();
	// 	//chua fix
	// 	$film_source->film_episode_id = $request->film_episode_id;
	// 	$film_source->film_src_name = $request->film_src_name;
	// 	$film_source->film_src_full = $request->film_src_full;
	// 	$film_source->film_episode_language = $request->film_episode_language;
	// 	$film_source->film_episode_quality = $request->film_episode_quality;
	// 	//
	// 	//getlink, youtube ko can getlink
	// 	$get_link_video = new \NptNguyen\Libs\GetLinkVideos\GetLinkVideo();
	// 	if($request->film_src_name != 'youtube'){
	// 		//reset src -> edit
	// 		// $film_source->film_src_360p = null;
	// 		// $film_source->film_src_480p = null;
	// 		// $film_source->film_src_720p = null;
	// 		// $film_source->film_src_1080p = null;
	// 		// $film_source->film_src_2160p = null;
	// 		switch ($request->film_src_name) {
	// 			case 'google photos':
	// 				# code...
	// 				break;
				
	// 			default:
	// 				# code...
	// 				break;
	// 		}
	// 		if($request->film_src_name == 'google photos'){
				
	// 			//gg drive
	// 			//
	// 			if((int)env('GET_LINK_LOCAL') == 1){
	// 				//use local
	// 				$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
	// 			}else{
	// 				//remote video.io
	// 				$get_link_video->getLinkVideoIo($request->film_src_full);
	// 			}
	// 			$film_source->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
	// 			$film_source->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
	// 			$film_source->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
	// 			$film_source->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
	// 			$film_source->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
	// 		}elseif($request->film_src_name == 'google drive'){
	// 			//reset src
	// 			if(env('DRIVE_USE') == 'embeb'){
	// 				// $film_source->film_src_360p = $get_link_video->getLinkDriveEmbedYoutube($request->film_src_full);
	// 			}elseif(env('DRIVE_USE') == 'proxy'){
	// 				//
	// 				$get_link_video->getLinkDriveUseProxy($request->film_src_full);
	// 				//add cookie
	// 				$cookie = $get_link_video->getCookie();
	// 				if(!empty($cookie['data'])){
	// 					$film_source->drive_cookie = json_encode($cookie);
	// 				}
	// 			}

	// 		}elseif ($request->film_src_name == 'zing tv') {
	// 			$get_link_video->getLinkZingTv($request->film_src_full);
	// 		}
	// 		//

	// 		$film_source->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
	// 		$film_source->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
	// 		$film_source->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
	// 		$film_source->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
	// 		$film_source->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
	// 	}
	// 	else if($request->film_src_name == 'local'){
	// 		$film_source->film_src_360p = $request->film_src_360p;
	// 		$film_source->film_src_480p = $request->film_src_480p;
	// 		$film_source->film_src_720p = $request->film_src_720p;
	// 		$film_source->film_src_1080p = $request->film_src_1080p;
	// 		$film_source->film_src_2160p = $request->film_src_2160p;
	// 	}
	// 	//xet 


	// 	// exit;
	// 	//
	// 	$film_source->save();
	// 	//track
	// 	//check
	// 	if($request->film_track_type != ''){
	// 		$track_src = $request->file('film_track_src');
	// 		if(!empty($track_src)){
	// 			//is file
	// 			$file_name  = $track_src->getClientOriginalName();
	//             $track_src->move('resources/phim/tracks/', $file_name);
	//             $film_track = new FilmEpisodeTrack();
	// 			$film_track->film_episode_id = $film_episode->id;
	// 			$film_track->film_track_type = $request->film_track_type;
	// 			$film_track->film_track_src = $file_name;
	// 			$film_track->save();
	// 		}
	// 	}
		
	// 	//change -- status
	// 	$film_process = new FilmProcess();
	// 	$film_list = FilmList::find($film_id);
	// 	$film_list->film_quality = $film_process->xulyAddFilmQuality($film_list->film_quality, $request->film_episode_quality);
	// 	//
	// 	if($film_list->film_category == 'le'){
	// 		//le -> xu ly quality
	// 		//change status
	// 		$film_list->film_status = $film_process->xulyGetFilmQuality($film_list->film_quality);
	// 	}else{
	// 		if((int)$request->film_link_number == 1){
	// 			//bo
	// 			$film_list->film_status = 'Tập '.$film_episode->film_episode.'/'.$film_list->film_time.' '.$film_process->xulyGetFilmQuality($film_list->film_quality);
	// 		}
	// 	}
	// 	//set language
	// 	$film_list->film_language = $film_process->xulyAddFilmLanguage($film_list->film_language, $request->film_episode_language);
	// 	$film_list->save();
	// 	return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Thêm Episode ở Film ID: '.$film_id]);
	// }
	// public function postEdit($film_id, $id, Request $request){
	// 	//check domain, status http
	// 	if($request->film_src_name != 'local'){
	// 		//check
	// 		$path_url_info = new ParseUrlInfo($request->film_src_full);
	// 		if($request->film_src_name == 'google drive'){
	// 			if($path_url_info->getHost() != 'drive.google.com'){
	// 				return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Drive'])->withInput();
	// 			}
	// 		}elseif($request->film_src_name == 'google photos'){
	// 			if($path_url_info->getHost() != 'photos.google.com'){
	// 				return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Photos'])->withInput();
	// 			}
	// 		}elseif($request->film_src_name == 'youtube'){
	// 			if($path_url_info->getHost() != 'www.youtube.com'){
	// 				return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Youtube'])->withInput();
	// 			}
	// 		}
	// 		//check http status code film_src_full
	// 		//youtube check ko dc
	// 		$http_response_code = new HttpResponseCode();
	// 		$http_response_code->setUrl($request->film_src_full);
	// 		if(!$http_response_code->checkHttpResponseCode200()){
	// 			//error
	// 			return redirect()->back()->with(['flash_message_error' => 'Source Episode Status'.$http_response_code->getStatusCode().'!'.$http_response_code->getStatusCodeName()])->withInput();
	// 		}
	// 	}
	// 	//
	// 	$film_track = FilmEpisodeTrack::where('film_episode_id', $id)->first();
	// 	//track
	// 	if(count($film_track) == 1){
	// 		if($request->film_track_delete != ''){
	// 			//is delete
	// 			//path
	// 			$path = 'resources/phim/tracks'.'/'.$film_track->film_track_src;
	// 			if(File::exists($path)){
	// 				File::delete($path);
	// 			}
	// 			//delete track
	// 			$film_track ->delete();
	// 		}else if($request->film_track_edit != ''){
	// 			//is edit
	// 			//check change
	// 			//check is file
	// 			if($request->hasFile('film_track_src')){
	// 				$track_src = $request->file('film_track_src');
	// 				//check file exists
	// 				$path = 'resources/phim/tracks'.'/'.$track_src->getClientOriginalName();
	// 				if(File::exists($path)){
	// 					return redirect()->back()->with(['flash_message_error' => 'Lỗi! File track chọn đã tồn tại: '.$track_src->getClientOriginalName()])->withInput();
	// 				}
	// 				//
	// 				$file_name  = $track_src->getClientOriginalName();
	// 	            $track_src->move('resources/phim/tracks/', $file_name);
	// 				$film_track->film_track_type = $request->film_track_type;
	// 				$film_track->film_track_src = $file_name;
	// 				$film_track->save();
	// 			}
	// 		}
	// 	}else{
	// 		//no track
	// 		if($request->film_track_type != ''){
	// 			$track_src = $request->file('film_track_src');
	// 			if(!empty($track_src)){
	// 				//get extension
	// 				$track_extension = $track_src->getClientOriginalExtension();
	// 				if($request->film_track_type == 'vtt'){
	// 					if($track_extension != 'vtt'){
	// 						return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .vtt !!'])->withInput();
	// 					}
	// 				}
	// 				else if($request->film_track_type == 'ass'){
	// 					if($track_extension != 'ass'){
	// 						return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .ass !!'])->withInput();
	// 					}
	// 				}else{
	// 					return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track, File Track phải là .vtt or .ass  !!'])->withInput();
	// 				}
	// 				//
	// 				$path = 'resources/phim/tracks/'.$track_src->getClientOriginalName();
	// 				if(File::exists($path)){
	// 					return redirect()->back()->with(['flash_message_error' => 'Lỗi! File track chọn đã tồn tại: '.$track_src->getClientOriginalName()])->withInput();
	// 				}
	// 				//add new track
	// 				$file_name  = $track_src->getClientOriginalName();
	// 	            $track_src->move('resources/phim/tracks/', $file_name);
	// 	            $film_track = new FilmEpisodeTrack();
	// 				$film_track->film_episode_id = $id;
	// 				$film_track->film_track_type = $request->film_track_type;
	// 				$film_track->film_track_src = $file_name;
	// 				$film_track->save();
	// 			}
	// 		}
	// 	}
	// 	//end track
	// 	$film_episode = FilmEpisode::find($id);
	// 	$film_episode->film_src_name = $request->film_src_name;
	// 	$film_episode->film_src_full = $request->film_src_full;
	// 	$film_episode->film_link_number = $request->film_link_number;
	// 	$film_episode->film_episode = $request->film_episode;
	// 	$film_episode->film_episode_language = $request->film_episode_language;
	// 	$film_episode->film_episode_quality = $request->film_episode_quality;
	// 	//
	// 	//getlink, youtube ko can getlink
	// 	$get_link_video = new GetLinkVideo();
	// 	if($request->film_src_name == 'google photos'){
	// 		//reset src
	// 		$film_episode->film_src_360p = null;
	// 		$film_episode->film_src_480p = null;
	// 		$film_episode->film_src_720p = null;
	// 		$film_episode->film_src_1080p = null;
	// 		$film_episode->film_src_2160p = null;
	// 		//gg drive
	// 		if((int)env('GET_LINK_LOCAL') == 1){
	// 			//local
	// 			$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);			
	// 		}else{
	// 			//remote video.io
	// 			$get_link_video->getLinkVideoIo($request->film_src_full);
	// 		}
	// 		$film_episode->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
	// 		$film_episode->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
	// 		$film_episode->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
	// 		$film_episode->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
	// 		$film_episode->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
	// 	}
	// 	else if($request->film_src_name == 'google drive'){
	// 		//
	// 		if(env('DRIVE_USE') == 'embeb'){
	// 			// $film_episode->film_src_360p = $get_link_video->getLinkDriveEmbedYoutube($request->film_src_full);
	// 		}elseif(env('DRIVE_USE') == 'proxy'){

	// 			$get_link_video->getLinkDriveUseProxy($request->film_src_full);
	// 			$film_episode->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
	// 			$film_episode->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
	// 			$film_episode->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
	// 			$film_episode->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
	// 			$film_episode->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
	// 			//add cookie
	// 			$cookie = $get_link_video->getCookie();
	// 			if(!empty($cookie['data'])){
	// 				$film_episode->drive_cookie = json_encode($cookie);
	// 			}
				
	// 		}
	// 	}
	// 	else if($request->film_src_name == 'local'){
	// 		$film_episode->film_src_360p = $request->film_src_360p;
	// 		$film_episode->film_src_480p = $request->film_src_480p;
	// 		$film_episode->film_src_720p = $request->film_src_720p;
	// 		$film_episode->film_src_1080p = $request->film_src_1080p;
	// 		$film_episode->film_src_2160p = $request->film_src_2160p;
	// 	}
	// 	$film_episode->save();
	// 	//change -- status
	// 	$film_process = new FilmProcess();
	// 	$film_list = FilmList::find($film_id);
	// 	$film_list->film_quality = $film_process->xulyAddFilmQuality($film_list->film_quality, $request->film_episode_quality);
	// 	//
	// 	if($film_list->film_category == 'le'){
	// 		//le -> xu ly quality
	// 		//change status
	// 		$film_list->film_status = $film_process->xulyGetFilmQuality($film_list->film_quality);
	// 	}else{
	// 		//bo
	// 		if((int)$request->film_link_number == 1){
	// 			$film_list->film_status = 'Tập '.$film_episode->film_episode.'/'.$film_list->film_time.' '.$film_process->xulyGetFilmQuality($film_list->film_quality);
	// 		}
	// 	}
	// 	//set language
	// 	$film_list->film_language = $film_process->xulyAddFilmLanguage($film_list->film_language, $request->film_episode_language);
	// 	$film_list->save();
	// 	return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Edit Episode id: '.$id]);
	// }
	// public function getDelete($film_id, $id){
	// 	$film_episode = FilmEpisode::find($id);
	// 	$film_list = FilmList::find($film_id);
	// 	if(count($film_episode) == 0 && count($film_list) == 0){
	// 		return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message_errors' => 'Lỗi! Xóa Episode không thành công, không có episode_id '.$id.' ở film_id '.$film_id.' để xóa']);
	// 	}
	// 	$film_track = FilmEpisodeTrack::where('film_episode_id', $id)->first();
	// 	//delete track
	// 	if(count($film_track) == 1){
	// 		//xoa file track
	// 		if($film_track->film_track_src != ''){
	// 			$src_track = 'resources/phim/tracks/'.$film_track->film_track_src;
	// 			if(File::exists($src_track)){
	// 				File::delete($src_track);
	// 			}
	// 		}
	// 		$film_track->delete();
	// 	}
	// 	if($film_episode->film_src_name == 'local'){
	// 		//delete file local
	// 		$src_path =  'resources/phim/movies/';
	// 		if(!empty($film_episode->film_src_360p)){
	// 			if(File::exists($src_path.$film_episode->film_src_360p)){
	// 				File::delete($src_path.$film_episode->film_src_360p);
	// 			}
	// 		}
	// 		if(!empty($film_episode->film_src_480p)){
	// 			if(File::exists($src_path.$film_episode->film_src_480p)){
	// 				File::delete($src_path.$film_episode->film_src_480p);
	// 			}
	// 		}
	// 		if(!empty($film_episode->film_src_720p)){
	// 			if(File::exists($src_path.$film_episode->film_src_720p)){
	// 				File::delete($src_path.$film_episode->film_src_720p);
	// 			}
	// 		}
	// 		if(!empty($film_episode->film_src_1080p)){
	// 			if(File::exists($src_path.$film_episode->film_src_1080p)){
	// 				File::delete($src_path.$film_episode->film_src_1080p);
	// 			}
	// 		}
	// 		if(!empty($film_episode->film_src_2160p)){
	// 			if(File::exists($src_path.$film_episode->film_src_2160p)){
	// 				File::delete($src_path.$film_episode->film_src_2160p);
	// 			}
	// 		}
	// 	}
	// 	$film_episode->delete();
	// 	return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Đã xóa episode_id '.$id.' ở Film_id '.$film_id]);
	// }
}


?>