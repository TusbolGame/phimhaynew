<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\PhimHayConfig;
use App\FilmList;
use App\FilmCountry;
use App\Lib\FilmProcess\FilmProcess;
use DB;
class PhimHayConfigServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$phim_hay_config = PhimHayConfig::find(1);
		view()->share('phim_hay_config', $phim_hay_config);
		$film_process = new FilmProcess();
		$film_hots = [];
		// $film_hots['hh'] = FilmList::orderBy('film_viewed', 'DESC')->take(6)->with(array('filmDetail'))->get();

		$film_hots['hh'] = FilmList::whereHas('filmDetail', function($query){
			$query->select('id')->where('film_category', 'LIKE', 'hh%');
		})->orderBy('film_viewed', 'DESC')->take(6)->get();
		$film_hots['le'] = FilmList::whereHas('filmDetail', function($query){
			$query->select('id')->where('film_category', 'le');
		})->orderBy('film_viewed', 'DESC')->take(6)->get();
		$film_hots['bo'] = FilmList::whereHas('filmDetail', function($query){
			$query->select('id')->where('film_category', 'bo');
		})->orderBy('film_viewed', 'DESC')->take(6)->get();
		
		// dump($film_hots['hh']);
		// var_dump($film_hots['hh'][1]->filmDetail->film_info);
		// die();
		$film_country = FilmCountry::all();
		view()->share('film_hots', $film_hots);
		view()->share('film_process', $film_process);
		view()->share('film_country', $film_country);
		// view()->composer(['phimhay.master', 'phimhay.home'], function($view){
		// 	$view->with(['phim_hay_config' => $phim_hay_config]);
		// });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
