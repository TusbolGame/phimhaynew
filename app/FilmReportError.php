<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmReportError extends Model {

	//
	protected $table = 'film_report_errors';
	protected $fillable = ['id', 'report_error_name', 'report_error_status', 'film_id', 'user_id'];
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
