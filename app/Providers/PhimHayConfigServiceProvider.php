<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\FilmList;
use App\FilmCountry;
use App\FilmType;
use App\FilmSlider;
use App\FilmEpisode;
use App\FilmJob;
use Cache;
use App\Lib\FilmProcess\FilmProcess;

class PhimHayConfigServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{		
		//
		$film_process = new FilmProcess();
		$film_hots = [];
		$cache_time_new = \Carbon\Carbon::now()->addMinutes(30); //30p
		//use cache
		//reset cache
		//cache film hh hot
		if(!Cache::has('film_hh_hot')){
			//no cache
			$film_hots['hh'] = FilmList::where('film_kind', 'hoat-hinh')->orderBy('film_viewed', 'DESC')->take(6)->get();
			//add cache
			// Cache::forever('film_hh_hot', $film_hots['hh']);
			Cache::put('film_hh_hot', $film_hots['hh'], $cache_time_new);
		}else{
			//is cache
			$film_hots['hh'] = Cache::get('film_hh_hot');
		}//end if(!Cache::has('film_hh_hot'))

		//cache film bo hot
		if(!Cache::has('film_bo_hot')){
			//no cache
			$film_hots['bo'] = FilmList::where('film_category', 'bo')->where('film_kind', 'truyen')->orderBy('film_viewed', 'DESC')->take(6)->get();
			//add cache
			// Cache::forever('film_bo_hot', $film_hots['bo']);
			Cache::put('film_hh_hot', $film_hots['hh'], $cache_time_new);
		}
		else{
			//is cache
			$film_hots['bo'] = Cache::get('film_bo_hot');
		}//end if(!Cache::has('film_bo_hot'))

		//cache film le hot
		if(!Cache::has('film_le_hot')){
			//no cache
			$film_hots['le'] = FilmList::where('film_category', 'le')->where('film_kind', 'truyen')->orderBy('film_viewed', 'DESC')->take(6)->get();
			//add cache
			// Cache::forever('film_le_hot', $film_hots['le']);
			Cache::put('film_hh_hot', $film_hots['hh'], $cache_time_new);
		}
		else{
			//is cache
			$film_hots['le'] = Cache::get('film_le_hot');
		}//end if(!Cache::has('film_le_hot'))

		//cache film country
		if(!Cache::has('film_country')){
			//no cache
			$film_country = FilmCountry::orderBy('country_name', 'ASC')->get();
			//add cache
			Cache::forever('film_country', $film_country);
		}
		else{
			//is cache
			$film_country= Cache::get('film_country');
		}//end if(!Cache::has('film_country'))

		//cache film type
		if(!Cache::has('film_type')){
			//no cache
			$film_type = FilmType::orderBy('type_name', 'ASC')->get();
			//add cache
			Cache::forever('film_type', $film_type);
		}
		else{
			//is cache
			$film_type= Cache::get('film_type');
		}//end if(!Cache::has('film_type'))
		view()->share('film_hots', $film_hots);
		view()->share('film_process', $film_process);
		view()->share('film_country', $film_country);
		view()->share('film_type', $film_type);
		//fix chi dung 1 so view
		// view()->composer(['phimhay.master', 'phimhay.home'], function($view){
		// 	$view->with(['phim_hay_config' => $phim_hay_config]);
		// });

		//cache film new
		$film_news = [];
		//
		//cache film new hh
		if(!Cache::has('film_hh_new')){
			//no cache
			$film_news['hh'] = FilmEpisode::orderBy('id', 'DESC')
				->groupBy('film_id')->take(15)
				->select('film_id')->whereHas('filmList', function($query){
						$query->where('film_kind', 'hoat-hinh');
				})->with('filmList')->get();
			//add cache
			Cache::forever('film_hh_new', $film_news['hh']);
		}//end if(!Cache::has('film_hh_new'))
		//cache film new le
		if(!Cache::has('film_le_new')){
			//no cache
			$film_news['le'] = FilmEpisode::orderBy('id', 'DESC')
				->groupBy('film_id')->take(15)
				->whereHas('filmList', function($query){
					$query->distinct()->where('film_kind', 'truyen')->where('film_category', 'le');
				})
				->select('film_id')->with('filmList')->get();
			//add cache
			Cache::forever('film_le_new', $film_news['le']);
		}//end if(!Cache::has('film_le_new'))
		//cache film new bo
		if(!Cache::has('film_bo_new')){
			//no cache
			$film_news['bo'] = FilmEpisode::orderBy('id', 'DESC')
				->groupBy('film_id')->take(15)
				->whereHas('filmList', function($query){
					$query->distinct()->where('film_kind', 'truyen')->where('film_category', 'bo');
				})
				->select('film_id')->with('filmList')->get();
			//add cache
			Cache::forever('film_bo_new', $film_news['bo']);
		}//end if(!Cache::has('film_bo_new'))

		//cache slider
		if(!Cache::has('film_slider')){
			//no cache
			$cache_slider = [];
			$film_slider = FilmSlider::where('id', '>=', 1)->with('filmList')->get();
			foreach ($film_slider as $key) {
				$temp['slider_name'] = $film_process->getFilmNameVnEn($key->filmList->film_name_vn, $key->filmList->film_name_en);
				$temp['film_id'] = $key->film_id;
				$temp['slider_dir'] = $key->filmList->film_dir_name;
				$temp['slider_image'] = $key->filmDetail->getFilmPosterVideo();
				array_push($cache_slider, $temp);
			}
			//add cache
			Cache::forever('film_slider', $cache_slider);
		}//end if(!Cache::has('film_type'))

		//film_job
		if(!Cache::has('film_job')){
			$film_job = FilmJob::orderBy('job_name', 'ASC')->get();
			Cache::forever('film_job', $film_job);
		}

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
