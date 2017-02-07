<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmRelate extends Model {

	protected $table = 'film_relates';
	protected $fillable = ['id', 'film_relate_name'];
	public $timestamps = false;
}
