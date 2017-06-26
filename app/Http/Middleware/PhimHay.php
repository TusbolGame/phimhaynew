<?php namespace App\Http\Middleware;

use Closure;
// use App\Visit;
use Auth;
use App\Lib\GuestInfo;
use Session;
use App\Permission;
use App\Role;
use Cache;

class PhimHay {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//permission
		// Cache::forget('user_permission_1');	
		//
		if(Auth::check()){
			//is login
			$user_permission = [];
			//
			$role_id = Auth::user()->userRole->role_id;
			//check
			$dk = false;
			$per = Cache::get('user_permission_'.Auth::user()->id);
			//check time role update
			if(!Cache::has('role_updated_at_'.$role_id)){
				$dk = true;
			}else{
				//get role
				$role_expires = Cache::get('role_updated_at_'.$role_id);
				//check time
				if(!empty($role_expires) && isset($per['updated_at'])){
					if ((int)$role_expires > (int)$per['updated_at']) {
						$dk = true;
					}
				}
			}
			//check role is delete
			//when role deleted -> remove cache name role_updated_at_{role_id}
			//check exixts cache
			if(isset($per['role_id'])){
				if(!Cache::has('role_updated_at_'.$per['role_id'])){
					$dk = true;
				}
			}
			//
			if(!Cache::has('user_permission_'.Auth::user()->id) || $dk){
				
				$temp = Permission::whereHas('permissionRole', function($query) use($role_id){
					$query->where('role_id', $role_id);
				})->get();
				$user_permission['role_id'] = $role_id;
				$user_permission['updated_at'] = time();
				foreach ($temp as $key) {
					$user_permission[$key->permission_name] = true;
				}
				Cache::forever('user_permission_'.Auth::user()->id, $user_permission);
			}
		}

		//check session
		// if($request->session()->has('guest_visit')){
		// 	$visit = Visit::findOrFail($request->session()->get('guest_visit'));
		// 	$visit->page_views = $visit->page_views + 1;
		// 	$visit->save();
		// }else{
		// 	// guest info
		// 	$guest_info = new GuestInfo();
		// 	$location = $guest_info->getLocationInfoByIp($request->ip());
		// 	$browser = $guest_info->getBrowser();
		// 	$referer = $guest_info->getHttpReferer();
		// 	//visit
		// 	$visit = new Visit();
		// 	$visit->ip = $request->ip();
		// 	$visit->country = $location['country'];
		// 	$visit->city = $location['city'];
		// 	$visit->user_id = (Auth::check()) ? Auth::user()->id : null;
		// 	$visit->platform = $browser['platform'];
		// 	$visit->browser_name = $browser['browser_name'];
		// 	$visit->version = $browser['version'];
		// 	$visit->referer_host = $referer['host'];
		// 	$visit->page_views = 1;
		// 	$visit->save();
		// 	//add
		// 	$request->session()->put('guest_visit', $visit->id);
		// }
		//
		return $next($request);
	}

}
