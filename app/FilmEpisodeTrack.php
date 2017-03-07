<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmEpisodeTrack extends Model {

	//
	protected $table = 'film_episode_tracks';
	protected $fillable = ['id', 'film_episode_id', 'film_track_type', 'film_track_src'];
	public $timestamps = false;

	public function filmEpisode(){
		return $this->belongsTo('App\FilmEpisode', 'film_episode_id', 'id');
	}

}
