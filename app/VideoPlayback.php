<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPlayback extends Model {

	//
	protected $table = 'video_playbacks';
	protected $fillable = ['id', 'film_id', 'film_source_id', 'src_360p', 'src_480p', 'src_720p', 'src_1080p', 'src_2160p'];
	protected $hidden = ['time', 'config'];
	public $timestamps = false;
	public $incrementing = false; //off increment

}
