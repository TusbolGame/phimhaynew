<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmActor extends Model {

	//
	protected $table = 'film_actors';
	protected $fillable = ['id', 'film_id', 'actor_id', 'actor_character'];
	public $timestamps = false;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
	public function filmPerson(){
		return $this->belongsTo('App\FilmPerson', 'actor_id', 'id');
	}
}
