<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmPersonJob extends Model {

	protected $table = 'film_person_jobs';
	protected $fillable = ['id', 'film_person_id', 'film_job_id'];
	public $timestamps = false;

	public function filmJob(){
		return $this->belongsTo('App\FilmJob', 'film_job_id', 'id');
	}
	public function filmPerson(){
		return $this->belongsTo('App\FilmJob', 'film_person_id', 'id');
	}

}
