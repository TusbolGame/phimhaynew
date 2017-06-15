<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

//
//
use App\Lib\Videojs\VideojsPlay;
use App\Lib\ProcessVideoLink;

use App\VideoPlayback;
use App\FilmRelate;
use App\FilmDetail;
use App\FilmList;
use App\FilmEpisode;
use App\FilmSource;
use App\FilmSourceTrack;
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
use File;


use Input;
use Auth;

use DB;
use Schema;
//
use App\Sessions;
use App\Lib\GuestInfo;

class FilmController extends Controller {

	public function getTest(Request $request){
		 Schema::table('video_playbacks', function($table){

			// $table->dropColumn('film_episode_id');
			// $table->integer('film_id')->unsigned()->default(1);
			// $table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			// $table->integer('film_source_id')->unsigned()->default(1);
			// $table->foreign('film_source_id')->references('id')->on('film_sources')->onDelete('cascade');
		});
		exit;
		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		$ffmpeg = \FFMpeg\FFMpeg::create();
		$video = $ffmpeg->open('resources/phim/movies/720p.mp4');
		$video
	    ->filters()
	    ->resize(new \FFMpeg\Coordinate\Dimension(480, 360))
	    ->synchronize();
	    // ->save(new \FFMpeg\Format\Video\X264(), 'export-x264-320-240.mp4');
		$format = new \FFMpeg\Format\Video\X264();
		$format->setAudioCodec('aac');
		//360p
		$format
    	->setKiloBitrate(250)
    	->setAudioChannels(2)
    	->setAudioKiloBitrate(96);
    	 $video->save($format, 'resources/phim/movies/360-1.mp4');
    	//480p
    	$video
	    ->filters()
	    ->resize(new \FFMpeg\Coordinate\Dimension(640, 480))
	    ->synchronize();
    	$format
    	->setKiloBitrate(400)
    	->setAudioChannels(2)
    	->setAudioKiloBitrate(128);
    	$video->save($format, 'resources/phim/movies/480-1.mp4');
    	//720p
    	$video
	    ->filters()
	    ->resize(new \FFMpeg\Coordinate\Dimension(1280, 720))
	    ->synchronize();
    	$format
    	->setKiloBitrate(1000)
    	->setAudioChannels(2)
    	->setAudioKiloBitrate(192);
	    $video->save($format, 'resources/phim/movies/720.mp4');
		exit;
		//resize
		/*
		$video
	    ->filters()
	    ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
	    ->synchronize();
	    */
	    // convert
	    /*
	    $video
	    ->save(new FFMpeg\Format\Video\X264(), 'export-x264.mp4')
	    ->save(new FFMpeg\Format\Video\WMV(), 'export-wmv.wmv')
	    ->save(new FFMpeg\Format\Video\WebM(), 'export-webm.webm');
	    */
	    $ffprobe = \FFMpeg\FFProbe::create();
		$dimension = $ffprobe
		    ->streams('resources/phim/movies/1080p.mp4') // extracts streams informations
		    ->videos()                      // filters video streams
		    ->first()                       // returns the first video stream
		    ->getDimensions();              // returns a FFMpeg\Coordinate\Dimension object
		$v = $ffprobe
		    ->streams('resources/phim/movies/1080p.mp4')
		    ->videos()
		    ->first();
		/*
		FFMpeg\FFProbe\DataMapping\Stream Object
		(
		    [properties:FFMpeg\FFProbe\DataMapping\AbstractData:private] => Array
		        (
		            [index] => 0
		            [codec_name] => h264
		            [codec_long_name] => H.264 / AVC / MPEG-4 AVC / MPEG-4 part 10
		            [profile] => High
		            [codec_type] => video
		            [codec_time_base] => 1/60
		            [codec_tag_string] => avc1
		            [codec_tag] => 0x31637661
		            [width] => 1920
		            [height] => 1080
		            [coded_width] => 1920
		            [coded_height] => 1080
		            [has_b_frames] => 1
		            [sample_aspect_ratio] => 1:1
		            [display_aspect_ratio] => 16:9
		            [pix_fmt] => yuv420p
		            [level] => 40
		            [chroma_location] => left
		            [refs] => 1
		            [is_avc] => true
		            [nal_length_size] => 4
		            [r_frame_rate] => 30/1
		            [avg_frame_rate] => 30/1
		            [time_base] => 1/90000
		            [start_pts] => 0
		            [start_time] => 0.000000
		            [duration_ts] => 1794060
		            [duration] => 19.934000
		            [bit_rate] => 4118786
		            [bits_per_raw_sample] => 8
		            [nb_frames] => 598
		            [disposition] => Array
		                (
		                    [default] => 1
		                    [dub] => 0
		                    [original] => 0
		                    [comment] => 0
		                    [lyrics] => 0
		                    [karaoke] => 0
		                    [forced] => 0
		                    [hearing_impaired] => 0
		                    [visual_impaired] => 0
		                    [clean_effects] => 0
		                    [attached_pic] => 0
		                    [timed_thumbnails] => 0
		                )

		            [tags] => Array
		                (
		                    [language] => und
		                    [handler_name] => VideoHandler
		                )

		        )

		)
		*/
		// var_dump($dimension);
		var_dump($v->get('width'));
		// var_dump($v->get('duration'));// get times- thoi luong video
		echo '<pre>';
		print_r($v);//
		echo '</pre>';
		//Use $dimension->getWidth() and $dimension->getHeight();
		//get frame from sesonds return image
		/*
		$video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(10))
    		->save('resources/phim/movies/frame.jpg');
    		*/

		// var_dump($video);

		// $film_list = FilmList::find(1);
		// var_dump($film_list->getFilmThumbnailSmall());exit;
		//
		// $film_detail = FilmDetail::all();
		// foreach ($film_detail as $key) {
		// 	$key->filmList->film_kind = $key->film_kind;
		// 	$key->filmList->save();
		// }
		// $int = 1 + time() + 5 +1;
		// echo hash('crc32', '1234567');exit;
		// $arr = [
		// 	131 => 'https://www.youtube.com/watch?v=PkflbYNW_1w',
		// 	132 => 'https://www.youtube.com/watch?v=S0f8NQRmtik',
		// 	133 => 'https://www.youtube.com/watch?v=UQx3PqAjyGc',
		// 	134 => 'https://www.youtube.com/watch?v=9OXc7oujYFk',
		// 	135 => 'https://www.youtube.com/watch?v=c44qSRQ6ZEk',
		// 	136 => 'https://www.youtube.com/watch?v=cIE-u_95GJ8',
		// 	137 => 'https://www.youtube.com/watch?v=Kb0bQGAZvck',
		// 	138 => 'https://www.youtube.com/watch?v=5vW1qLEsoMA',
		// 	139 => 'https://www.youtube.com/watch?v=VDVedSvvRGA',
		// 	140 => 'https://www.youtube.com/watch?v=mFje3V1QJgk',
		// 	141 => 'https://www.youtube.com/watch?v=Dm5CvR5uhoI',
		// 	142 => 'https://www.youtube.com/watch?v=ok3wwJpKDLI',
		
		// ];
		// foreach ($arr as $key => $value) {
		// 	// $episode = new FilmEpisode();
		// 	// $episode->film_id = 31;
		// 	// $episode->film_episode = $key;
		// 	// $episode->save();
		// 	$source = new FilmSource();
		// 	$source->film_episode_id = $key;
		// 	$source->film_episode_language = 'vs';
		// 	$source->film_episode_quality = '720p';
		// 	$source->film_src_name = 'youtube';
		// 	$source->film_src_full = $value;
		// 	$source->save();
		// }
		



		// $str =  new \NptNguyen\Libs\ParseUrlInfo('http://username:password@hostname:9090/path?arg=value#anchor');
		//
		//  Schema::table('video_playbacks', function($table){

		// 	// $table->dropColumn('film_episode_id');
		// 	$table->integer('film_id')->unsigned()->default(1);
		// 	$table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
		// 	$table->integer('episode_id')->unsigned()->default(1);
		// 	$table->foreign('episode_id')->references('id')->on('film_episodes')->onDelete('cascade');
		// 	$table->string('src_360p', 500)->nullable();
		// 	$table->string('src_480p', 500)->nullable();
		// 	$table->string('src_720p', 500)->nullable();
		// 	$table->string('src_1080p', 500)->nullable();
		// 	$table->string('src_2160p', 500)->nullable();
		// });
		// Schema::table('film_sources', function($table){

		// 	// $table->dropForeign('film_sources_film_id_foreign');
		// 	//  $table->dropIndex('film_episodes_film_id_foreign');
		// 	// $table->dropColumn('film_id');

		// 	$table->dropColumn('film_link_number');
		// 	$table->dropColumn('film_episode');
		// 	$table->dropColumn('film_src_remote');
		// });
		// Schema::drop('film_episodes');
		// Schema::table('film_sources', function($table){
			// $table->foreign('film_id')->references('id')->on('film_details')->onDelete('cascade');
			// $table->dropForeign('film_episodes_film_id_foreign');
		// });
		// Schema::table('film_episodes', function($table){
		// 	$table->foreign('film_id', 'film_episodes_film_id_foreign')->references('id')->on('film_details')->onDelete('cascade');
		// });
		// DB::table('migrations')->where('batch', 2)->delete();
		//
		// exit;
		// DB::table('migrations')->where('batch', 10)->where('migration', '2017_05_18_102143_create_film_episodes_table')->update(['batch' => 3, 'migration' => '2016_12_18_112620_create_film_episodes_table']);
		exit;	
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
		//check
		if(count($film_list) != 1 || $film_list->film_dir_name != $film_dir){
			return view('phimhay.include.404');
			exit;
		}
		//get info
		$film_detail = FilmDetail::find($film_id);
		//film episode id
		$film_episode = FilmEpisode::where('film_id', $film_id)->select('id')->orderBy('film_episode', 'ASC')->first();
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
		$film_source_id = 0;
		if(count($film_episode) == 1){
			$film_source = FilmSource::where('film_episode_id', $film_episode->id)->select('id')->first();
			if(count($film_source) == 1){
				$film_source_id = $film_source->id;
			}	
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
		return view('phimhay.film-info', compact('film_list', 'film_detail', 'ticked', 'film_source_id', 'film_relates', 'film_relate_adds', 'film_comments', 'directors', 'actors', 'film_detail_type', 'film_detail_country', 'film_comment_local_count', 'channel_name', 'film_comment_local_id_last', 'film_player'));
	}
	public function getFilmWatch($film_dir, $film_id, $film_source_id){
		$film_id = (int)$film_id;
		//
		$film_list = FilmList::find($film_id);
		//check
		if(count($film_list) != 1 || $film_list->film_dir_name != $film_dir){
			return view('phimhay.include.404');
			exit;
		}
		//ok
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
		//user ticked
		$ticked = 0;
		if(Auth::check()){
			$film_user_tick = FilmUserTick::where('film_id', $film_id)->where('user_id', Auth::user()->id)->get();
			if(count($film_user_tick) == 1){
				$ticked = 1;
			}
		}
		//get source
		$film_episode_list = null;
		$film_source_list = null;
		$film_source_watch = null;
		$film_source_track = null;
		$data_source = null;
		if($film_source_id != 0){
			$film_source_watch = FilmSource::find($film_source_id);
			//check exists source id
			if(count($film_source_watch) != 1){
				return view('phimhay.include.404');
				exit;
			}
			$film_source_list = FilmSource::where('film_episode_id', $film_source_watch->film_episode_id)->get();
			//
			$process_link = new ProcessVideoLink();
			$process_link->getVideoPlayback($film_id, $film_source_watch);
			$data_source = $process_link->getData();
			// var_dump($data_source);exit;
			/*
			//local ... change
			if($film_source_watch->film_src_name == 'local'){
				//set cookie video stream
				$cookie_video = null;
				if(!empty($film_source_watch->film_src_360p)){
					$cookie_video = new CookieVideoStream($film_source_watch->film_src_360p);
					$cookie_video->createCookie();
				}
				if(!empty($film_source_watch->film_src_480p)){
					$cookie_video = new CookieVideoStream($film_source_watch->film_src_480p);
					$cookie_video->createCookie();
				}
				if(!empty($film_source_watch->film_src_720p)){
					$cookie_video = new CookieVideoStream($film_source_watch->film_src_720p);
					$cookie_video->createCookie();
				}
				if(!empty($film_source_watch->film_src_1080p)){
					$cookie_video = new CookieVideoStream($film_source_watch->film_src_1080p);
					$cookie_video->createCookie();
				}
				if(!empty($film_source_watch->film_src_2160p)){
					$cookie_video = new CookieVideoStream($film_source_watch->film_src_2160p);
					$cookie_video->createCookie();
				}
			}
			*/
			//loi ko lay dc source first
			$film_episode_list = FilmEpisode::where('film_id', $film_id)->orderBy('film_episode', 'ASC')->get();
			// $film_episode_list = FilmEpisode::where('film_id', $film_id)->orderBy('id', 'ASC')->with(['filmSource' => function($query){
			// 	$query->orderBy('id', 'ASC')->take(1);
			// 	// $query->latest();
			// }])->get();
			// dump($film_episode_list);
			$film_source_track = FilmSourceTrack::where('film_source_id', $film_source_id)->first();
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
		return view('phimhay.film-watch', compact('film_list', 'film_detail', 'ticked', 'film_episode_list', 'film_source_watch', 'film_relates', 'film_relate_adds', 'film_comments', 'film_comment_local_count', 'channel_name', 'film_comment_local_id_last', 'film_player', 'film_source_track', 'data_source', 'film_source_list'));
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
		//
		$film_process = new FilmProcess();
		$dir_name =  $film_process->getFilmDirName($request->film_name_vn, $request->film_name_en, $request->film_release_date_year);
		//image thumbnail big
		$thumbnail_big_file = $request->file('film_thumbnail_big_file');
		if($thumbnail_big_file && $thumbnail_big_file->isValid()){
			//
			$image_name = $dir_name.'-poster-big.'.$thumbnail_big_file->getClientOriginalExtension();
			$thumbnail_big_file->move('resources/phim/poster/', $image_name);
			//update thumbnail big name
			$film_detail->film_thumbnail_big = $image_name;
		}
		$film_detail->film_poster_video = $request->film_poster_video;
		//image poster video
		$poster_video = $request->file('film_poster_video_file');
		if($poster_video && $poster_video->isValid()){
			//
			$image_name = $dir_name.'-poster-video.'.$poster_video->getClientOriginalExtension();
			$poster_video->move('resources/phim/poster/', $image_name);
			//update thumbnail big name
			$film_detail->film_poster_video = $image_name;
		}
		$film_detail->film_key_words = $request->film_key_words;
		$film_detail->src_youtube_trailer = $request->src_youtube_trailer;
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
		// add film list
		$film_list = new FilmList();
		$film_list->id = $film_detail->id;
		$film_list->film_name_en = $request->film_name_en;
		$film_list->film_name_vn = $request->film_name_vn;
		$film_list->film_kind = $request->film_kind;
		$film_list->film_category = $request->film_category;
		$film_list->film_time = $request->film_time;
		$film_list->film_years = $request->film_release_date_year;
		$film_list->film_quality = '';
		$film_list->film_language = null;
		$film_list->film_thumbnail_small = $request->film_thumbnail_small;
		//image thumbnail small
		$thumbnail_small_file = $request->file('film_thumbnail_small_file');
		if($thumbnail_small_file && $thumbnail_small_file->isValid()){
			//
			$image_name = $dir_name.'-poster-small.'.$thumbnail_small_file->getClientOriginalExtension();
			$thumbnail_small_file->move('resources/phim/poster/', $image_name);
			//update thumbnail big name
			$film_list->film_thumbnail_small = $image_name;
		}
		$film_list->film_dir_name = $dir_name;
		$film_list->film_status = 'Trailer';
		$film_list_save = $film_list->save();
		if($film_detail_save && $film_list_save){
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
		$film_job = FilmJob::all();
		$directors = FilmDirector::where('film_id', $film_id)->with(['filmPerson' => function($query){
			$query->select('id', 'person_name');
		}])->get();
		$actors = FilmActor::where('film_id', $film_id)->with(['filmPerson' => function($query){
			$query->select('id', 'person_name');
		}])->get();
		$film_detail_country = FilmDetailCountry::where('film_id', $film_id)->get();
		$film_detail_type = FilmDetailType::where('film_id', $film_id)->get();
		return view('admin.film.edit', compact('film_id', 'film_detail', 'film_list','film_job', 'directors', 'actors', 'film_detail_country', 'film_detail_type'));
	}
	public function postEdit($film_id, Request $request){
		$film_detail = FilmDetail::find($film_id);
		if(count($film_detail) == 0){
			return redirect()->route('admin.film.getList')->with(['flash_message_error' =>'Post Edit! Không tồn tại film id: '.$film_id]);
		}
		//
		$film_process = new FilmProcess();
		$dir_name = $film_process->getFilmDirName($request->film_name_vn, $request->film_name_en, $request->film_release_date_year);
		//
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
		//image thumbnail big
		$thumbnail_big_file = $request->file('film_thumbnail_big_file');
		if($thumbnail_big_file && $thumbnail_big_file->isValid()){
			//check exists file thumbnail big
			if(substr($film_detail->film_thumbnail_big, 0, 4) != 'http') {
				if(File::exists('resources/phim/poster/'.$film_detail->film_thumbnail_big)){
					//remove
					File::delete('resources/phim/poster/'.$film_detail->film_thumbnail_big);
				}
			}
			$image_name = $dir_name.'-poster-big.'.$thumbnail_big_file->getClientOriginalExtension();
			$thumbnail_big_file->move('resources/phim/poster/', $image_name);
			//update thumbnail big name
			$film_detail->film_thumbnail_big = $image_name;
		}else{
			$film_detail->film_thumbnail_big = $request->film_thumbnail_big;
		}
		//image poster video
		$poster_video_file = $request->file('film_poster_video_file');
		if($poster_video_file && $poster_video_file->isValid()){
			//check exists file thumbnail big
			if(substr($film_detail->film_poster_video, 0, 4) != 'http') {
				if(File::exists('resources/phim/poster/'.$film_detail->film_poster_video)){
					//remove
					File::delete('resources/phim/poster/'.$film_detail->film_poster_video);
				}
			}
			$image_name = $dir_name.'-poster-video.'.$poster_video_file->getClientOriginalExtension();
			$poster_video_file->move('resources/phim/poster/', $image_name);
			//update thumbnail big name
			$film_detail->film_poster_video = $image_name;
		}else{
			$film_detail->film_poster_video = $request->film_poster_video;
		}
		$film_detail->film_poster_video = $request->film_poster_video;
		$film_detail->film_key_words = $request->film_key_words;
		$film_detail->src_youtube_trailer = $request->src_youtube_trailer;
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
		// add film list
		$film_list = FilmList::find($film_id);
		$film_list->film_name_en = $request->film_name_en;
		$film_list->film_name_vn = $request->film_name_vn;
		$film_list->film_kind = $request->film_kind;
		$film_list->film_category = $request->film_category;
		$film_list->film_time = $request->film_time;
		$film_list->film_years = $request->film_release_date_year;
		$film_list->film_quality = $request->film_quality;
		if(count($request->film_language) > 0){
			$film_list->film_language = implode(',', $request->film_language);
		}
		//image thumbnail small
		$thumbnail_small_file = $request->file('film_thumbnail_small_file');
		if($thumbnail_small_file && $thumbnail_small_file->isValid()){
			//check exists file thumbnail big
			if(substr($film_list->film_thumbnail_small, 0, 4) != 'http') {
				if(File::exists('resources/phim/poster/'.$film_list->film_thumbnail_small)){
					//remove
					File::delete('resources/phim/poster/'.$film_list->film_thumbnail_small);
				}
			}
			$image_name = $dir_name.'-poster-small.'.$thumbnail_small_file->getClientOriginalExtension();
			$thumbnail_small_file->move('resources/phim/poster/', $image_name);
			//update thumbnail big name
			$film_list->film_thumbnail_small = $image_name;
		}else{
			$film_list->film_thumbnail_small = $request->film_thumbnail_small;
		}
		$film_list->film_thumbnail_small = $request->film_thumbnail_small;
		//
		$film_list->film_dir_name = $dir_name;
		$film_list->film_status = $request->film_status;
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
		return view('admin.film.show', compact('film_detail', 'film_list', 'film_id', 'film_director', 'film_actor', 'film_detail_country', 'film_detail_type', 'total_film_episode'));
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
