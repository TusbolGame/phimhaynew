<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmUserTick extends Model {

	//
	protected $table = 'film_user_ticks';
	protected $fillable = ['id', 'film_id', 'user_id'];
	public $timestamps = false;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
	public function user(){
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

}
