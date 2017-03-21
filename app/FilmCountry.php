<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmCountry extends Model {

	//
	protected $table = 'film_countries';
	protected $fillable = ['id', 'country_name', 'country_alias'];
	public $timestamps = false;

	public function filmDetailCountry(){
		return $this->hasMany('App\FilmDetailCountry', 'country_id', 'id');
	}

}
