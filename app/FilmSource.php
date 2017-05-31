<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmSource extends Model {

	protected $table = 'film_sources';
	protected $fillable = ['id', 'film_episode_id', 'film_episode_language', 'film_src_name', 'film_src_full', 'film_src_360p', 'film_src_480p', 'film_src_720p', 'film_src_1080p', 'film_src_2160p', 'created_at', 'updated_at'];
	public $timestamps = true;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
	public function filmEpisode(){
		return $this->belongsTo('App\FilmEpisode', 'film_episode_id', 'id');
	}
	public function filmSourceTrack(){
		return $this->hasOne('App\FilmSourceTrack', 'film_source_id', 'id');
	}

}
