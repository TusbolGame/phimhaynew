<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmDirector extends Model {

	//
	protected $table = 'film_directors';
	protected $fillable = ['id', 'film_id', 'director_id'];
	public $timestamps = false;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
	public function filmPerson(){
		return $this->belongsTo('App\FilmPerson', 'director_id', 'id');
	}
}
