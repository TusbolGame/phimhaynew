<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmSlider extends Model {

	protected $table = 'film_sliders';
	protected $fillable = ['id', 'film_id'];
	public $timestamps = false;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
}
