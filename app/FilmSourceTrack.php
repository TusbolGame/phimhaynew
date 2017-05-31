<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmSourceTrack extends Model {

	//
	protected $table = 'film_source_tracks';
	protected $fillable = ['id', 'film_source_id', 'film_track_type', 'film_track_src'];
	public $timestamps = false;

	public function filmSource(){
		return $this->belongsTo('App\FilmSource', 'film_source_id', 'id');
	}

}
