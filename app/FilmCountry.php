<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmCountry extends Model {

	//
	protected $table = 'film_contries';
	protected $fillable = ['id', 'country_name', 'country_alias'];
	public $timestamps = true;

	public function filmDetailCountry(){
		return $this->hasMany('App\FilmDetailCountry', 'country_id', 'id');
	}

}
