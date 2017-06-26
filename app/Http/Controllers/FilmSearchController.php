<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use App\FilmList;
use DB;

class FilmSearchController extends Controller {

	//film?country=abc&type=hanh-dong&year=2999
	public function getSearch(){
		$name = Input::get('name');
		$category = (!empty(Input::get('category'))) ? Input::get('category') : false;
		$kind = (!empty(Input::get('kind'))) ? Input::get('kind') : false;
		$type = (!empty(Input::get('type'))) ? Input::get('type') : false;
		$country = (!empty(Input::get('country'))) ? Input::get('country') : false;
		$year = (!empty(Input::get('year'))) ? Input::get('year') : false;
		// echo $category. ' - kind: '.$kind.'-'.$type.'-'.$country.'-'.$year;
		//
		$query = FilmList::query(); //return a query builder

		if($kind){
			$query->where('film_kind', $kind);
		}
		//cate
		if($category){
			$query->where('film_category', $category);
		}
		//year
		if($year){
			if($year == 'truoc2010'){
				$query->where('film_years', '<', 2010);
			}else{
				$query->where('film_years', $year);
			}
		}
		//type
		if($type){
			$query->whereHas('filmDetailType', function($query) use($type){
				$query->whereHas('filmType', function($query2) use($type){
					$query2->where('type_alias', $type);
				});
			});
		}
		//country
		if($country){
			$query->whereHas('filmDetailCountry', function($query) use($country){
				$query->whereHas('filmCountry', function($query2) use($country){
					$query2->where('country_alias', $country);
				});
			});
		}
		// return $query->get(); // this executes the query
		$query->orderBy('id', 'DESC');
		// $films = $query->get();
		$films = $query->paginate(25);
		// dump($films);exit;
		$films->setPath(route('film.getSearch'));
		return view('phimhay.film-search', compact('films', 'category', 'kind', 'type', 'country', 'year', 'name'));
	}
}
