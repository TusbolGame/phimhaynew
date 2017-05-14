<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//
use App\Lib\GetLinkVideo\GetLinkVideo;
use App\Lib\Videojs\VideojsPlay;

use App\FilmRelate;
use App\FilmDetail;
use App\FilmList;
use App\FilmTrailer;
use App\FilmEpisode;
use App\FilmEpisodeTrack;
use App\FilmUserTick;
use App\FilmUserWatch;
use App\FilmCommentLocal;
use App\FilmActor;
use App\FilmDirector;
use App\FilmPerson;
use App\FilmJob;
use App\FilmPersonJob;
use App\FilmCountry;
use App\FilmDetailCountry;
use App\FilmType;
use App\FilmDetailType;
use App\Lib\FilmProcess\FilmProcess;
use App\Lib\CaptchaImages\CaptchaSessionDownloadFilm;
use App\Lib\SessionTimeouts\SessionDownloadFilm;
use App\Lib\CheckLinks\HttpResponseCode;
use App\Lib\FilmPlayers\FilmPlayer;
use App\Lib\FilmCookies\CookieVideoStream;
use App\Lib\ParseUrlInfo;

use Input;
use Auth;
use File;
use DB;
//
use App\Sessions;
use App\Lib\GuestInfo;

class FilmController extends Controller {

