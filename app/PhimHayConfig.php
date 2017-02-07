<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PhimHayConfig extends Model {

	protected $table = 'phim_hay_configs';
	protected $fillable = ['id', 'get_link_local', 'get_link_remote_api'];
	public $timestamps = false;

}
