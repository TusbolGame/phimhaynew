<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmEpisode extends Model {

	protected $table = 'film_episodes';
	protected $fillable = ['id', 'film_id', 'film_link_number', 'film_episode_language', 'film_episode', 'film_src_name', 'film_src_full', 'film_src_360p', 'film_src_480p', 'film_src_720p', 'film_src_1080p', 'film_src_2160p', 'created_at', 'updated_at'];
	public $timestamps = true;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}

}
