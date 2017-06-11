<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmList extends Model {

	protected $table = 'film_lists';
	protected $fillable = ['id', 'film_name_en', 'film_name_vn', 'film_kind', 'film_category', 'film_time', 'film_years', 'film_quality', 'film_language', 'film_thumbnail_small', 'film_vote', 'film_vote_count', 'film_viewed', 'film_dir_name', 'film_status'];
	public $timestamps = false;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'id', 'id');
	}
	public function filmEpisode(){
		return $this->hasMany('App\FilmEpisode', 'film_id', 'id');
	}
	public function filmDetailCountry(){
		return $this->hasMany('App\FilmDetailCountry', 'film_id', 'id');
	}
	public function filmDetailType(){
		return $this->hasMany('App\FilmDetailType', 'film_id', 'id');
	}
}
