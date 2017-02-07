<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmUserDiff extends Model {

	protected $table = 'film_user_diffs';
	protected $fillable = ['id', 'film_ticked', 'film_watched'];
	public $timestamps = false;

}
