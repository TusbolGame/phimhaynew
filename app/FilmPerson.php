<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmPerson extends Model {

	//
	protected $table = 'film_people';
	protected $fillable = ['id', 'actor_name', 'actor_full_name', 'actor_birth_name', 'actor_birth_date', 'actor_nick_name', 'person_height', 'actor_job', 'actor_info', 'actor_image'];
	public $timestamps = true;
	public function filmDirector(){
		return $this->hasMany('App\FilmDirector', 'director_id', 'id');
	}
	public function filmActor(){
		return $this->hasMany('App\FilmActor', 'actor_id', 'id');
	}
	public function filmPersonJob(){
		return $this->hasMany('App\FilmPersonJob', 'film_person_id', 'id');
	}
	
}
