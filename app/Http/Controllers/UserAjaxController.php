<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
use Request;
use App\User;
class UserAjaxController extends Controller {

	//
	public function postSearch(){
		//return view('admin.user.search');
		$result = array('status' => 0, 'content' => '', 'login' => 1, 'timeout' => 1);
		if(Request::ajax()){
			$user_search = User::where('username','LIKE', '%'.Request::get('search_key_value').'%')->orWhere('first_name','LIKE', '%'.Request::get('search_key_value').'%')->orWhere('last_name','LIKE', '%'.Request::get('search_key_value').'%')->select('id', 'username', 'first_name', 'last_name', 'image')->take(8)->get();
			$result['status'] = 1;
			$result['content'] = $user_search;
		    die(json_encode($result));
		}
	}
}
