<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmUserWatch extends Model {

	//
	protected $table = 'film_user_watches';
	protected $fillable = ['id', 'film_id', 'user_id', 'user_viewed'];
	public $timestamps = true;

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
