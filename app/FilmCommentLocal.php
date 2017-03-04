<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmCommentLocal extends Model {

	protected $table = 'film_comment_locals';
	protected $fillable = ['id', 'film_id', 'user_id', 'film_comment_content', 'created_at'];
	public $timestamps = true;

	public function user(){
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
	public function filmList(){
		return $this->belongsTo('App\FilmList', 'film_id', 'id');
	}
}
