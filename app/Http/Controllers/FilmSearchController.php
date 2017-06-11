<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input;
use App\FilmList;

class FilmSearchController extends Controller {

	//
	//phim auto or search
	//film?country=abc&type=hanh-dong&year=2999
	public function getSearch(){
		$name = Input::get('name');
		$category = Input::get('category');
		$kind = Input::get('kind');
		$type = Input::get('type');
		$country = Input::get('country');
		$year = Input::get('year');
		// echo $category. '-'.$type.'-'.$country.'-'.$year;
		// die();
		//var_dump($type);
		//
		//case 1: tat ca deu null -> phim new
		$films = null;
		//ko name
		if(empty($name)){
			if($category == null && $type == null && $country == null && $year == null && $kind == null){
				//get id episode
				// $films = FilmList::distinct()
				// ->whereIn('id', function($query2){
				// 	$query2->from('film_episodes')
				// 	->distinct();
				// })
				// ->orderBy('id', 'DESC')->paginate(25);
				// $films = FilmList::orderBy('id', 'DESC')->paginate(25);
				$films = FilmList::orderBy('id', 'DESC')->paginate(25);
			}
			else{
				//is year
				if(!empty($year)){		
					//is year
					//truoc2010
					if($year == 'truoc2010'){
						$truoc2010 = 2010;
						//is country
						if(!empty($country)){
							//is type
							if(!empty($type)){
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko kind
									// ->whereHas('filmList', function($q2) use($category){
									// 		$q2->where('film_category', $category);
									// 	})
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_years', '<', $truoc2010)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_years', '<', $truoc2010)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}
							}else{
								//ko type
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)->where('film_category', $category)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year
										//is country
										//ko type
										//is kind
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko type, ko kind
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_years', '<', $truoc2010)->where('film_category', $category)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year, is country, ko type ko kind ko cate
										$films = FilmList::where('film_years', '<', $truoc2010)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}	
							}
						} /*endif(!empty($country))*/
						//ko co country
						else{
							//is type
							if(!empty($type)){
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko kind
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_years', '<', $truoc2010)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_years', '<', $truoc2010)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}
							}else{
								//ko type
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)->where('film_category', $category)
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year
										//ko country
										//ko type
										//is kind
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', '<', $truoc2010)
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko type, ko kind
									//is category
									if(!empty($category)){
										$films = FilmList::
										where('film_years', '<', $truoc2010)
										->where('film_category', $category)
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year, ko country, ko type ko kind ko cate
										$films = FilmList::
										where('film_years', '<', $truoc2010)
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}	
							}
							
						}
					}else{
						//is year binh thuong:
						//is country
						if(!empty($country)){
							//is type
							if(!empty($type)){
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko kind
									// ->whereHas('filmList', function($q2) use($category){
									// 		$q2->where('film_category', $category);
									// 	})
									//is category
									if(!empty($category)){
										$films = FilmList::
										where('film_years', $year)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_years', $year)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}
							}else{
								//ko type
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)->where('film_category', $category)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year
										//is country
										//ko type
										//is kind
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko type, ko kind
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_years', $year)->where('film_category', $category)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year, is country, ko type ko kind ko cate
										$films = FilmList::where('film_years', $year)
										->whereHas('filmDetailCountry', function($query) use($country){
												$query->whereHas('filmCountry', function($query2) use($country){
													$query2->where('country_alias', $country);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}	
							}
						} /*endif(!empty($country))*/
						//ko co country
						else{
							//is type
							if(!empty($type)){
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko kind
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_years', $year)->where('film_category', $category)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//ko category
										$films = FilmList::where('film_years', $year)
										->whereHas('filmDetailType', function($query) use($type){
												$query->whereHas('filmType', function($query2) use($type){
													$query2->where('type_alias', $type);
												});
											})
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}
							}else{
								//ko type
								//is kind
								if(!empty($kind)){
									//is category
									if(!empty($category)){
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)->where('film_category', $category)
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year
										//ko country
										//ko type
										//is kind
										//ko category
										$films = FilmList::where('film_kind', $kind)
										->where('film_years', $year)
										->orderBy('id', 'DESC')->paginate(25);
									}
								}else{
									//ko type, ko kind
									//is category
									if(!empty($category)){
										$films = FilmList::
										where('film_years', $year)->where('film_category', $category)
										->orderBy('id', 'DESC')->paginate(25);
									}else{
										//is year, ko country, ko type ko kind ko cate
										$films = FilmList::
										where('film_years', $year)
										->orderBy('id', 'DESC')->paginate(25);
									}
									
								}	
							}
							
						}
					}
				} /*endif !empty year*/
				else{
					//ko year
					//is country
					//is country
					if(!empty($country)){
						//is type
						if(!empty($type)){
							//is kind
							if(!empty($kind)){
								//is category
								if(!empty($category)){
									$films = FilmList::where('film_kind', $kind)
									->where('film_category', $category)
									->whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko category
									$films = FilmList::where('film_kind', $kind)
									->whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}
							}else{
								//ko kind
								//is category
								if(!empty($category)){
									$films = FilmList::where('film_category', $category)
									->whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko category
									$films = FilmList::
									whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}
								
							}
						}else{
							//ko type
							//is kind
							if(!empty($kind)){
								//is category
								if(!empty($category)){
									$films = FilmList::where('film_kind', $kind)
									->where('film_category', $category)
									->whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko year
									//is country
									//ko type
									//is kind
									//ko category
									$films = FilmList::where('film_kind', $kind)
									->whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}
							}else{
								//ko type, ko kind
								//is category
								if(!empty($category)){
									$films = FilmList::where('film_category', $category)
									->whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko year, is country, ko type ko kind ko cate
									$films = FilmList::
									whereHas('filmDetailCountry', function($query) use($country){
											$query->whereHas('filmCountry', function($query2) use($country){
												$query2->where('country_alias', $country);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}
								
							}	
						}
					} /*endif(!empty($country))*/
					//ko co country
					else{
						//is type
						if(!empty($type)){
							//is kind
							if(!empty($kind)){
								//is category
								if(!empty($category)){
									$films = FilmList::where('film_kind', $kind)
									->where('film_category', $category)
									->whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko category
									$films = FilmList::where('film_kind', $kind)
									->whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}
							}else{
								//ko kind
								//is category
								if(!empty($category)){
									$films = FilmList::where('film_category', $category)
									->whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko category
									$films = FilmList::
									whereHas('filmDetailType', function($query) use($type){
											$query->whereHas('filmType', function($query2) use($type){
												$query2->where('type_alias', $type);
											});
										})
									->orderBy('id', 'DESC')->paginate(25);
								}
								
							}
						}else{
							//ko type
							//is kind
							if(!empty($kind)){
								//is category
								if(!empty($category)){
									$films = FilmList::where('film_kind', $kind)
									->where('film_category', $category)
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko year
									//ko country
									//ko type
									//is kind
									//ko category
									$films = FilmList::where('film_kind', $kind)
									->orderBy('id', 'DESC')->paginate(25);
								}
							}else{
								//ko type, ko kind
								//is category
								if(!empty($category)){
									$films = FilmList::
									where('film_category', $category)
									->orderBy('id', 'DESC')->paginate(25);
								}else{
									//ko year, ko country, ko type ko kind ko cate
									$films = FilmList::orderBy('id', 'DESC')->paginate(25);
								}
								
							}	
						}
						
					}

				} /*end else ko year */
			}
		}else{
			//is name
			//change - to space
			$name = preg_replace('/[-]/', ' ', $name);
			// var_dump($name);
			$films = FilmList::where('film_name_vn', 'LIKE', '%'.$name.'%')->orWhere('film_name_en', 'LIKE', '%'.$name.'%')
				->orderBy('id', 'DESC')->paginate(25);
		}
		$films->setPath(route('film.getSearch'));
		// dump($films);
		return view('phimhay.film-search', compact('films', 'category', 'kind', 'type', 'country', 'year', 'name'));
	}
}
