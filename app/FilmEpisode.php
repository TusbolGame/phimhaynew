<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmEpisode extends Model {

	//
	protected $table = 'film_episodes';
	protected $fillable = ['id', 'film_id', 'film_episode', 'film_episode_name'];
	public $timestamps = true;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
	public function filmSource(){
		return $this->hasMany('App\FilmSource', 'film_episode_id', 'id');
	}
	public function filmSourceFirst(){
		return $this->filmSource()->take(0);
	}
	// public function filmSourceCount(){
	// 	return $this->hasMany('App\FilmSource', 'film_episode_id', 'id');
	// }
}
