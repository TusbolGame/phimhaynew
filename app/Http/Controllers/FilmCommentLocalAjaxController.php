<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FilmList;
use App\FilmCommentLocal;
use Auth;
// use Illuminate\Http\Request;
use Request;
use LRedis;

class FilmCommentLocalController extends Controller {

	//
	//comment
	public function postAdd($film_id){
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
				$redis = LRedis::connection();
        		$redis->publish('comment-film-1', 'ok-'.time());
				$result['status'] = 1;
				$result['content'] = 'comment-add-success';
				return response()->json($result);
			}
		}
		$result['content'] = 'comment-add-not-success';
		return response()->json($result);
	}
}
