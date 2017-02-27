<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}else if ($this->auth->check()){
			if ($this->auth->user()->actived == 1 && $this->auth->user()->blocked == 0 ){
				return $next($request);
			}else if ($this->auth->user()->actived == 1 && $this->auth->user()->blocked == 1 ){
				//call logout
				$this->auth->logout();
				//login
				return redirect()->route('auth.getLogin');
			}
		}
		return $next($request);
	}

}
