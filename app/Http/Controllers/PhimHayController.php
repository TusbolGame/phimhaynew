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
use App\Lib\FilmProcess\FilmProcess;
class PhimHayController extends Controller {

	//
	public function home(){
		$film_news = [];
		// $film_news['hh'] = FilmList::distinct()
		// 	->whereHas('filmDetail', function($query){
		// 		$query->where('film_category', 'LIKE', 'hh%');
		// 	})
		// 	->whereIn('id', function($query2){
		// 		$query2->from('film_episodes')
		// 		->select('id');
		// 	})
		// 	->orderBy('id', 'DESC')->take(15)->toSql();
		//chua fix dc cho la category nao cua episode???loi cho sap xep truoc
		$film_news['hh'] = FilmList::distinct()
			->whereHas('filmDetail', function($query){
				$query->where('film_category', 'LIKE', 'hh%');
			})
			->whereHas('filmEpisode', function($query2){
				$query2->distinct()->orderBy('id', 'DESC');
			})
			->take(15)->get();
		// dump($film_news['hh']); die();
		$film_news['le'] = FilmList::distinct()->whereHas('filmDetail', function($query){
				$query->select('id')->where('film_category', 'le');
			})
			->whereIn('id', function($query2){
				$query2->from('film_episodes')
				->select('id');
			})
			->orderBy('id', 'DESC')->take(15)->get();
		$film_news['bo'] = FilmList::distinct()->whereHas('filmDetail', function($query){
				$query->select('id')->where('film_category', 'bo');
			})
			->orderBy('id', 'DESC')->take(15)->get();
		//slider
		$film_sliders = FilmSlider::all();
		return view('phimhay.home', compact('film_news', 'film_sliders'));
	}
	public function getTest(){
		
		
		// $user_encrypt = new UserEncrypt();
		// //create active_hash
		// $active_hash = $user_encrypt->getActivedHash(1, 'admin');
		// //connect db, save active_hash
		// $user = \App\User::find(1);
		// $user->active_hash = $active_hash;
		// $user->save();
		//redirect
		//return redirect()->route('auth.getActived', $active_hash);
	}
	
}
