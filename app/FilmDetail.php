<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmDetail extends Model {

	protected $table = 'film_details';
	protected $fillable = ['id', 'film_info', 'film_score_imdb', 'film_score_aw', 'film_release_date', 'film_production_company', 'film_relate_id', 'film_thumbnail_big', 'film_poster_video', 'film_key_words', 'src_youtube_trailer', 'created_at', 'updated_at'];
	public $timestamps = true;

	public function filmList(){
		return $this->hasOne('App\FilmList', 'id', 'id');
	}
	public function filmEpisode(){
		return $this->hasMany('App\FilmEpisode', 'film_id', 'id');
	}
	public function filmDetailCountry(){
		return $this->hasMany('App\FilmDetailCountry', 'film_id', 'id');
	}
	public function filmDetailType(){
		return $this->hasMany('App\FilmDetailType', 'film_id', 'id');
	}
	public function filmRelate(){
		return $this->belongsTo('App\FilmRelate', 'film_relate_id', 'id');
	}
	public function getFilmThumbnailBig(){
		if(substr($this->film_thumbnail_big, 0, 4) == 'http') {
			return $this->film_thumbnail_big;
		}
		return url('resources/phim/poster/'.$this->film_thumbnail_big);
	}
	public function getFilmPosterVideo(){
		if(substr($this->film_poster_video, 0, 4) == 'http') {
			return $this->film_poster_video;
		}
		return url('resources/phim/poster/'.$this->film_poster_video);
	}
}