	public function getTest(Request $request){
		//
		$http = new HttpResponseCode();
		$http->setUrl('https://www.youtube.com/watch?v=7777JGwWNGJdvx877');
		var_dump($http->getStatusCode());
		$status_code_error = ['404' => '', '403' => 'gg', '500' => '', '303' => ''];
		echo 
		exit;
		// $real_file_location_path_or_url = 'http://vjs.zencdn.net/v/oceans.mp4';
		$real_file_location_path_or_url = 'https://r15---sn-i3b7kn7y.googlevideo.com/videoplayback?id=3f8223b3c0aa7362&itag=18&source=picasa&begin=0&requiressl=yes&mm=30&mn=sn-i3b7kn7y&ms=nxu&mv=m&pl=21&sc=yes&ei=1LkVWabHBsvkoQPtnryACg&mime=video/mp4&lmt=1488386430735990&mt=1494595940&ip=1.52.35.213&ipbits=8&expire=1494624852&sparams=ip,ipbits,expire,id,itag,source,requiressl,mm,mn,ms,mv,pl,sc,ei,mime,lmt&signature=662BB58A6BEAD760F22A377940194C98F99B3332.3F330ADB3299A75A14E903D084A4B3E6686B1179&key=ck2';
		ini_set('memory_limit','1024M');
				//check http code

		set_time_limit(3600);

		ob_start();

		// do any user checks here - authentication / ip restriction / max downloads / whatever**

		// if check fails, return back error message**

		// if check succeeds, proceed with code below**

		if( isset($_SERVER['HTTP_RANGE']) )

		$opts['http']['header'][0]="Range: ".$_SERVER['HTTP_RANGE'];

		$opts['http']['method']= "HEAD";
		$opts['http']['header'][1]= "Cookie: DRIVE_STREAM=vCJp8VJJvTs; path=/; expires=Session; domain=.drive.google.com";
		// $opts['ssl'] = [
		//         'verify_peer'   => false];

		$conh=stream_context_create($opts);

		$opts['http']['method']= "GET";

		$cong= stream_context_create($opts);

		$out[]= file_get_contents($real_file_location_path_or_url,false,$conh);

		$out[]= $http_response_header;

		ob_end_clean();

		array_map("header",$http_response_header);

		readfile($real_file_location_path_or_url,false,$cong);
		exit;


		//
		var_dump(parse_url('https://drive.google.com/file/d/0B18baix_ssU1eFR3U3NfYzQ0ZVE/view'));
		exit;
		parse_str(file_get_contents('https://drive.google.com/get_video_info?docid=0B18baix_ssU1bE83ZUJuZWo4OFE'), $a);
		var_dump($a);

		exit;
		var_dump(urldecode('https://youtube.googleapis.com/embed/?status=ok&hl=en&allow_embed=0&ps=docs&partnerid=30&autoplay=0&docid=0B18baix_ssU1eFR3U3NfYzQ0ZVE&abd=0&public=false&el=leaf&title=ThanhXaBachXa.TheSorcererAndTheWhiteSnake.2011.720p.vs.mp4&BASE_URL=https%3A%2F%2Fdrive.google.com%2F&iurl=https%3A%2F%2Fdrive.google.com%2Fvt%3Fauthuser%3D0%26id%3D0B18baix_ssU1eFR3U3NfYzQ0ZVE&reportabuseurl=https%3A%2F%2Fdrive.google.com%2Fabuse%3Fauthuser%3D0%26id%3D0B18baix_ssU1eFR3U3NfYzQ0ZVE&token=1&plid=V0QUvb97yiBaGA&timestamp=1494561189215&length_seconds=6133&BASE_YT_URL=https%3A%2F%2Fdrive.google.com%2F&cc_load_policy=1&authuser=0&cc3_module=1&wmode=window&override_hl=1&enablecastapi=0&enablepostapi=1&postid=drive-viewer-video-player-object-0&origin=https%3A%2F%2Fdrive.google.com'));
		exit;
		$v = new GetLinkVideo();
		$v->getLinkVideoGooglePhotos('https://photos.google.com/share/AF1QipN6GJMmawu5OezQnWaQ57gq1vKCliAZAXbUXPgkvdP2-k8emJOM0GIudOR__6hw1w/photo/AF1QipNpIeistAMpgZ9oTfR4Hz568VFHzkeVobFEP3Xg?key=MVJWV21SbDV0N1EyZXQ5TW5fQXd6a1JneXp1TzZB');
		// $v->getLinkVideoGooglePhotos('https://photos.google.com/share/AF1QipN6GJMmawu5OezQnWaQ57gq1vKCliAZAXbUXPgkvdP2-k8emJOM0GIudOR__6hw1w?key=MVJWV21SbDV0N1EyZXQ5TW5fQXd6a1JneXp1TzZB');
		exit;
		$guest_info = new GuestInfo();
		$guest_info->setIp($request->ip());
		var_dump($guest_info->getBrowser());
		var_dump($guest_info->getLocationInfoByIp());
		var_dump($guest_info->getIp());
		var_dump($guest_info->getHttpReferer());
		var_dump($request->server('HTTP_REFERER'));
		var_dump($request->ip());

		
	}
	//check link image
	public function getCheckLink($film_id){
		$film_successes = [];
		$film_errors = [];
		$film_list = FilmList::find($film_id);
		//fb
		if(count($film_list) == 1){
			//
			$film_detail = FilmDetail::find($film_id);
			//check image small
			$check_link = new HttpResponseCode($film_list->film_thumbnail_small);
			if($check_link->checkHttpResponseCode200()){
				//ok
				$temp_content = 'Thumbnail Small: '.$check_link->getStatusCode().':'.$check_link->getStatusCodeName();
				array_push($film_successes, $temp_content);
			}else{
				$temp_content = 'Thumbnail Small: '.$check_link->getStatusCode().':'.$check_link->getStatusCodeName();
				array_push($film_errors, $temp_content);
			}
			$check_link = new HttpResponseCode($film_detail->film_thumbnail_big);
			if($check_link->checkHttpResponseCode200()){
				//ok
				$temp_content = 'Thumbnail Big: '.$check_link->getStatusCode().':'.$check_link->getStatusCodeName();
				array_push($film_successes, $temp_content);
			}else{
				$temp_content = 'Thumbnail Big: '.$check_link->getStatusCode().':'.$check_link->getStatusCodeName();
				array_push($film_errors, $temp_content);
			}
			$check_link = new HttpResponseCode($film_detail->film_poster_video);
			if($check_link->checkHttpResponseCode200()){
				//ok
				$temp_content = 'Poster Video: '.$check_link->getStatusCode().':'.$check_link->getStatusCodeName();
				array_push($film_successes, $temp_content);
			}else{
				$temp_content = 'Thumbnail Video: '.$check_link->getStatusCode().':'.$check_link->getStatusCodeName();
				array_push($film_errors, $temp_content);
			}
			return redirect()->route('admin.film.getShow', $film_list->id)->with(['film_successes' => $film_successes, 'film_errors' => $film_errors]);
		}
		// var_dump($film_successes);
		// var_dump($film_errors);
	}
	public function getFilmInfo($film_dir, $film_id){
		$film_id = (int)$film_id;
		$film_list = FilmList::find($film_id);
		if(count($film_list) == 1 && $film_list->film_dir_name == $film_dir){
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
			$film_detail_type = FilmDetailType::where('film_id', $film_id)->get();
			$data_type = [];
			foreach ($film_detail_type as $data) {
				array_push($data_type, $data->type_id);
			}
			//random type
			$type_random = 5;
			if(count($data_type) > 0){
				$type_random = $data_type[random_int(0, count($data_type)-1)];
			}			
			if($film_detail->film_relate_id == 1){
				
				if(count($film_detail_type) > 0){
					
					$film_relates = FilmDetail::where('id', '!=', $film_id)
					->whereHas('filmDetailType', function($query) use($type_random){
						$query->where('type_id', $type_random);
					})->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
					// dump($film_relates);die();
				}else{
					//ko co type
					$film_relates = FilmDetail::where('id', '!=', $film_id)
					->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
				}		
			}else{
				//maximum 12
				//is relate
				$relate_id = $film_detail->film_relate_id;
				$film_relates = FilmDetail::where('id', '!=', $film_id)
					->whereHas('filmDetailType', function($query) use($relate_id){
						$query->where('film_relate_id', $relate_id);
					})
					->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
				if(count($film_relates) < $relate_max){
					//random type
					$film_relate_adds = FilmDetail::where('id', '!=', $film_id)
					->whereHas('filmDetailType', function($query) use($type_random){
						$query->where('type_id', $type_random);
					})->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
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
				$film_user_tick = FilmUserTick::where('film_id', $film_id)->where('user_id', Auth::user()->id)->get();
				if(count($film_user_tick) == 1){
					$ticked = 1;
				}
			}
			//comment
			$film_comment_local_count = FilmCommentLocal::where('film_id', $film_id)->count();
			$film_comment_local_id_last = 0; //ko co comment
			$film_comment_local_last = FilmCommentLocal::where('film_id', $film_id)->first();
			if(count($film_comment_local_last) == 1){
				$film_comment_local_id_last = $film_comment_local_last->id;
			}
			$film_comments = FilmCommentLocal::where('film_id', $film_id)->orderBy('id', 'DESC')->take(10)->with('user')->get();
			//director
			$directors = FilmDirector::where('film_id', $film_id)->with(['filmPerson' => function ($query){
				$query->select('id', 'person_name', 'person_dir_name');
			}])->get();
			$actors = FilmActor::where('film_id', $film_id)->with(['filmPerson' => function ($query){
				$query->select('id', 'person_name', 'person_image', 'person_dir_name');
			}])->get();
			$film_detail_type = FilmDetailType::where('film_id', $film_id)->with(['filmType' => function ($query){
				$query->select('id', 'type_name', 'type_alias');
			}])->get();
			$film_detail_country = FilmDetailCountry::where('film_id', $film_id)->with(['filmCountry' => function ($query){
				$query->select('id', 'country_name', 'country_alias');
			}])->get();
			//channel redis
			$channel_name = 'film-comment-'.$film_id;
			//film player
			$film_player = new FilmPlayer();
			return view('phimhay.film-info', compact('film_list', 'film_detail', 'film_trailer', 'ticked', 'film_episode_id', 'film_relates', 'film_relate_adds', 'film_comments', 'directors', 'actors', 'film_detail_type', 'film_detail_country', 'film_comment_local_count', 'channel_name', 'film_comment_local_id_last', 'film_player'));
		}
		//not found
		// return redirect()->route('404');	
		return view('phimhay.include.404');	
	}
	public function getFilmWatch($film_dir, $film_id, $film_episode_id){
		$film_id = (int)$film_id;
		//
		$film_list = FilmList::where('id', $film_id)->where('film_dir_name', $film_dir)->first();
		if(count($film_list) == 1){
			$film_list->film_viewed = $film_list->film_viewed + 1;
			$film_list->save();
			//user watch
			if(Auth::check()){
				$film_user_watch = FilmUserWatch::where('film_id', $film_id)->where('user_id', Auth::user()->id)->first();
				if(count($film_user_watch) == 1){
					//exist --> ++
					$film_user_watch->user_viewed = $film_user_watch->user_viewed + 1;
					$film_user_watch->save();
				}else{
					//add
					$film_user_watch_new = new FilmUserWatch();
					$film_user_watch_new->film_id = $film_id;
					$film_user_watch_new->user_id = Auth::user()->id;
					$film_user_watch_new->user_viewed = 1;
					$film_user_watch_new->save();

				}
			}
			//
			//get ticked
			$ticked = 0;
			if(Auth::check()){
				$film_user_tick = FilmUserTick::where('film_id', $film_id)->where('user_id', Auth::user()->id)->get();
				if(count($film_user_tick) == 1){
					$ticked = 1;
				}
			}
			//get episode
			$film_episode_list = null;
			$film_episode_watch = null;
			$film_track = null;
			if($film_episode_id != 0){
				$film_episode_watch = FilmEpisode::find($film_episode_id);
				if($film_episode_watch->film_src_name == 'local'){
					//set cookie video stream
					$cookie_video = null;
					if(!empty($film_episode_watch->film_src_360p)){
						$cookie_video = new CookieVideoStream($film_episode_watch->film_src_360p);
						$cookie_video->createCookie();
					}
					if(!empty($film_episode_watch->film_src_480p)){
						$cookie_video = new CookieVideoStream($film_episode_watch->film_src_480p);
						$cookie_video->createCookie();
					}
					if(!empty($film_episode_watch->film_src_720p)){
						$cookie_video = new CookieVideoStream($film_episode_watch->film_src_720p);
						$cookie_video->createCookie();
					}
					if(!empty($film_episode_watch->film_src_1080p)){
						$cookie_video = new CookieVideoStream($film_episode_watch->film_src_1080p);
						$cookie_video->createCookie();
					}
					if(!empty($film_episode_watch->film_src_2160p)){
						$cookie_video = new CookieVideoStream($film_episode_watch->film_src_2160p);
						$cookie_video->createCookie();
					}
				}
				$film_episode_list = FilmEpisode::where('film_id', $film_id)->select('id', 'film_link_number', 'film_episode_language', 'film_episode')->get();
				// dump($film_episode_list);
				$film_track = FilmEpisodeTrack::where('film_episode_id', $film_episode_id)->first();
			}
			//
			$film_detail = FilmDetail::find($film_id);
			//film relate
			$relate_max = 12;
			$film_relates = null;
			$film_relate_adds = null;

			$film_detail_type = FilmDetailType::where('film_id', $film_id)->get();
			$data_type = [];
			foreach ($film_detail_type as $data) {
				array_push($data_type, $data->type_id);
			}
			//random type
			$type_random = 5;
			if(count($data_type) > 0){
				$type_random = $data_type[random_int(0, count($data_type)-1)];
			}			
			if($film_detail->film_relate_id == 1){
				
				if(count($film_detail_type) > 0){
					
					$film_relates = FilmDetail::where('id', '!=', $film_id)
					->whereHas('filmDetailType', function($query) use($type_random){
						$query->where('type_id', $type_random);
					})->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
					// dump($film_relates);die();
				}else{
					//ko co type
					$film_relates = FilmDetail::where('id', '!=', $film_id)
					->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
				}		
			}else{
				//maximum 12
				//is relate
				$relate_id = $film_detail->film_relate_id;
				$film_relates = FilmDetail::where('id', '!=', $film_id)
					->whereHas('filmDetailType', function($query) use($relate_id){
						$query->where('film_relate_id', $relate_id);
					})
					->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
				if(count($film_relates) < $relate_max){
					//random type
					$film_relate_adds = FilmDetail::where('id', '!=', $film_id)
					->whereHas('filmDetailType', function($query) use($type_random){
						$query->where('type_id', $type_random);
					})->select('id')->orderByRaw('RAND()')->take($relate_max)->with('filmList')->get();
				}
			}
			//comment
			$film_comment_local_count = FilmCommentLocal::where('film_id', $film_id)->count();
			$film_comment_local_id_last = 0; //ko co comment
			$film_comment_local_last = FilmCommentLocal::where('film_id', $film_id)->first();
			if(count($film_comment_local_last) == 1){
				$film_comment_local_id_last = $film_comment_local_last->id;
			}
			$film_comments = FilmCommentLocal::where('film_id', $film_id)->orderBy('id', 'DESC')->take(10)->with('user')->get();
			//channel redis
			$channel_name = 'film-comment-'.$film_id;
			//
			$film_player = new FilmPlayer();
			return view('phimhay.film-watch', compact('film_list', 'film_detail', 'ticked', 'film_episode_list', 'film_episode_watch', 'film_relates', 'film_relate_adds', 'film_comments', 'film_comment_local_count', 'channel_name', 'film_comment_local_id_last', 'film_player', 'film_track'));
		}
		//not found
		// return redirect()->route('404');
		return redirect()->view('phimhay.include.404');	
	}

	//admin
	public function getAdd(){
		$film_job = FilmJob::all();
		// $film_country = FilmCountry::all();//da co trong service
		return view('admin.film.add', compact('film_job'));
	}
	public function postAdd(Request $request){
		// Start transaction!
		DB::beginTransaction();
		$film_detail = new FilmDetail();
		$film_detail->film_kind = $request->film_kind;
		$film_detail->film_info = $request->film_info;
		$film_detail->film_score_imdb = $request->film_score_imdb;
		$film_detail->film_score_aw = $request->film_score_aw;
		//date
		$day = ($request->film_release_date_day != '') ? $request->film_release_date_day : '??';
		$month = ($request->film_release_date_month != '') ? $request->film_release_date_month : '??';
		$year = ($request->film_release_date_year != '') ? $request->film_release_date_year : '??';
		$film_detail->film_release_date = $day.'-'.$month.'-'.$year;
		$film_detail->film_production_company = $request->film_production_company;
		//phim lien quan moi
		if($request->film_relate_new != ''){
			$film_relate = new FilmRelate();
			$film_relate->film_relate_name = $request->film_relate_new;
			$film_relate->save();
			$film_detail->film_relate_id = $film_relate->id;
		}else if($request->has('film_relate_selected')){
			//co phim lien quan
			$film_detail->film_relate_id = $request->film_relate_selected;
		}else if($request->has('film_relate_no')){
			//ko co phim lien quan
			$film_detail->film_relate_id = 1;
		}
		$film_detail->film_thumbnail_big = $request->film_thumbnail_big;
		$film_detail->film_poster_video = $request->film_poster_video;
		$film_detail->film_key_words = $request->film_key_words;
		$film_detail_save = $film_detail->save();
		if($film_detail_save){
			//add country
			if(count($request->film_country_id) > 0){
				$country = [];
				foreach ($request->film_country_id as $key => $value) {
					$country[$key] = ['film_id' => $film_detail->id, 'country_id' => $value];
				}
				$film_country = FilmDetailCountry::insert($country);
			}
			//add type
			if(count($request->film_type_id) > 0){
				$type = [];
				foreach ($request->film_type_id as $key => $value) {
					$type[$key] = ['film_id' => $film_detail->id, 'type_id' => $value];
				}
				$film_detail_type = FilmDetailType::insert($type);
			}
			//add film actor
			if(count($request->actor_id) > 0){
				$actors = [];
				foreach ($request->actor_id as $key => $value) {
					$actors[$key] = ['film_id' => $film_detail->id, 'actor_id' => $value, 'actor_character' => $request->actor_character[$key]];
				}
				$film_actor = FilmActor::insert($actors);
			}
			//add film director
			if(count($request->director_id) > 0){
				$directors = [];
				foreach ($request->director_id as $key => $value) {
					$directors[$key] = ['film_id' => $film_detail->id, 'director_id' => $value];
				}
				$film_director = FilmDirector::insert($directors);
			}
		}
		// die();
		//add film trailer
		$film_trailer = new FilmTrailer();
		$film_trailer->id = $film_detail->id;
		$film_trailer->film_episode_language = $request->film_episode_language;
		$film_trailer->film_src_name = $request->film_src_name;
		$film_trailer->film_src_full = $request->film_src_full;
		//getlink
		//getlink, youtube ko can getlink
		$get_link_video = new GetLinkVideo();
		if($request->film_src_name == 'google photos'){
			//gg drive
			//
			if((int)env('GET_LINK_LOCAL') == 1){
				//use local
				$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
			}else{
				//remote video.io
				$get_link_video->getLinkVideoIo($request->film_src_full);
			}
			$film_trailer->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_trailer->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_trailer->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_trailer->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_trailer->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
		}else if($request->film_src_name == 'google drive'){
			//
			if(env('DRIVE_USE') == 'proxy'){
				//
				$get_link_video->getLinkDriveUseProxy($request->film_src_full);
				$film_trailer->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
				$film_trailer->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
				$film_trailer->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
				$film_trailer->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
				$film_trailer->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
				//add cookie
				$cookie = $get_link_video->getCookie();
				if(!empty($cookie['data'])){
					$film_trailer->drive_cookie = json_encode($cookie);
				}
			}

		}
		//
		//
		$film_trailer_save = $film_trailer->save();
		// add film list
		$film_list = new FilmList();
		$film_list->id = $film_detail->id;
		$film_list->film_name_en = $request->film_name_en;
		$film_list->film_name_vn = $request->film_name_vn;
		$film_list->film_category = $request->film_category;
		$film_list->film_time = $request->film_time;
		$film_list->film_years = $request->film_release_date_year;
		$film_list->film_quality = '';
		$film_list->film_language = null;
		$film_list->film_thumbnail_small = $request->film_thumbnail_small;
		//
		$film_process = new FilmProcess();
		$film_list->film_dir_name = $film_process->getFilmDirName($request->film_name_vn, $request->film_name_en, $request->film_release_date_year);
		$film_list->film_status = 'Trailer';
		$film_list_save = $film_list->save();
		if($film_detail_save && $film_trailer_save && $film_list_save){
			DB::commit();
			return redirect()->route('admin.film.getShow', $film_detail->id);
		}
		DB::rollback();
		return redirect()->back()->with(['flash_message_error' =>'Error! Không thể thêm phim'])->withInput();
	}
	public function getList(){
		$films = FilmDetail::orderBy('id', 'DESC')->with('filmList')->paginate(5);
		$films->setPath(route('admin.film.getList'));
		//dump($film_detail);
		return view('admin.film.list', compact('films'));
	}
	public function getEdit($film_id){
		$film_detail = FilmDetail::find($film_id);
		if(count($film_detail) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' =>'Get Edit! Không tồn tại film id: '.$film_id]);
		}
		$film_list = FilmList::find($film_id);
		$film_trailer = FilmTrailer::find($film_id);
		$film_job = FilmJob::all();
		$directors = FilmDirector::where('film_id', $film_id)->with(['filmPerson' => function($query){
			$query->select('id', 'person_name');
		}])->get();
		$actors = FilmActor::where('film_id', $film_id)->with(['filmPerson' => function($query){
			$query->select('id', 'person_name');
		}])->get();
		$film_detail_country = FilmDetailCountry::where('film_id', $film_id)->get();
		$film_detail_type = FilmDetailType::where('film_id', $film_id)->get();
		return view('admin.film.edit', compact('film_id', 'film_detail', 'film_list', 'film_trailer','film_job', 'directors', 'actors', 'film_detail_country', 'film_detail_type'));
	}
	public function postEdit($film_id, Request $request){
		$film_detail = FilmDetail::find($film_id);
		if(count($film_detail) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' =>'Post Edit! Không tồn tại film id: '.$film_id]);
		}
		$film_detail->film_kind = $request->film_kind;
		$film_detail->film_info = $request->film_info;
		$film_detail->film_score_imdb = $request->film_score_imdb;
		$film_detail->film_score_aw = $request->film_score_aw;
		//date
		$day = ($request->film_release_date_day != '') ? $request->film_release_date_day : '??';
		$month = ($request->film_release_date_month != '') ? $request->film_release_date_month : '??';
		$year = ($request->film_release_date_year != '') ? $request->film_release_date_year : '??';
		$film_detail->film_release_date = $day.'-'.$month.'-'.$year;
		$film_detail->film_production_company = $request->film_production_company;
		if(!$request->has('relate')){
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
		//country
		//delete all
		//add
		FilmDetailCountry::where('film_id', $film_id)->delete();
		//crate arr country
		if(count($request->film_country_id) > 0){
			$countries = [];
			foreach ($request->film_country_id as $key => $val) {
				array_push($countries, ['film_id' => $film_id, 'country_id' => $val]);
			}
			//add
			FilmDetailCountry::insert($countries);
		}
		//type
		//delete all
		//add
		FilmDetailType::where('film_id', $film_id)->delete();
		//crate arr type
		if(count($request->film_type_id) > 0){
			$types = [];
			foreach ($request->film_type_id as $key => $val) {
				array_push($types, ['film_id' => $film_id, 'type_id' => $val]);
			}
			//add
			FilmDetailType::insert($types);
		}
		//person
		//xoa all film director --> add lai
		//delete all director from film_director
		FilmDirector::where('film_id', $film_id)->delete();
		//crate arr director
		if(count($request->director_id) > 0){
			$directors = [];
			foreach ($request->director_id as $key) {
				array_push($directors, ['film_id' => $film_id, 'director_id' => $key]);
			}
			//add
			FilmDirector::insert($directors);
		}
		//xoa all film actor --> add lai
		//delete all actor from film_actor
		FilmActor::where('film_id', $film_id)->delete();
		//crate arr director
		if(count($request->actor_id) > 0){
			$actors = [];
			foreach ($request->actor_id as $key => $val) {
				array_push($actors, ['film_id' => $film_id, 'actor_id' => $val, 'actor_character' => $request->actor_character[$key]]);
			}
			//add
			FilmActor::insert($actors);
		}
		// die();
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
			if((int)env('GET_LINK_LOCAL') == 1){
				if($request->film_src_name == 'google drive'){
					$get_link_video->getLinkVideoGoogleDrive($request->film_src_full);
					
				}else if($request->film_src_name == 'google photos'){
					$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);	
				}
			}else{
				//remote video.io
				$get_link_video->getLinkVideoIo($request->film_src_full);
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
		$film_list->film_category = $request->film_category;
		$film_list->film_time = $request->film_time;
		$film_list->film_years = $request->film_release_date_year;
		$film_list->film_quality = $request->film_quality;
		if(count($request->film_language) > 0){
			$film_list->film_language = implode(',', $request->film_language);
		}
		$film_list->film_thumbnail_small = $request->film_thumbnail_small;
		//
		$film_process = new FilmProcess();
		$film_list->film_dir_name = $film_process->getFilmDirName($request->film_name_vn, $request->film_name_en, $request->film_release_date_year);
		$film_list->save();
		return redirect()->route('admin.film.getShow', $film_detail->id);
	}
	public function getDelete($film_id){
		$film_detail = FilmDetail::find($film_id);
		if(count($film_detail) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' =>'Lỗi! Delete: Không tồn tại film id: '.$film_id]);
		}
		$film_detail->delete();
		return redirect()->route('admin.film.getList')->with(['flash_message' =>'Thành công! Delete: Đã Delete Film_Id: '.$film_id]);
	}
	public function getShow($film_id){
		$film_detail = FilmDetail::find($film_id);
		if(count($film_detail) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' =>'Lỗi! Show! Không tồn tại film_id: '.$film_id]);
		}
		$film_list = FilmList::find($film_id);
		$film_trailer = FilmTrailer::find($film_id);
		$film_director = FilmDirector::where('film_id', $film_id)->with(['filmPerson' => 
			function ($query){
			$query->select('id', 'person_name', 'person_dir_name');
		}])->get();
		$film_actor = FilmActor::where('film_id', $film_id)->with(['filmPerson' => 
			function ($query){
			$query->select('id', 'person_name', 'person_dir_name');
		}])->get();
		$film_detail_country = FilmDetailCountry::where('film_id', $film_id)->with(['filmCountry' => 
			function ($query){
			$query->select('id', 'country_name');
		}])->get();
		$film_detail_type = FilmDetailType::where('film_id', $film_id)->with(['filmType' => 
			function ($query){
			$query->select('id', 'type_name');
		}])->get();
		$total_film_episode = FilmEpisode::where('film_id', $film_id)->count();
		return view('admin.film.show', compact('film_detail', 'film_list', 'film_trailer', 'film_id', 'film_director', 'film_actor', 'film_detail_country', 'film_detail_type', 'total_film_episode'));
	}
	public function postEditFilmTrailer($film_id, Request $request){
		//
		//check domain, status http
		if($request->film_src_name != 'local'){
			//check
			$path_url_info = new ParseUrlInfo($request->film_src_full);
			if($request->film_src_name == 'google drive'){
				if($path_url_info->getHost() != 'drive.google.com'){
					return redirect()->back()->with(['flash_message_error' => 'Trailer! Source Episode Error! Sai Domain Google Drive'])->withInput();
				}
			}elseif($request->film_src_name == 'google photos'){
				if($path_url_info->getHost() != 'photos.google.com'){
					return redirect()->back()->with(['flash_message_error' => 'Trailer! Source Episode Error! Sai Domain Google Photos'])->withInput();
				}
			}elseif($request->film_src_name == 'youtube'){
				if($path_url_info->getHost() != 'www.youtube.com'){
					return redirect()->back()->with(['flash_message_error' => 'Trailer! Source Episode Error! Sai Domain Youtube'])->withInput();
				}
			}
			//check http status code film_src_full
			//youtube check ko dc
			$http_response_code = new HttpResponseCode();
			$http_response_code->setUrl($request->film_src_full);
			if(!$http_response_code->checkHttpResponseCode200()){
				//error
				return redirect()->back()->with(['flash_message_error' => 'Trailer! Source Episode Status'.$http_response_code->getStatusCode().'!'.$http_response_code->getStatusCodeName()])->withInput();
			}
		}
		//
		$film_trailer = FilmTrailer::find($film_id);
		$film_trailer->film_src_name = $request->film_src_name;
		$film_trailer->film_src_full = $request->film_src_full;
		//reset src
			$film_trailer->film_src_360p = null;
			$film_trailer->film_src_480p = null;
			$film_trailer->film_src_720p = null;
			$film_trailer->film_src_1080p = null;
			$film_trailer->film_src_2160p = null;
		//getlink
		$get_link_video = new GetLinkVideo();
		if($request->film_src_name == 'google photos'){			
			//gg drive
			if((int)env('GET_LINK_LOCAL') == 1){
				//local
				$get_link_video->getLinkVideoGooglePhotos($request->film_src_full);			
			}else{
				//remote video.io
				$get_link_video->getLinkVideoIo($request->film_src_full);
			}
			$film_trailer->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
			$film_trailer->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
			$film_trailer->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
			$film_trailer->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
			$film_trailer->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
		}
		else if($request->film_src_name == 'google drive'){
			//
			if(env('DRIVE_USE') == 'embeb'){
				// $film_trailer->film_src_360p = $get_link_video->getLinkDriveEmbedYoutube($request->film_src_full);
			}elseif(env('DRIVE_USE') == 'proxy'){

				$get_link_video->getLinkDriveUseProxy($request->film_src_full);
				$film_trailer->film_src_360p = ($get_link_video->getSrc360()) ? $get_link_video->getSrc360() : null;
				$film_trailer->film_src_480p = ($get_link_video->getSrc480()) ? $get_link_video->getSrc480() : null;
				$film_trailer->film_src_720p = ($get_link_video->getSrc720()) ? $get_link_video->getSrc720() : null;
				$film_trailer->film_src_1080p = ($get_link_video->getSrc1080()) ? $get_link_video->getSrc1080() : null;
				$film_trailer->film_src_2160p = ($get_link_video->getSrc2160()) ? $get_link_video->getSrc2160() : null;
				//add cookie
				$cookie = $get_link_video->getCookie();
				if(!empty($cookie['data'])){
					$film_trailer->drive_cookie = json_encode($cookie);
				}
				
			}
		}
		$film_trailer->film_episode_language = $request->film_episode_language;
		$film_trailer->save();
		return redirect()->route('admin.film.getShow', $film_id);
	}
	//
	public function getFilmDownloadCaptcha($film_dir, $film_id, Request $request){
		$film_list =  FilmList::find($film_id);
		//check film
		if(count($film_list) == 0){
			return redirect()->route('404');
		}
		else if(count($film_list) == 1 && $film_list->film_dir_name != $film_dir){
			return redirect()->route('404');
		}
		//exist session  ->film-download
		$session_download_film = new SessionDownloadFilm($film_id);
		if($session_download_film->checkSessionUses()){
			return redirect()->route('film.getFilmDownload', [$film_dir, $film_id]);
		}
		//captcha auto
		return view('phimhay.film-download-captcha', compact('film_list'));
	}
	public function getFilmDownload($film_dir, $film_id, Request $request){
		$film_list =  FilmList::find($film_id);
		//check film
		if(count($film_list) == 0){
			return redirect()->route('404');
		}
		else if(count($film_list) == 1 && $film_list->film_dir_name != $film_dir){
			return redirect()->route('404');
		}
		$session_download_film = new SessionDownloadFilm($film_id);
		//check
		if($session_download_film->checkSessionUses()){
			// ton tai
			$film_episode = FilmEpisode::where('film_id', $film_id)->where('film_link_number', 1)->paginate(20);
			$film_episode->setPath(route('film.getFilmDownload', [$film_dir, $film_id]));
			return view('phimhay.film-download', compact('film_episode', 'film_list'));
			
		}
		//
		if($request->method('post') && $request->captcha_download_film != ''){
			$captcha_download_film = new CaptchaSessionDownloadFilm();
			$captcha_download_film->createCheckCaptchaSessionUses($request->captcha_download_film);
			//check captcha
			if($captcha_download_film->checkCaptchaSessionUses()){
				//forget
				$captcha_download_film->forgetCaptchaSessionUses();
				//session film_id
				$session_download_film->forgetSessionUses();
				$session_download_film->createSessionUses();
				//page 10
				$film_episode = FilmEpisode::where('film_id', $film_id)->where('film_link_number', 1)->paginate(20);
				$film_episode->setPath(route('film.getFilmDownload', [$film_dir, $film_id]));
				return view('phimhay.film-download', compact('film_episode', 'film_list'));
			}else{
				return redirect()->back()->withErrors('Sai mã bảo vệ hoặc hết thời hạn!');
			}
		}
		//ko ton tai session
		return redirect()->route('film.getFilmDownloadCaptcha', [$film_dir, $film_id])->withErrors('Lỗi! Hết thời gian timeout!');
		
	}
	//
	public function getSearchAdmin(){
		return view('admin.film.search');
	}
}
