<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//
use Cache;

class PhimHayController extends Controller {

	//
	public function home(){
		$film_news = [];
		//
		$film_news['hh'] = Cache::get('film_hh_new');
		// dump($film_news['hh']); die();
		$film_news['le'] = Cache::get('film_le_new');
		$film_news['bo'] = Cache::get('film_bo_new');
		//slider
		$film_sliders = Cache::get('film_slider');
		return view('phimhay.home', compact('film_news', 'film_sliders'));
	}
	
	
}
