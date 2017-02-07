<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//
use App\Lib\Videojs\VideojsPlay;
use App\Lib\GetLinkVideo\GetLinkVideo;

use App\FilmRelate;
use App\FilmDetail;
use App\FilmList;
use App\FilmTrailer;
use App\FilmEpisode;
use App\PhimHayConfig;
use App\FilmUserDiff;
use App\FilmCommentLocal;
use App\Lib\FilmProcess\FilmProcess;
use Input;
use Auth;
class FilmController extends Controller {

	public function getFilmInfo($film_dir, $film_id){
		$film_id = (int)$film_id;
		// echo '<br>'.$film_dir;
		// die();
		//find
		$film_list = FilmList::where('id', $film_id)->where('film_dir_name', $film_dir)->first();
		//fb
		if(count($film_list) == 1){
			//get info
			$film_detail = FilmDetail::find($film_id);
			//get trailer
			$film_trailer = FilmTrailer::find($film_id);
			//film episdoe id
			$film_episode = FilmEpisode::where('film_id', $film_id)->select('id')->orderBy('id', 'ASC')->take(1)->get();
			//film relate
			$relate_max = 12;
			$film_relates = null;
			$film_relate_adds = null;
			if($film_detail->film_relate_id == 1){

				//random type
				$data_type = explode(',', $film_detail->film_type);
				//ran
				$type_random = $data_type[random_int(0, count($data_type)-1)];
				//var_dump($type_random);
				$film_relates = FilmDetail::where('film_type', 'LIKE', '%'.$type_random.'%')->where('id', '!=', $film_id)->take($relate_max)->get();
				//dump($film_relates);
				//die();
			}else{
				//maximum 12
				$film_relates = FilmDetail::where('film_relate_id', $film_detail->film_relate_id)->where('id', '!=', $film_id)->take($relate_max)->get();
				if(count($film_relates) < $relate_max){
					//random type
					$data_type = explode(',', $film_detail->film_type);
					//ran
					$type_random = $data_type[random_int(0, count($data_type)-1)];
					$film_relate_adds = FilmDetail::where('film_type', 'LIKE', '%'.$type_random.'%')->where('id', '!=', $film_id)->where('film_relate_id', '!=', $film_detail->film_relate_id)->take($relate_max - count($film_relates))->get();
				}
			}
			// var_dump($film_episode);die();
			$film_episode_id = 0;
			if(count($film_episode) == 1){
				$film_episode_id = $film_episode[0]->id;
			}
			//get ticked
			$ticked = 0;
			if(Auth::check()){
				$film_user_diff = FilmUserDiff::find(Auth::user()->id);
				$data = json_decode($film_user_diff->film_ticked, true);
				if(isset($data[$film_id])){
					$ticked = 1;
				}
			}
			//comment
			$film_comments = FilmCommentLocal::where('film_id', $film_id)->orderBy('id', 'DESC')->take(10)->with('user')->get();
			return view('phimhay.film-info', compact('film_list', 'film_detail', 'film_trailer', 'ticked', 'film_episode_id', 'film_relates', 'film_relate_adds', 'film_comments'));
		}
		//not found
		return redirect()->route('404');
		

		
	}
	public function getFilmWatch($film_dir, $film_id, $film_episode_id){
		$film_id = (int)$film_id;
		//
		//
		$film_detail = null;
		$film_list = FilmList::where('id', $film_id)->where('film_dir_name', $film_dir)->first();

		if(count($film_list) == 1){
			$film_list->film_viewed = $film_list->film_viewed + 1;
			$film_list->save();
			$film_detail = FilmDetail::find($film_id);
			//
			//get ticked
			$ticked = 0;
			if(Auth::check()){
				$film_user_diff = FilmUserDiff::find(Auth::user()->id);
				$data = json_decode($film_user_diff->film_ticked, true);
				if(isset($data[$film_id])){
					$ticked = 1;
				}
			}
			//get episode
			$film_episode_list = null;
			$film_episode_watch = null;
			if($film_episode_id != 0){
				$film_episode_watch = FilmEpisode::find($film_episode_id);
				$film_episode_list = FilmEpisode::where('film_id', $film_id)->select('id', 'film_link_number', 'film_episode_language', 'film_episode')->get();
				// dump($film_episode_list);
			}
			//
			//film relate
			$relate_max = 12;
			$film_relates = null;
			$film_relate_adds = null;
			if($film_detail->film_relate_id == 1){

				//random type
				$data_type = explode(',', $film_detail->film_type);
				//ran
				$type_random = $data_type[random_int(0, count($data_type)-1)];
				//var_dump($type_random);
				$film_relates = FilmDetail::where('film_type', 'LIKE', '%'.$type_random.'%')->where('id', '!=', $film_id)->take($relate_max)->get();
				//dump($film_relates);
				//die();
			}else{
				//maximum 12
				$film_relates = FilmDetail::where('film_relate_id', $film_detail->film_relate_id)->where('id', '!=', $film_id)->take($relate_max)->get();
				if(count($film_relates) < $relate_max){
					//random type
					$data_type = explode(',', $film_detail->film_type);
					//ran
					$type_random = $data_type[random_int(0, count($data_type)-1)];
					$film_relate_adds = FilmDetail::where('film_type', 'LIKE', '%'.$type_random.'%')->where('id', '!=', $film_id)->where('film_relate_id', '!=', $film_detail->film_relate_id)->take($relate_max - count($film_relates))->get();
				}
			}
			return view('phimhay.film-watch', compact('film_list', 'film_detail', 'ticked', 'film_episode_list', 'film_episode_watch', 'film_relates', 'film_relate_adds'));
		}
		//not found
		return redirect()->route('404');
	}

