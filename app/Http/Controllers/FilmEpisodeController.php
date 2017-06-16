<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FilmList;
use App\FilmDetail;
use App\FilmEpisode;
use App\FilmSource;
use App\Lib\FilmProcess\FilmProcess;
use Illuminate\Http\Request;
use Cache;

class FilmEpisodeController extends Controller {

	public function getAdd($film_id){
		$film_list = FilmList::find($film_id);
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Không có Film Id: '.$film_id]);
		}
		return view('admin.film.episode.add', compact('film_list', 'film_id'));
	}
	public function postAdd($film_id, Request $request){
		//
		$film_list = FilmList::find($film_id);
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Không có Film Id: '.$film_id]);
		}
		$film_episode =  new FilmEpisode();
		$film_episode->film_id = $film_id;
		$film_episode->film_episode = $request->film_episode;
		$film_episode->film_episode_name = $request->film_episode_name;
		$film_episode->save();
		//cache film new
		if($film_list->film_kind == 'hoat-hinh'){
			//update cache film hh new
			if(Cache::has('film_hh_new')){
				Cache::forget('film_hh_new');
			}
		}else{
			//kind is truyen
			if($film_list->film_category == 'le'){
				//cache film le new
				if(Cache::has('film_le_new')){
					Cache::forget('film_le_new');
				}
			}
			elseif($film_list->film_category == 'bo'){
				//cache film bo new
				if(Cache::has('film_bo_new')){
					Cache::forget('film_bo_new');
				}
			}
		}
		//end cache
		return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Thêm Episode '.$request->film_episode.' ở Film ID: '.$film_id]);
	}
	
	public function getList($film_id){
		$film_list = FilmList::find($film_id);
		$film_episodes = FilmEpisode::where('film_id', $film_id)->paginate(10);
		$film_episodes->setPath(route('admin.film.episode.getList', $film_id));
		return view('admin.film.episode.list', compact('film_episodes', 'film_id', 'film_list'));
	}
	public function getEdit($film_id, $episode_id, Request $request){
		$film_episode = FilmEpisode::find($episode_id);
		$film_list = FilmList::find($film_id);
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_errors' => 'Chỉnh sửa Episode không thành công! Không tồn tại Film ID: '.$film_id]);
		}
		if(count($film_episode) == 0){
			return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message_errors' => 'Chỉnh sửa Episode không thành công, không có episode_id '.$episode_id]);
		}

		return view('admin.film.episode.edit', compact('film_episode', 'film_list', 'film_id'));
	}
	//
	public function postEdit($film_id, $episode_id, Request $request){
		//
		$film_episode =  FilmEpisode::find($episode_id);
		if(count($film_episode) == 0){
			return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message_errors' => 'Lỗi Edit Episode, Không tồn tại episode_id '.$episode_id]);
		}
		$film_episode->film_episode = $request->film_episode;
		$film_episode->film_episode_name = $request->film_episode_name;
		$film_episode->save();
		return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Cập nhật Episode '.$request->film_episode.' ở Film ID: '.$film_id]);
	}
	public function getDelete($film_id, $episode_id){
		$film_episode = FilmEpisode::find($episode_id);
		$film_list = FilmList::find($film_id);
		if(count($film_episode) == 0 && count($film_list) == 0){
			return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message_errors' => 'Lỗi! Xóa Episode không thành công, không có episode_id '.$episode_id.' ở film_id '.$film_id.' để xóa']);
		}
		$film_episode->delete();
		//cache film new
		if($film_list->film_kind == 'hoat-hinh'){
			//update cache film hh new
			if(Cache::has('film_hh_new')){
				Cache::forget('film_hh_new');
			}
		}else{
			//kind is truyen
			if($film_list->film_category == 'le'){
				//cache film le new
				if(Cache::has('film_le_new')){
					Cache::forget('film_le_new');
				}
			}
			elseif($film_list->film_category == 'bo'){
				//cache film bo new
				if(Cache::has('film_bo_new')){
					Cache::forget('film_bo_new');
				}
			}
		}
		//end cache
		return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Đã xóa Episode ID '.$episode_id.' ở Film_id '.$film_id]);
	}
	public function getAddWithSource($film_id){
		$film_list = FilmList::find($film_id);
		$film_episodes = FilmEpisode::orderBy('film_episode', 'DESC')->take(50)->get();
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Không có Film Id: '.$film_id]);
		}
		return view('admin.film.episode.add-with-source', compact('film_list', 'film_id', 'film_episodes'));
	}
	public function postAddWithSource($film_id, Request $request){
		$dk = count($request->film_episode);
		// var_dump($request->film_episode);
		if($dk == 0){
			return redirect()->back()->with(['flash_message_error' =>'Error! Không có Episode để thêm'])->withInput();
		}
		$film_process = new FilmProcess();	
		$film_list = FilmList::find($film_id);
		$film_list->film_quality = $film_process->xulyAddFilmQuality($film_list->film_quality, $request->film_episode_quality);
		//set language
		$film_list->film_language = $film_process->xulyAddFilmLanguage($film_list->film_language, $request->film_episode_language);
		$i = 0;
		while($i < $dk){
			$film_episode = FilmEpisode::where('film_id', $film_id)->where('film_episode', $request->film_episode[$i])->first();
			if(count($film_episode) ==0){
				$film_episode = new FilmEpisode();
				$film_episode->film_id = $film_id;
				$film_episode->film_episode = $request->film_episode[$i];
				$film_episode->film_episode_name = $request->film_episode_name[$i];
				$film_episode->save();
			}
			//source
			$film_source = new FilmSource();
			$film_source->film_episode_id = $film_episode->id;
			$film_source->film_src_name = $request->film_src_name;
			$film_source->film_src_full = $request->film_src_full[$i];
			$film_source->film_episode_language = $request->film_episode_language;
			$film_source->film_episode_quality = $request->film_episode_quality;
			$film_source->save();
			$i++;
			//change -- status
						
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
			
		}
		$film_list->save();
		//cache film new
		if($film_list->film_kind == 'hoat-hinh'){
			//update cache film hh new
			if(Cache::has('film_hh_new')){
				Cache::forget('film_hh_new');
			}
		}else{
			//kind is truyen
			if($film_list->film_category == 'le'){
				//cache film le new
				if(Cache::has('film_le_new')){
					Cache::forget('film_le_new');
				}
			}
			elseif($film_list->film_category == 'bo'){
				//cache film bo new
				if(Cache::has('film_bo_new')){
					Cache::forget('film_bo_new');
				}
			}
		}
		//end cache
		//
		return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Thêm Episode Source ']);
	}

	public function getGrabLink($film_id){
		$film_list = FilmList::find($film_id);
		// $film_episodes = FilmEpisode::orderBy('film_episode', 'DESC')->take(50)->get();
		if(count($film_list) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' => 'Lỗi! Không có Film Id: '.$film_id]);
		}
		return view('admin.film.episode.grab-link', compact('film_list', 'film_id'));
	}
	public function postGrabLink($film_id, Request $request){
		if($request->film_src_full == ''){
			return redirect()->back()->with(['flash_message_error' =>'Error! Chưa nhập Source Full'])->withInput();
		}
		//
		$grab = new \NptNguyen\Libs\GetLinkVideos\GrabLinkVideo();
		// exit;
		$data = [];
		if($request->film_src_name == 'zing tv'){
			$data = $grab->grabLinkZingTv($request->film_src_full);
		}elseif($request->film_src_name == 'youtube'){
			$data = $grab->grabLinkYoutube($request->film_src_full);
		}
		if(count($data) != 0){
			$film_process = new FilmProcess();
			$film_list = FilmList::find($film_id);
			$film_list->film_quality = $film_process->xulyAddFilmQuality($film_list->film_quality, $request->film_episode_quality);
			//set language
			$film_list->film_language = $film_process->xulyAddFilmLanguage($film_list->film_language, $request->film_episode_language);
			foreach ($data as $key) {
				// $film_episode = new FilmEpisode();
				// $film_episode->film_id = $film_id;
				// $film_episode->film_episode = $key['episode'];
				// $film_episode->save();
				//
				$film_episode = FilmEpisode::where('film_id', $film_id)->where('film_episode', $key['episode'])->first();
				if(count($film_episode) ==0){
					$film_episode = new FilmEpisode();
					$film_episode->film_id = $film_id;
					$film_episode->film_episode = $key['episode'];
					$film_episode->film_episode_name = '';
					$film_episode->save();
				}
				//source
				$film_source = new FilmSource();
				$film_source->film_episode_id = $film_episode->id;
				$film_source->film_src_name = $request->film_src_name;
				$film_source->film_src_full = $key['link'];
				$film_source->film_episode_language = $request->film_episode_language;
				$film_source->film_episode_quality = $request->film_episode_quality;
				$film_source->save();
				//change -- status
				
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
			}
			$film_list->save();
			//cache film new
			if($film_list->film_kind == 'hoat-hinh'){
				//update cache film hh new
				if(Cache::has('film_hh_new')){
					Cache::forget('film_hh_new');
				}
			}else{
				//kind is truyen
				if($film_list->film_category == 'le'){
					//cache film le new
					if(Cache::has('film_le_new')){
						Cache::forget('film_le_new');
					}
				}
				elseif($film_list->film_category == 'bo'){
					//cache film bo new
					if(Cache::has('film_bo_new')){
						Cache::forget('film_bo_new');
					}
				}
			}
			//end cache
			//
			return redirect()->route('admin.film.episode.getList', $film_id)->with(['flash_message' => 'Thành công! Thêm Episode Source ']);
		}
		return redirect()->back()->with(['flash_message_error' => 'Error! Không thể Grab Link'. $request->film_src_name])->withInput();		
	}

}
