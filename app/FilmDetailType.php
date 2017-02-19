<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmDetailType extends Model {

	//
	protected $table = 'film_detail_types';
	protected $fillable = ['id', 'film_id', 'type_id'];
	public $timestamps = false;

	public function filmDetail(){
		return $this->belongsTo('App\FilmDetail', 'film_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
	public function filmType(){
		return $this->belongsTo('App\FilmType', 'type_id', 'id');
	}
}
