<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmTrailer extends Model {

	protected $table = 'film_trailers';
	protected $fillable = ['id', 'film_link_number', 'film_episode_language', 'film_episode', 'film_src_name', 'film_src_full', 'film_src_360p', 'film_src_480p', 'film_src_720p', 'film_src_1080p', 'film_src_2160p'];
	public $timestamps = false;


	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'id', 'id');
	}

}
