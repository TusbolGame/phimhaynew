<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Request;
//
use App\FilmRelate;
use App\FilmList;
use App\FilmUserDiff;
use App\FilmCommentLocal;
use App\FilmPerson;
use App\FilmPersonJob;
use App\Lib\FilmProcess\FilmProcess;
use App\User;
use Auth;
use Cookie;
use DB;
use Illuminate\Http\Response;
class FilmAjaxController extends Controller {

	//controller process request ajax film: tick, vote, search
	public function getSearchFilm()
	{
		if (Request::ajax())
		{
		    //
		    $film_search = FilmList::where('film_name_vn','LIKE', '%'.Request::get('search_key_value').'%')->orWhere('film_name_en','LIKE', '%'.Request::get('search_key_value').'%')->take(8)->get();
		    die(json_encode($film_search));
		}
	}
	public function getSearchFilmRelate()
	{
		if (Request::ajax())
		{
		    //
		    $film_relate = FilmRelate::where('film_relate_name','LIKE', '%'.Request::get('search_film_relate').'%')->get();
		    die(json_encode($film_relate));
		}
	}
	public function getFilmTick()
	{
		$result = array('status' => 0, 'content' => '', 'login' => 1, 'timeout' => 1);
		//check login
		if(!Auth::check()){
			$result['content'] = 'not_login';
			$result['login'] = 0;
			//die(json_encode($result));
			return response()->json($result);
		}
		if (Request::ajax())
		{
		    //6lan lien tiep tren 1bo - cookie 30p
		    $film_id = (int)Request::get('film_id');
		    // check... security.. chua lam
		    if(Request::cookie('film_tick_'.$film_id)){
		    	// $result['content'] = Request::cookie('film_tick_'.$film_id);
			    	// return response()->json($result);
			    if(Request::cookie('film_tick_'.$film_id) > 8){
			    	$user = User::find(Auth::user()->id);
			    	//khoa account
			    	$user->blocked = 1;
			    	$user->save();
			    	Auth::logout();
			    	$result['content'] = 'Spam! Tài khoản đã bị khóa!';
			    	return response()->json($result);
			    }
		    	if(Request::cookie('film_tick_'.$film_id) > 6){
			    	$result['content'] = 'Spam! Bạn đã đánh dấu phim quá nhiều lần, nếu bạn còn Spam sẽ bị khóa tài khoản. Cảm ơn!';
			    	return response()->json($result)->withCookie(cookie('film_tick_'.$film_id,(int)Request::cookie('film_tick_'.$film_id) + 1 , 30));
			    }
			    
		    }
		    $film_user_diff =  FilmUserDiff::find(Auth::user()->id);
		    if(count($film_user_diff) == 1){
		    	
		    	$data = json_decode($film_user_diff->film_ticked, true);
		    	
		    	//check add
		    	if(Request::get('film_tick_content') == 'add_tick'){
		    		//not exists --> add
		    		if(!isset($data[$film_id])){
		    			$tick_max_count = 50;// maximum tick
		    			if(count($data) > $tick_max_count){
		    				//remove fist child
		    				array_shift($data); 
		    				unset($data[0]);
		    			}
		    			$data[$film_id] = 1;
		    			$film_user_diff->film_ticked = json_encode($data);
		    			$film_user_diff->save();
		    			$result['status'] = 1;
		    			$result['content'] = 'success_add_tick';
		    			if(!Request::cookie('film_tick_'.$film_id)){
				    		return response()->json($result)->withCookie(cookie('film_tick_'.$film_id, 1, 30));
				    	}
				    	else{
				    		//ton tai cookie
				    		return response()->json($result)->withCookie(cookie('film_tick_'.$film_id,(int)Request::cookie('film_tick_'.$film_id) + 1 , 30));
				    	}
		    		}
		    	}		    	
		    	//check remove
		    	else if(Request::get('film_tick_content') == 'remove_tick'){
		    		//check exist --> remove
		    		if(isset($data[$film_id])){
		    			unset($data[$film_id]);
		    			$film_user_diff->film_ticked = json_encode($data);
		    			$film_user_diff->save();

		    			$result['status'] = 1;
		    			$result['content'] = 'success_remove_tick';
		    			$film_user_diff->save();
		    			// return response()->json($result);
		    			//check exists cookie
				    	if(!Request::cookie('film_tick_'.$film_id)){
				    		return response()->json($result)->withCookie(cookie('film_tick_'.$film_id, 1, 30));
				    	}
				    	else{
				    		//ton tai cookie
				    		return response()->json($result)->withCookie(cookie('film_tick_'.$film_id,(int)Request::cookie('film_tick_'.$film_id) + 1 , 30));
				    	}
		    		}
			    	
		    	}
		    	$result['content'] = 'not_success';
				return response()->json($result);
		    }
		    $result['content'] = 'Lỗi';
			return response()->json($result);
		}
		$result['content'] = 'not_ajax';
		return response()->json($result);
	}
	public function getFilmEvaluate()
	{
		$result = array('status' => 0, 'content' => '', 'login' => 1, 'timeout' => 1);
		//check login
		if(!Auth::check()){
			$result['content'] = 'not_login';
			$result['login'] = 0;
			//die(json_encode($result));
			return response()->json($result);
		}
		if (Request::ajax())
		{
		    //acept danh gia timeout cookie 2h default
		    $film_id = (int)Request::get('film_id');
		    if(Request::cookie('film_evaluate_'.$film_id)){
		    	$result['content'] = 'Bạn đã đánh giá rồi';
		    	return response()->json($result);
		    }
		    $film_list =  FilmList::find($film_id);
		    if(count($film_list) == 1){
		    	$vote = (int)Request::get('film_vote');
		    	$vote_score = (float)((($film_list->film_vote*$film_list->film_vote_count) + $vote)/($film_list->film_vote_count + 1));
		    	$film_list->film_vote = $vote_score;
		    	$film_list->film_vote_count = $film_list->film_vote_count + 1;
		    	$film_list->save();
		    	$result['status'] = 1;
		    	$result['content'] = 'success_vote';
		    	//check exists cookie
		    	if(!Request::cookie('film_evaluate_'.$film_id)){
		    		//ko co cookie, add cookie, 2h
		    		return response()->json($result)->withCookie(cookie('film_evaluate_'.$film_id, 1, 180));
		    	}
				return response()->json($result);
		    }
		    $result['content'] = 'Lỗi';
			return response()->json($result);
		}
		$result['content'] = 'not_ajax';
		return response()->json($result);
	}

	//comment
	public function postFilmCommentAdd($film_id){
		$result = array('status' => 0, 'content' => '', 'login' => 1, 'timeout' => 1);
		//check login
		if(!Auth::check()){
			$result['content'] = 'not_login';
			$result['login'] = 0;
			//die(json_encode($result));
			return response()->json($result);
		}
		if (Request::ajax())
		{
			//check film exists
			$film_list = FilmList::find($film_id)->select('id');
			if(count($film_list) == 1){
				//add
				$film_comment = new FilmCommentLocal();
				$film_comment->film_id = $film_id;
				$film_comment->user_id = Auth::user()->id;
				$film_comment->film_comment_content = Request::get('comment_content');
				$film_comment->save();
				$result['status'] = 1;
				$result['content'] = 'comment-add-success';
				return response()->json($result);
			}
		}
		$result['content'] = 'comment-add-not-success';
		return response()->json($result);
	}

	
}
