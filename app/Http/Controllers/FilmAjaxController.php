<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use Request;
//
use App\FilmRelate;
use App\FilmList;
use App\FilmCommentLocal;
use App\FilmPerson;
use App\FilmPersonJob;
use App\FilmUserTick;
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
	    	//check add
	    	if(Request::get('film_tick_content') == 'add_tick'){
    			//
    			$film_user_tick = FilmUserTick::where('user_id', Auth::user()->id)->where('film_id', $film_id)->get();
    			if(count($film_user_tick) == 0){
    				//add
    				FilmUserTick::insert(['film_id' => $film_id, 'user_id' => Auth::user()->id]);
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
	    		//
    			$film_user_tick = FilmUserTick::where('user_id', Auth::user()->id)->where('film_id', $film_id)->first();
    			if(count($film_user_tick) == 1){
    				//exist --> remove
    				$film_user_tick->delete();
    				$result['status'] = 1;
	    			$result['content'] = 'success_remove_tick';
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
}
