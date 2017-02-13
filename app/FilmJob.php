<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmJob extends Model {

	//
	protected $table = 'film_jobs';
	protected $fillable = ['id', 'job_name'];
	public $timestamps = true;

	public function filmPersonJob(){
		return $this->hasMany('App\FilmPersonJob', 'film_job_id', 'id');
	}
}
