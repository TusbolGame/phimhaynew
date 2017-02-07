<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmLanguage extends Model {

	protected $table = 'film_languages';
	protected $fillable = ['id', 'film_language_name'];
	public $timestamps = false;

}
