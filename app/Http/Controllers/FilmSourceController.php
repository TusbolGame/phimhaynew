<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FilmList;
use App\FilmEpisode;
use App\FilmSource;
use App\FilmSourceTrack;
use App\Lib\GetLinkVideo\GetLinkVideo;
use App\Lib\ParseUrlInfo;
use App\Lib\CheckLinks\HttpResponseCode;
use App\Lib\FilmProcess\FilmProcess;
use File;

class FilmSourceController extends Controller {
	
	//
	public function getAdd($film_id){
		$film_list = FilmList::find($film_id);
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Không có Film Id: '.$film_id]);
		}
		$film_episodes = FilmEpisode::where('film_id', $film_id)->orderBy('film_episode', 'DESC')->get();
		if(count($film_episodes) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Chưa thêm Episode ']);
		}
		return view('admin.film.episode.source.add', compact('film_list', 'film_id', 'film_episodes'));
	}
	public function postAdd($film_id, Request $request){
		//check domain, status http
		if($request->film_src_name != 'local'){
			//check
			$path_url_info = new ParseUrlInfo($request->film_src_full);
			if($request->film_src_name == 'google drive'){
				if($path_url_info->getHost() != 'drive.google.com'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Drive'])->withInput();
				}
			}elseif($request->film_src_name == 'google photos'){
				if($path_url_info->getHost() != 'photos.google.com'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Photos'])->withInput();
				}
			}elseif($request->film_src_name == 'youtube'){
				if($path_url_info->getHost() != 'www.youtube.com'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Youtube'])->withInput();
				}
			}
			elseif($request->film_src_name == 'zing tv'){
				if($path_url_info->getHost() != 'tv.zing.vn'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Zing Tv'])->withInput();
				}
			}
			//check http status code film_src_full
			$http_response_code = new HttpResponseCode();
			$http_response_code->setUrl($request->film_src_full);
			if(!$http_response_code->checkHttpResponseCode200()){
				//error
				return redirect()->back()->with(['flash_message_error' => 'Source Episode Status '.$http_response_code->getStatusCode().'! '.$http_response_code->getStatusCodeName()])->withInput();
			}
		}

		//check track
		if($request->film_track_type != ''){
			$track_src = $request->file('film_track_src');
			if(!empty($track_src)){
				//get extension
				$track_extension = $track_src->getClientOriginalExtension();
				if($request->film_track_type == 'vtt'){
					if($track_extension != 'vtt'){
						return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .vtt !!'])->withInput();
					}
				}
				else if($request->film_track_type == 'ass'){
					if($track_extension != 'ass'){
						return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .ass !!'])->withInput();
					}
				}else{
					return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track, File Track phải là .vtt or .ass  !!'])->withInput();
				}
			}
		}
		//
		//
		$film_list = FilmList::findOrFail($film_id);
		$film_episode = FilmEpisode::findOrFail($request->film_episode_id);
		$film_process = new FilmProcess();
		$film_source = new FilmSource();
		//
		$film_source->film_episode_id = $request->film_episode_id;
		$film_source->film_src_name = $request->film_src_name;
		$film_source->film_src_full = $request->film_src_full;
		$film_source->film_episode_language = $request->film_episode_language;
		$film_source->film_episode_quality = $request->film_episode_quality;
		//
		if($request->film_src_name == 'local'){
			//check exists
			if(File::exists('resources/phim/movies/'.$request->film_src_360p)){
				//ex
				//check resolution width and height
				$ffprobe = \FFMpeg\FFProbe::create();
				$dimension = $ffprobe
				    ->streams('resources/phim/movies/'.$request->film_src_360p) // extracts streams informations
				    ->videos() // filters video streams
				    ->first() // returns the first video stream
				    ->getDimensions();// returns a FFMpeg\Coordinate\Dimension object
				//check
				ini_set('max_execution_time', 0); //300 seconds = 5 minutes
				$ffmpeg = \FFMpeg\FFMpeg::create();
				$video = $ffmpeg->open('resources/phim/movies/'.$request->film_src_360p);
				$format = new \FFMpeg\Format\Video\X264();
				$format->setAudioCodec('aac');				
				//720p
				$name_720p = '';
				$name_480p = '';
				$name_360p = '';
				if($dimension->getWidth() >= 1280 || $dimension->getHeight() >= 720){
					//chua check exists name
					//generate 720
					$name_720p = $film_process->getNameVideoSourceLocal($film_list, $film_episode, '720p', $request->film_episode_language);
					if($dimension->getHeight() < 1080){
						$video->filters()
					    ->resize(new \FFMpeg\Coordinate\Dimension(1280, $dimension->getHeight()))
					    ->synchronize();
					}else{
						$video->filters()
					    ->resize(new \FFMpeg\Coordinate\Dimension(1280, 720))
					    ->synchronize();
					}
					
				    $format
				    	->setKiloBitrate(1000)
				    	->setAudioChannels(2)
				    	->setAudioKiloBitrate(192);
				    $video->save($format, 'resources/phim/movies/'.$name_720p);
				    //generate 480
				    $name_480p = $film_process->getNameVideoSourceLocal($film_list, $film_episode, '480p', $request->film_episode_language);
				    $video
					    ->filters()
					    ->resize(new \FFMpeg\Coordinate\Dimension(640, 480))
					    ->synchronize();
			    	$format
				    	->setKiloBitrate(400)
				    	->setAudioChannels(2)
				    	->setAudioKiloBitrate(128);
			    	$video->save($format, 'resources/phim/movies/'.$name_480p);
			    	//generate 360
			    	$name_360p = $film_process->getNameVideoSourceLocal($film_list, $film_episode, '360p', $request->film_episode_language);
			    	$video
						->filters()
						->resize(new \FFMpeg\Coordinate\Dimension(480, 360))
						->synchronize();
					$format
						->setKiloBitrate(250)
						->setAudioChannels(2)
						->setAudioKiloBitrate(96);
					$video->save($format, 'resources/phim/movies/'.$name_360p);
				}elseif($dimension->getWidth() >= 640 && $dimension->getHeight() >= 480){
					//chua check exists name
				    //generate 480
				    $name_480p = $film_process->getNameVideoSourceLocal($film_list, $film_episode, '480p', $request->film_episode_language);
				    $video
					    ->filters()
					    ->resize(new \FFMpeg\Coordinate\Dimension(640, 480))
					    ->synchronize();
			    	$format
				    	->setKiloBitrate(400)
				    	->setAudioChannels(2)
				    	->setAudioKiloBitrate(128);
			    	$video->save($format, 'resources/phim/movies/'.$name_480p);
			    	//generate 360
			    	$name_360p = $film_process->getNameVideoSourceLocal($film_list, $film_episode, '360p', $request->film_episode_language);
			    	$video
						->filters()
						->resize(new \FFMpeg\Coordinate\Dimension(480, 360))
						->synchronize();
					$format
						->setKiloBitrate(250)
						->setAudioChannels(2)
						->setAudioKiloBitrate(96);
					$video->save($format, 'resources/phim/movies/'.$name_360p);
				}
				elseif($dimension->getWidth() >= 480 && $dimension->getHeight() >= 360){
					//chua check exists name
			    	//generate 360
			    	$name_360p = $film_process->getNameVideoSourceLocal($film_list, $film_episode, '360p', $request->film_episode_language);
			    	$video
						->filters()
						->resize(new \FFMpeg\Coordinate\Dimension(480, 360))
						->synchronize();
					$format
						->setKiloBitrate(250)
						->setAudioChannels(2)
						->setAudioKiloBitrate(96);
					$video->save($format, 'resources/phim/movies/'.$name_360p);
				}
				$film_source->film_src_360p = $name_360p;
				$film_source->film_src_480p = $name_480p;
				$film_source->film_src_720p = $name_720p;
			}
			
		}
		//
		$film_source->save();
		//track
		//check
		if($request->film_track_type != ''){
			$track_src = $request->file('film_track_src');
			if(!empty($track_src)){
				//is file
				$file_name  = $track_src->getClientOriginalName();
	            $track_src->move('resources/phim/tracks/', $file_name);
	            $film_track = new FilmSourceTrack();
				$film_track->film_source_id = $film_source->id;
				$film_track->film_track_type = $request->film_track_type;
				$film_track->film_track_src = $file_name;
				$film_track->save();
			}
		}
		//change -- status
		$film_list->film_quality = $film_process->xulyAddFilmQuality($film_list->film_quality, $request->film_episode_quality);
		//set status
		if($film_list->film_category == 'le'){
			//le -> xu ly quality
			//change status
			$film_list->film_status = $film_process->xulyGetFilmQuality($film_list->film_quality);
		}else{
			
			//bo,
			$temp = explode(' ', $film_list->film_status);
			if(count($temp) == 3){
				$temp_status = $film_list->film_time.'/'.$film_list->film_time;
				//if 22/23 != 23/23 -> update status
				if($temp_status != $temp[1]){
					$film_list->film_status = 'Tập '.$film_episode->film_episode.'/'.$film_list->film_time.' '.$film_process->xulyGetFilmQuality($film_list->film_quality);
				}
				// var_dump($temp_status);
				// var_dump($temp[1]);
			}else{
				//is trailer 
				$film_list->film_status = 'Tập '.$film_episode->film_episode.'/'.$film_list->film_time.' '.$film_process->xulyGetFilmQuality($film_list->film_quality);
			}//end if(count($temp) == 3)
		}//end if($film_list->film_category == 'le')
		//set language
		$film_list->film_language = $film_process->xulyAddFilmLanguage($film_list->film_language, $request->film_episode_language);
		$film_list->save();
		return redirect()->route('admin.film.episode.source.getList', [$film_id, $request->film_episode_id])->with(['flash_message' => 'Thành công! Thêm Source ở Episode ID: '.$request->film_episode_id]);
	}
	public function getEdit($film_id, $episode_id, $source_id, Request $request){
		$film_list = FilmList::find($film_id);
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Không tồn tài Film Id: '.$film_id]);
		}
		$film_episode = FilmEpisode::find($episode_id);
		if(count($film_episode) == 0){
			return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message_error' => 'Lỗi! Không tồn tại Episode Id '.$episode_id]);
		}
		$film_source = FilmSource::find($source_id);
		if(count($film_source) == 0){
			return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message_error' => 'Lỗi! Không tồn tại Source Id là '.$source_id]);
		}
		$film_track = FilmSourceTrack::where('film_source_id', $source_id)->first();
		$film_episodes = FilmEpisode::where('film_id', $film_id)->orderBy('film_episode', 'DESC')->get();
		return view('admin.film.episode.source.edit', compact('film_source', 'film_list', 'film_track', 'film_id', 'film_episodes'));
	}
	//chua
	public function getList($film_id, $episode_id){
		$http_response_code = new HttpResponseCode();
		$film_list = FilmList::find($film_id);
		$film_sources = FilmSource::where('film_episode_id', $episode_id)->paginate(10);
		$film_sources->setPath(route('admin.film.episode.source.getList', [$film_id, $episode_id]));
		return view('admin.film.episode.source.list', compact('film_sources', 'film_id', 'film_list', 'http_response_code'));
	}
	//test lai
	public function postEdit($film_id, $episode_id, $source_id, Request $request){
		//check domain, status http
		if($request->film_src_name != 'local'){
			//check
			$path_url_info = new ParseUrlInfo($request->film_src_full);
			if($request->film_src_name == 'google drive'){
				if($path_url_info->getHost() != 'drive.google.com'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Drive'])->withInput();
				}
			}elseif($request->film_src_name == 'google photos'){
				if($path_url_info->getHost() != 'photos.google.com'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Google Photos'])->withInput();
				}
			}elseif($request->film_src_name == 'youtube'){
				if($path_url_info->getHost() != 'www.youtube.com'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Youtube'])->withInput();
				}
			}
			elseif($request->film_src_name == 'zing tv'){
				if($path_url_info->getHost() != 'tv.zing.vn'){
					return redirect()->back()->with(['flash_message_error' => 'Source Episode Error! Sai Domain Zing Tv'])->withInput();
				}
			}
			//check http status code film_src_full
			$http_response_code = new HttpResponseCode();
			$http_response_code->setUrl($request->film_src_full);
			if(!$http_response_code->checkHttpResponseCode200()){
				//error
				return redirect()->back()->with(['flash_message_error' => 'Source Episode Status '.$http_response_code->getStatusCode().'! '.$http_response_code->getStatusCodeName()])->withInput();
			}
		}
		//
		$film_source = FilmSource::find($source_id);
		if(count($film_source) == 0){
			return redirect()->back()->with(['flash_message_error' => 'Source Id Error! Không tồn tại Source id '.$source_id])->withInput();
		}
		//
		$film_source->film_episode_id = $request->film_episode_id;
		$film_source->film_src_name = $request->film_src_name;
		$film_source->film_src_full = $request->film_src_full;
		$film_source->film_episode_language = $request->film_episode_language;
		$film_source->film_episode_quality = $request->film_episode_quality;
		//reset source
		$film_source->film_src_360p = '';
		$film_source->film_src_480p = '';
		$film_source->film_src_720p = '';
		$film_source->film_src_1080p = '';
		$film_source->film_src_2160p = '';
		//
		if($request->film_src_name == 'local'){
			$film_source->film_src_360p = $request->film_src_360p;
			$film_source->film_src_480p = $request->film_src_480p;
			$film_source->film_src_720p = $request->film_src_720p;
			$film_source->film_src_1080p = $request->film_src_1080p;
			$film_source->film_src_2160p = $request->film_src_2160p;
		}
		//
		$film_source->save();
		//
		$film_track = FilmSourceTrack::where('film_source_id', $source_id)->first();
		//track
		if(count($film_track) == 1){
			if($request->film_track_delete != ''){
				//is delete
				//path
				$path = 'resources/phim/tracks'.'/'.$film_track->film_track_src;
				if(File::exists($path)){
					File::delete($path);
				}
				//delete track
				$film_track ->delete();
			}else if($request->film_track_edit != ''){
				//is edit
				//check change
				//check is file
				if($request->hasFile('film_track_src')){
					$track_src = $request->file('film_track_src');
					//check file exists
					$path = 'resources/phim/tracks'.'/'.$track_src->getClientOriginalName();
					if(File::exists($path)){
						return redirect()->back()->with(['flash_message_error' => 'Lỗi! File track chọn đã tồn tại: '.$track_src->getClientOriginalName()])->withInput();
					}
					//
					$file_name  = $track_src->getClientOriginalName();
		            $track_src->move('resources/phim/tracks/', $file_name);
					$film_track->film_track_type = $request->film_track_type;
					$film_track->film_track_src = $file_name;
					$film_track->save();
				}
			}
		}else{
			//no track
			if($request->film_track_type != ''){
				$track_src = $request->file('film_track_src');
				if(!empty($track_src)){
					//get extension
					$track_extension = $track_src->getClientOriginalExtension();
					if($request->film_track_type == 'vtt'){
						if($track_extension != 'vtt'){
							return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .vtt !!'])->withInput();
						}
					}
					else if($request->film_track_type == 'ass'){
						if($track_extension != 'ass'){
							return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track .ass !!'])->withInput();
						}
					}else{
						return redirect()->back()->with(['flash_message_error' => 'Lỗi chọn sai file Track, File Track phải là .vtt or .ass  !!'])->withInput();
					}
					//
					$path = 'resources/phim/tracks/'.$track_src->getClientOriginalName();
					if(File::exists($path)){
						return redirect()->back()->with(['flash_message_error' => 'Lỗi! File track chọn đã tồn tại: '.$track_src->getClientOriginalName()])->withInput();
					}
					//add new track
					$file_name  = $track_src->getClientOriginalName();
		            $track_src->move('resources/phim/tracks/', $file_name);
		            $film_track = new FilmEpisodeTrack();
					$film_track->film_source_id = $source_id;
					$film_track->film_track_type = $request->film_track_type;
					$film_track->film_track_src = $file_name;
					$film_track->save();
				}
			}
		}
		//end track
		//change -- status
		$film_process = new FilmProcess();
		$film_list = FilmList::find($film_id);
		$film_list->film_quality = $film_process->xulyAddFilmQuality($film_list->film_quality, $request->film_episode_quality);
		//set status
		if($film_list->film_category == 'le'){
			//le -> xu ly quality
			//change status
			$film_list->film_status = $film_process->xulyGetFilmQuality($film_list->film_quality);
		}else{
			$film_episode = FilmEpisode::findOrFail($film_source->film_episode_id);
			//bo,
			$temp = explode(' ', $film_list->film_status);
			if(count($temp) == 3){
				$temp_status = $film_list->film_time.'/'.$film_list->film_time;
				//if 22/23 != 23/23 -> update status
				if($temp_status != $temp[1]){
					$film_list->film_status = 'Tập '.$film_episode->film_episode.'/'.$film_list->film_time.' '.$film_process->xulyGetFilmQuality($film_list->film_quality);
				}
				// var_dump($temp_status);
				// var_dump($temp[1]);
			}else{
				//is trailer 
				$film_list->film_status = 'Tập '.$film_episode->film_episode.'/'.$film_list->film_time.' '.$film_process->xulyGetFilmQuality($film_list->film_quality);
			}//end if(count($temp) == 3)
		}//end if($film_list->film_category == 'le')
		//set language
		$film_list->film_language = $film_process->xulyAddFilmLanguage($film_list->film_language, $request->film_episode_language);
		$film_list->save();
		return redirect()->route('admin.film.episode.source.getList', [$film_id, $episode_id])->with(['flash_message' => 'Thành công! Edit Source id: '.$source_id]);
	}
	//ok
	public function getDelete($film_id, $episode_id, $source_id){
		$film_list = FilmList::find($film_id);
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Không có Film Id: '.$film_id]);
		}
		$film_source = FilmSource::find($source_id);
		if(count($film_source) == 0){
			return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message_error' => 'Lỗi! Không thể xóa Source Id là '.$source_id]);
		}
		$film_track = FilmSourceTrack::where('film_source_id', $source_id)->first();
		//delete track
		if(count($film_track) == 1){
			//xoa file track
			if($film_track->film_track_src != ''){
				$src_track = 'resources/phim/tracks/'.$film_track->film_track_src;
				if(File::exists($src_track)){
					File::delete($src_track);
				}
			}
			$film_track->delete();
		}
		if($film_source->film_src_name == 'local'){
			//delete file local
			$src_path =  'resources/phim/movies/';
			if(!empty($film_source->film_src_360p)){
				if(File::exists($src_path.$film_source->film_src_360p)){
					File::delete($src_path.$film_source->film_src_360p);
				}
			}
			if(!empty($film_source->film_src_480p)){
				if(File::exists($src_path.$film_source->film_src_480p)){
					File::delete($src_path.$film_source->film_src_480p);
				}
			}
			if(!empty($film_source->film_src_720p)){
				if(File::exists($src_path.$film_source->film_src_720p)){
					File::delete($src_path.$film_source->film_src_720p);
				}
			}
			if(!empty($film_source->film_src_1080p)){
				if(File::exists($src_path.$film_source->film_src_1080p)){
					File::delete($src_path.$film_source->film_src_1080p);
				}
			}
			if(!empty($film_source->film_src_2160p)){
				if(File::exists($src_path.$film_source->film_src_2160p)){
					File::delete($src_path.$film_source->film_src_2160p);
				}
			}
		}
		$film_source->delete();
		return redirect()->route('admin.film.episode.source.getList', [$film_id, $episode_id])->with(['flash_message' => 'Thành công! Đã xóa Source id '.$source_id.' ở Episode id '.$episode_id.' của Film_id '.$film_id]);
	}
}