	//admin
	public function getAdd(){
		return view('admin.film.add');
	}
	public function postAdd(Request $request){
		// if($request->has('film_relate_no')){
		// 	var_dump($request->film_relate_no);
		// }
		// die();
		$film_detail = new FilmDetail();
		$film_detail->film_category = $request->film_category;
		$film_detail->film_info = $request->film_info;
		$film_detail->film_score_imdb = $request->film_score_imdb;
		$film_detail->film_score_aw = $request->film_score_aw;
		//film_type
		$film_detail->film_type = implode(',', $request->film_type);
		$film_detail->film_country = implode(',', $request->film_country);
		$film_detail->film_director = $request->film_director;
		$film_detail->film_actor = $request->film_actor;
		//date
		$film_detail->film_release_date = $request->film_release_date_year.'-'.$request->film_release_date_month.'-'.$request->film_release_date_day;
		$film_detail->film_production_company = $request->film_production_company;
		//phim lien quan moi
		if($request->film_relate_new != ''){
			$film_relate = new FilmRelate();
			$film_relate->film_relate_name = $request->film_relate_new;
			$film_relate->save();
			$film_detail->film_relate_id = $film_relate->id;
		}else if($request->has('film_relate_no')){
			//ko co phim lien quan
			$film_detail->film_relate_id = 1;
		}else if($request->has('film_relate_selected')){
			//co phim lien quan
			$film_detail->film_relate_id = $request->film_relate_selected;
		}
		$film_detail->film_thumbnail_big = $request->film_thumbnail_big;
		$film_detail->film_poster_video = $request->film_poster_video;
		$film_detail->film_key_words = $request->film_key_words;
		$film_detail->save();
		//add film trailer
		$film_trailer = new FilmTrailer();
		$film_trailer->id = $film_detail->id;
		$film_trailer->film_episode_language = $request->film_episode_language;
		$film_trailer->film_src_name = $request->film_src_name;
		$film_trailer->film_src_full = $request->film_src_full;
		//get link
		//getlink
		if($request->film_src_name != 'youtube'){
			//reset src
			$film_trailer->film_src_360p = null;
			$film_trailer->film_src_480p = null;
			$film_trailer->film_src_720p = null;
			$film_trailer->film_src_1080p = null;
			$film_trailer->film_src_2160p = null;
			//gg drive
			$get_link_video = new GetLinkVideo();
			$phim_hay_config = PhimHayConfig::find(1);
			if($phim_hay_config->get_link_local == 1){
				if($request->film_src_name == 'google drive'){
					$get_link_video->getLinkVideoGoogleDrive($request->film_src_full);
					
				}else if($request->film_src_name == 'google photos'){
					$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
				}
			}else{
				//remote blogit
				$get_link_video->getLinkVideoByBlogIt($phim_hay_config->get_link_remote_api, $request->film_src_full);
			}
			$film_trailer->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_trailer->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_trailer->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_trailer->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_trailer->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
		}
		//
		$film_trailer->save();
		// add film list
		$film_list = new FilmList();
		$film_list->id = $film_detail->id;
		$film_list->film_name_en = $request->film_name_en;
		$film_list->film_name_vn = $request->film_name_vn;
		$film_list->film_time = $request->film_time;
		$film_list->film_years = $request->film_release_date_year;
		$film_list->film_quality = '';
		$film_list->film_language = null;
		$film_list->film_thumbnail_small = $request->film_thumbnail_small;
		//
		$film_process = new FilmProcess();
		$film_list->film_dir_name = $film_process->getFilmDirName($request->film_name_vn, $request->film_name_en, $request->film_release_date_year);
		$film_list->film_status = 'Trailer';
		$film_list->save();
		return redirect()->route('admin.film.getShow', $film_detail->id);
	}
	public function getList(){
		$films = FilmDetail::orderBy('id', 'DESC')->paginate(5);
		$films->setPath(route('admin.film.getList'));
		//dump($film_detail);
		return view('admin.film.list', compact('films'));
	}
	public function getEdit($film_id){
		$film_detail = FilmDetail::find($film_id);
		$film_list = FilmList::find($film_id);
		$film_trailer = FilmTrailer::find($film_id);
		$film_process = new FilmProcess();
		return view('admin.film.edit', compact('film_detail', 'film_list', 'film_trailer'));
	}
	public function postEdit($film_id, Request $request){
		$film_detail = FilmDetail::find($film_id);
		$film_detail->film_category = $request->film_category;
		$film_detail->film_info = $request->film_info;
		$film_detail->film_score_imdb = $request->film_score_imdb;
		$film_detail->film_score_aw = $request->film_score_aw;
		//film_type
		$film_detail->film_type = implode(',', $request->film_type);
		$film_detail->film_country = implode(',', $request->film_country);
		$film_detail->film_director = $request->film_director;
		$film_detail->film_actor = $request->film_actor;
		//date
		$film_detail->film_release_date = $request->film_release_date_year.'-'.$request->film_release_date_month.'-'.$request->film_release_date_day;
		$film_detail->film_production_company = $request->film_production_company;
		if($request->relate != 'no'){
			//phim lien quan moi
			if($request->film_relate_new != ''){
				$film_relate = new FilmRelate();
				$film_relate->film_relate_name = $request->film_relate_new;
				$film_relate->save();
				$film_detail->film_relate_id = $film_relate->id;
			}else if($request->has('film_relate_no')){
				//ko co phim lien quan
				$film_detail->film_relate_id = 1;
			}else if($request->has('film_relate_selected')){
				//co phim lien quan
				$film_detail->film_relate_id = $request->film_relate_selected;
			}
		}
		$film_detail->film_thumbnail_big = $request->film_thumbnail_big;
		$film_detail->film_poster_video = $request->film_poster_video;
		$film_detail->film_key_words = $request->film_key_words;
		$film_detail->save();
		//add film trailer
		$film_trailer = FilmTrailer::find($film_id);
		$film_trailer->film_episode_language = $request->film_episode_language;
		$film_trailer->film_src_name = $request->film_src_name;
		$film_trailer->film_src_full = $request->film_src_full;
		//get link
		//getlink
		if($request->film_src_name != 'youtube'){
			//reset src
			$film_trailer->film_src_360p = null;
			$film_trailer->film_src_480p = null;
			$film_trailer->film_src_720p = null;
			$film_trailer->film_src_1080p = null;
			$film_trailer->film_src_2160p = null;
			//gg drive
			$get_link_video = new GetLinkVideo();
			$phim_hay_config = PhimHayConfig::find(1);
			if($phim_hay_config->get_link_local == 1){
				if($request->film_src_name == 'google drive'){
					$get_link_video->getLinkVideoGoogleDrive($request->film_src_full);
					
				}else if($request->film_src_name == 'google photos'){
					$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
				}
			}else{
				//remote blogit
				$get_link_video->getLinkVideoByBlogIt($phim_hay_config->get_link_remote_api, $request->film_src_full);
			}
			$film_trailer->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_trailer->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_trailer->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_trailer->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_trailer->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
		}
		//
		$film_trailer->save();
		// add film list
		$film_list = FilmList::find($film_id);
		$film_list->film_name_en = $request->film_name_en;
		$film_list->film_name_vn = $request->film_name_vn;
		$film_list->film_time = $request->film_time;
		$film_list->film_years = $request->film_release_date_year;
		$film_list->film_quality = '';
		$film_list->film_language = implode(',', $request->film_language);
		$film_list->film_thumbnail_small = $request->film_thumbnail_small;
		//
		$film_process = new FilmProcess();
		$film_list->film_dir_name = $film_process->getFilmDirName($request->film_name_vn, $request->film_name_en, $request->film_release_date_year);
		$film_list->save();
		return redirect()->route('admin.film.getShow', $film_detail->id);
	}
	public function getShow($film_id){
		$film_detail = FilmDetail::find($film_id);
		$film_list = FilmList::find($film_id);
		$film_trailer = FilmTrailer::find($film_id);
		$film_episodes = FilmEpisode::where('film_id', $film_id)->paginate(12);
		$film_episodes->setPath(route('admin.film.getShow', $film_id));
		$film_process = new FilmProcess();
		return view('admin.film.show', compact('film_detail', 'film_list', 'film_trailer', 'film_id', 'film_episodes'));
	}
	public function postEditFilmTrailer($film_id, Request $request){
		$film_trailer = FilmTrailer::find($film_id);
		$film_trailer->film_src_name = $request->film_src_name;
		$film_trailer->film_src_full = $request->film_src_full;
		//getlink
		if($request->film_src_name != 'youtube'){
			//reset src
			$film_trailer->film_src_360p = null;
			$film_trailer->film_src_480p = null;
			$film_trailer->film_src_720p = null;
			$film_trailer->film_src_1080p = null;
			$film_trailer->film_src_2160p = null;
			//gg drive
			$get_link_video = new GetLinkVideo();
			$phim_hay_config = PhimHayConfig::find(1);
			if($phim_hay_config->get_link_local == 1){
				if($request->film_src_name == 'google drive'){
					$get_link_video->getLinkVideoGoogleDrive($request->film_src_full);
					
				}else if($request->film_src_name == 'google photos'){
					$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
				}
			}else{
				//remote blogit
				$get_link_video->getLinkVideoByBlogIt($phim_hay_config->get_link_remote_api, $request->film_src_full);
			}
			$film_trailer->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_trailer->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_trailer->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_trailer->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_trailer->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
		}
		$film_trailer->film_episode_language = $request->film_episode_language;
		$film_trailer->save();
		return redirect()->route('admin.film.getShow', $film_id);
	}
	public function postAddFilmEpisode($film_id, Request $request){
		$film_episode = new FilmEpisode();
		$film_episode->film_id = $film_id;
		$film_episode->film_link_number = $request->film_link_number;
		$film_episode->film_episode = $request->film_episode;
		$film_episode->film_src_name = $request->film_src_name;
		$film_episode->film_src_full = $request->film_src_full;
		$film_episode->film_episode_language = $request->film_episode_language;
		$film_episode->film_episode_quality = $request->film_episode_quality;
		$film_episode->film_src_remote = $request->film_src_remote;
		//
		//getlink, youtube ko can getlink
		if($request->film_src_name != 'youtube'){
			//reset src
			$film_episode->film_src_360p = null;
			$film_episode->film_src_480p = null;
			$film_episode->film_src_720p = null;
			$film_episode->film_src_1080p = null;
			$film_episode->film_src_2160p = null;
			//gg drive
			$get_link_video = new GetLinkVideo();
			$phim_hay_config = PhimHayConfig::find(1);
			//
			if($phim_hay_config->get_link_local == 1){
				if($request->film_src_name == 'google drive'){
					$get_link_video->getLinkVideoGoogleDrive($request->film_src_full);
					
				}else if($request->film_src_name == 'google photos'){
					$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
				}
			}else{
				//remote blogit
				$get_link_video->getLinkVideoByBlogIt($phim_hay_config->get_link_remote_api, $request->film_src_full);
			}
			$film_episode->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_episode->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_episode->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_episode->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_episode->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
		}
		$film_episode->save();
		//change -- status
		$film_process = new FilmProcess();
		$film_list = FilmList::find($film_id);
		$film_list->film_quality = $request->film_episode_quality;
		//
		if($film_list->filmDetail->film_category == 'le' || $film_list->filmDetail->film_category == 'hhle'){
			//le -> xu ly quality
			//change status
			$film_list->film_status = $film_process->xulyGetFilmQuality($request->film_episode_quality);
		}else{
			//bo
			$film_list->film_status = 'Tập '.$film_episode->film_episode.'/'.$film_list->film_time.' '.$film_process->xulyGetFilmQuality($request->film_episode_quality);
		}
		$film_list->save();
		return redirect()->route('admin.film.getShow', $film_id);
	}
	public function getEditFilmEpisode($film_id, $id, Request $request){
		$film_episode = FilmEpisode::find($id);
		$film_list = FilmList::find($film_id);
		$film_process = new FilmProcess();
		return view('admin.film.edit-film-episode', compact('film_episode', 'film_list'));
	}
	public function postEditFilmEpisode($film_id, $id, Request $request){
		$film_episode = FilmEpisode::find($id);
		$film_episode->film_src_name = $request->film_src_name;
		$film_episode->film_src_full = $request->film_src_full;
		$film_episode->film_link_number = $request->film_link_number;
		$film_episode->film_episode = $request->film_episode;
		$film_episode->film_episode_language = $request->film_episode_language;
		$film_episode->film_src_remote = $request->film_src_remote;
		//
		//getlink, youtube ko can getlink
		if($request->film_src_name != 'youtube'){
			//reset src
			$film_episode->film_src_360p = null;
			$film_episode->film_src_480p = null;
			$film_episode->film_src_720p = null;
			$film_episode->film_src_1080p = null;
			$film_episode->film_src_2160p = null;
			//gg drive
			$get_link_video = new GetLinkVideo();
			$phim_hay_config = PhimHayConfig::find(1);
			//
			if($phim_hay_config->get_link_local == 1){
				if($request->film_src_name == 'google drive'){
					$get_link_video->getLinkVideoGoogleDrive($request->film_src_full);
					
				}else if($request->film_src_name == 'google photos'){
					$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
				}
			}else{
				//remote blogit
				$get_link_video->getLinkVideoByBlogIt($phim_hay_config->get_link_remote_api, $request->film_src_full);
			}
			$film_episode->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_episode->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_episode->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_episode->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_episode->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
		}
		$film_episode->save();
		return redirect()->route('admin.film.getShow', $film_id);
	}
	//phim auto or search
	//film?country=abc&type=hanh-dong&year=2999
	public function getSearch(){
		$name = Input::get('name');
		$category = Input::get('category');
		$type = Input::get('type');
		$country = Input::get('country');
		$year = Input::get('year');
		// echo $category. '-'.$type.'-'.$country.'-'.$year;
		// die();
		//var_dump($type);
		//
		//case 1: tat ca deu null -> phim new
		$films = null;
		if(empty($name)){
			if($category == null && $type == null && $country == null && $year == null){
				//get id episode
				// $films = FilmDetail::orderBy('id', 'DESC')->select('id')->paginate(25);
				$films = FilmDetail::distinct()
				->whereIn('id', function($query2){
					$query2->from('film_episodes')
					->select('id')->distinct();
				})
				->orderBy('id', 'DESC')->with('filmList')->paginate(25);

			}
			else{
				//truoc2010
				if($year == 'truoc2010'){
					$year = 2010;
					$films = FilmDetail::where('film_category', 'LIKE', '%'.$category.'%')
						->where('film_type', 'LIKE', '%'.$type.'%')
						->where('film_country', 'LIKE', '%'.$country.'%')
						->whereHas('filmList', function($q) use($year){
							$q->where('film_years', '<', $year);
						})
						->select('id')->orderBy('id', 'DESC')->with('filmList')->paginate(25);
				}
				else{
					if(empty($year)){
						$films = FilmDetail::where('film_category', 'LIKE', '%'.$category.'%')
							->where('film_type', 'LIKE', '%'.$type.'%')
							->where('film_country', 'LIKE', '%'.$country.'%')
							
							->select('id')->orderBy('id', 'DESC')->with('filmList')->paginate(25);
					}else{
						//is year
						$films = FilmDetail::where('film_category', 'LIKE', '%'.$category.'%')
							->where('film_type', 'LIKE', '%'.$type.'%')
							->where('film_country', 'LIKE', '%'.$country.'%')
							->whereHas('filmList', function($q) use($year){
								$q->where('film_years', $year);
							})
							->select('id')->orderBy('id', 'DESC')->with('filmList')->paginate(25);

					}
				}
			}
		}else{
			//co name
			//change - to space
			$name = preg_replace('/[-]/', ' ', $name);
			// var_dump($name);
			$films = FilmDetail::whereIn('id', function($query3) use ($name){
				$query3->from('film_lists')
				->select('id')->where('film_name_vn', 'LIKE', '%'.$name.'%')->orWhere('film_name_en', 'LIKE', '%'.$name.'%')->get();
			})
					->select('id')->orderBy('id', 'DESC')->with('filmList')->paginate(25);
		}
		$films->setPath(route('film.getSearch'));
		// dump($films);
		return view('phimhay.film-search', compact('films', 'category', 'type', 'country', 'year', 'name'));
	}
	//
	public function getSearchAdmin(){
		return view('admin.film.search');
	}
}
