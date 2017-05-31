<?php namespace App\Http\Middleware;

use Closure;
// use App\Visit;
use Auth;
use App\Lib\GuestInfo;
use Session;

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
