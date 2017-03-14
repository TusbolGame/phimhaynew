<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\PhimHayConfig;
use App\FilmList;
use App\FilmCountry;
use App\FilmType;
use App\Lib\FilmProcess\FilmProcess;

class PhimHayConfigServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$film_process = new FilmProcess();
		$film_hots = [];
		$film_hots['hh'] = FilmList::whereHas('filmDetail', function($query){
			$query->select('id')->where('film_kind', 'hoat-hinh');
		})->orderBy('film_viewed', 'DESC')->take(6)->get();
		//truyen - le
		$film_hots['le'] = FilmList::where('film_category', 'le')
		->whereHas('filmDetail', function($query){
			$query->select('id')->where('film_kind', 'truyen');
		})->orderBy('film_viewed', 'DESC')->take(6)->get();
		$film_hots['bo'] = FilmList::where('film_category', 'bo')
		->whereHas('filmDetail', function($query){
			$query->select('id')->where('film_kind', 'truyen');
		})->orderBy('film_viewed', 'DESC')->take(6)->get();
		$film_country = FilmCountry::all();
		$film_type = FilmType::orderBy('type_name', 'ASC')->get();
		view()->share('film_hots', $film_hots);
		view()->share('film_process', $film_process);
		view()->share('film_country', $film_country);
		view()->share('film_type', $film_type);
		//fix chi dung 1 so view
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
