<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Permission;
use Cache;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'username', 'password', 'email', 'fullname', 'level'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	//
	public function socialAccount(){
		return $this->hasOne('App\SocialAccount', 'user_id', 'id');
	}
	public function filmUserTick(){
		return $this->hasMany('App\FilmUserTick', 'user_id', 'id');
	}
	public function filmUserWatch(){
		return $this->hasMany('App\FilmUserWatch', 'user_id', 'id');
	}
	public function userRole(){
		return $this->hasOne('App\UserRole', 'user_id', 'id');
	}
	public function hasPermission($per){
		$user_permission = Cache::get('user_permission_'.Auth::user()->id);
		if(isset($user_permission[$per])){
			return true;
		}
		return false;
	}
}
