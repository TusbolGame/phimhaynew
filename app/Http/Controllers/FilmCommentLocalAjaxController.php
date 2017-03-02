<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\FilmList;
use App\FilmCommentLocal;
use Auth;
// use Illuminate\Http\Request;
use Request;
use LRedis;

class FilmCommentLocalAjaxController extends Controller {

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
			$film_list = FilmList::find($film_id);
			if(count($film_list) == 1){
				//add
				$film_comment = new FilmCommentLocal();
				$film_comment->film_id = $film_id;
				$film_comment->user_id = Auth::user()->id;
				$film_comment->film_comment_content = Request::get('comment_content');
				$film_comment->save();
				$total_commtent = FilmCommentLocal::where('film_id', $film_id)->count();
				$comment_data = [];
				$comment_data['user_id'] = Auth::user()->id;
				$comment_data['username'] = Auth::user()->username;
				$comment_data['image'] = (substr(Auth::user()->image, 0, 4) == 'icon') ? url('resources/photos/'.Auth::user()->image) : Auth::user()->image;
				$comment_data['content'] = $film_comment->film_comment_content;
				$comment_data['time'] = $film_comment->created_at;
				$comment_data['total'] = $total_commtent;
				$payload = 
				[	'data' => 
						['_channel' => 'film-comment-2', 'comment' => $comment_data
						],
					'event' => 'messages.new'
				];
				//add redis
				//
				$channel_name = 'film-comment-'.$film_id;
				$redis = LRedis::connection();
		        $redis->publish($channel_name, json_encode($payload));
				$result['status'] = 1;
				$result['content'] = 'comment-add-success';
				return response()->json($result);
			}
		}
		$result['content'] = 'comment-add-not-success';
		return response()->json($result);
	}
	public function postLoad($film_id){
		$result = array('status' => 0, 'content' => '', 'login' => 1);
		if (Request::ajax())
		{
			//check film exists
			$film_list = FilmList::find($film_id);
			if(count($film_list) == 1){
				//add
				$film_comment = FilmCommentLocal::where('id','<', Request::get('comment_id'))->where('film_id', $film_id)->orderBy('id', 'DESC')->take(10)->with('user')->get();
				$result['status'] = 1;
				$result['content'] = $film_comment;
				return response()->json($result);
			}
		}
		$result['content'] = 'Lỗi không thể load';
		return response()->json($result);
	}
}
