<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model {

	//
	protected $table = 'user_roles';
	protected $fillable = ['user_id', 'role_id'];
	public $timestamps = false;
	public $incrementing = false;
	protected $primaryKey = 'user_id';

	public function user(){
		return $this->belongsTo('App\Users', 'user_id', 'id');
	}
	public function role(){
		return $this->belongsTo('App\Role', 'role_id', 'id');
	}
	public function permissionRole(){
		return $this->hasMany('App\PermissionRole', 'role_id', 'id');
	}
	
}
