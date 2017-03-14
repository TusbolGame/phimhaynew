<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model {

	//
	protected $table = 'visits';
	protected $fillable = ['id', 'ip', 'country', 'city', 'user_id', 'platform', 'browser_name', 'version', 'referer_host', 'page_views'];
	public $timestamps = true;
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
