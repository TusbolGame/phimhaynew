<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmDetailCountry extends Model {

	//
	protected $table = 'film_detail_contries';
	protected $fillable = ['id', 'film_id', 'country_id'];
	public $timestamps = false;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
	public function filmCountry(){
		return $this->belongsTo('App\FilmCountry', 'country_id', 'id');
	}
}
