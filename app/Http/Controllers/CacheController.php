<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cache;

class CacheController extends Controller {

	//
	function getClear(){
		//clear all cache
		//film hh hot
		if(Cache::has('film_hh_hot')){
			Cache::forget('film_hh_hot');
		}
		//film bo hot
		if(Cache::has('film_bo_hot')){
			Cache::forget('film_bo_hot');
		}
		//film le hot
		if(Cache::has('film_le_hot')){
			Cache::forget('film_le_hot');
		}
		//film_country
		if(Cache::has('film_country')){
			Cache::forget('film_country');
		}
		//film_type
		if(Cache::has('film_type')){
			Cache::forget('film_type');
		}
		//film_hh_new
		if(Cache::has('film_hh_new')){
			Cache::forget('film_hh_new');
		}
		//film_le_new
		if(Cache::has('film_le_new')){
			Cache::forget('film_le_new');
		}
		//film_bo_new
		if(Cache::has('film_bo_new')){
			Cache::forget('film_bo_new');
		}
		//film_slider
		if(Cache::has('film_slider')){
			Cache::forget('film_slider');
		}
		return redirect()->route('admin.getHome')->with(['flash_message' => 'Susscess! Clear Cache']);
	}
}
