<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	//
	protected $table = 'roles';
	protected $fillable = ['role_name', 'role_description'];
	public $timestamps = true;


	public function userRole(){
		return $this->hasMany('App\UserRole', 'role_id', 'id');
	}
	public function permissionRole(){
		return $this->hasMany('App\PermissionRole', 'role_id', 'id');
	}
	// public function permission(){
	// 	return $this->hasManyThrough('App\Permission', 'App\PermissionRole', 'role_id', 'id', 'permission_id');
	// }
}
