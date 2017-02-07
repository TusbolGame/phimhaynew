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
		if(Request::ajax()){
			$user_search = User::where('username','LIKE', '%'.Request::get('search_key_value').'%')->orWhere('first_name','LIKE', '%'.Request::get('search_key_value').'%')->orWhere('last_name','LIKE', '%'.Request::get('search_key_value').'%')->select('id', 'username', 'first_name', 'last_name', 'image')->take(8)->get();
		    die(json_encode($user_search));
		}
	}
}
