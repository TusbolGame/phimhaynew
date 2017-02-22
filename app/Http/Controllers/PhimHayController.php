<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
//
use Hash;
use Auth;
use App\Lib\UserEncrypt;
use App\Lib\CaptchaImages\CaptchaSessionLoginUser;
use Session;
use DB;
use App\FilmList;
use App\FilmSlider;
use App\FilmEpisode;
use App\Lib\FilmProcess\FilmProcess;

class PhimHayController extends Controller {

	//
	public function home(){
		$film_news = [];
		//da fix
		$film_news['hh'] = FilmEpisode::orderBy('id', 'DESC')
			->groupBy('film_id')->take(15)
			->whereHas('filmDetail', function($query){
				$query->distinct()->where('film_kind', 'hoat-hinh');
			})
			->select('film_id')->with('filmList')->get();
		// dump($film_news['hh']); die();
		$film_news['le'] = FilmEpisode::orderBy('id', 'DESC')
			->groupBy('film_id')->take(15)
			->whereHas('filmDetail', function($query){
				$query->distinct()->where('film_kind', 'truyen')->whereHas('filmList', function($query2){
					$query2->where('film_category', 'le');
				});
			})
			->select('film_id')->with('filmList')->get();
		$film_news['bo'] = FilmEpisode::orderBy('id', 'DESC')
			->groupBy('film_id')->take(15)
			->whereHas('filmDetail', function($query){
				$query->distinct()->where('film_kind', 'truyen')->whereHas('filmList', function($query2){
					$query2->where('film_category', 'bo');
				});
			})
			->select('film_id')->with('filmList')->get();
		//slider
		$film_sliders = FilmSlider::all();
		return view('phimhay.home', compact('film_news', 'film_sliders'));
	}
	
	
}
