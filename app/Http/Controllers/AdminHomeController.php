<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Sessions;

class AdminHomeController extends Controller {

	//
	public function getHome(){
		$time = time() - 300; //5p
		$user_access = Sessions::whereNotNull('user_id')->where('last_activity', '>=', $time)->count();
		$guest_accesss = Sessions::whereNull('user_id')->where('last_activity', '>=', $time)->count();
		return view('admin.home', compact('user_access', 'guest_accesss'));
	}
}
