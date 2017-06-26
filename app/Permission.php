<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

	//
	protected $table = 'permissions';
	protected $fillable = ['permission_name', 'permission_description'];
	public $timestamps = true;

	public function permissionRole(){
		return $this->hasMany('App\PermissionRole', 'permission_id', 'id');
	}
}
