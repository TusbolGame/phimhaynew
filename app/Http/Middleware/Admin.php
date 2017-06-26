<?php namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;

class Admin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//is admin
		// if(Auth::check() && Auth::user()->level == 1){
		if(Auth::check()){
			$user_permission = Cache::get('user_permission_'.Auth()->user()->id);
			if(isset($user_permission['accessAdmin'])){
				return $next($request);
			}
			
		}
		// return redirect('/');
		return response()->view('phimhay.include.403', [], 403);
	}

}
