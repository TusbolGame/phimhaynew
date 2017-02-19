<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmType extends Model {

	//
	protected $table = 'film_types';
	protected $fillable = ['id', 'type_name', 'type_alias'];
	public $timestamps = true;

	public function filmDetailType(){
		return $this->hasMany('App\FilmDetailType', 'type_id', 'id');
	}
}
