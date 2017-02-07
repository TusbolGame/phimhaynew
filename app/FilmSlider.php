<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmSlider extends Model {

	protected $table = 'film_sliders';
	protected $fillable = ['id', 'slider_name', 'slider_dir', 'slider_image'];
	public $timestamps = true;
}
