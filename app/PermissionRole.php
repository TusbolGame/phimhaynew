<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model {

	//
	//
	protected $table = 'permission_roles';
	protected $fillable = ['permission_id', 'role_id'];
	public $timestamps = false;
	public $incrementing = false;
	protected $primaryKey = 'role_id';

	public function permission(){
		return $this->belongsTo('App\Permission', 'permission_id', 'id');
	}
	public function role(){
		return $this->belongsTo('App\Role', 'role_id', 'id');
	}
}
