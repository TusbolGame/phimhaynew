<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPlayback extends Model {

	//
	protected $table = 'video_playbacks';
	protected $fillable = ['id', 'redirect'];
	protected $hidden = ['time', 'drive_cookie', 'proxy'];
	public $timestamps = false;
	public $incrementing = false; //off increment

}
