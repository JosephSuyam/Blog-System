<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccess
{
/**
* Handle an incoming request.
*
* @param  \Illuminate\Http\Request  $request
* @param  \Closure  $next
* @return mixed
*/
	public function handle($request, Closure $next)
	{
		$user_stuff = auth()->user();
		$access = $user_stuff->access;
		if($access==2){

		}else{
			// return abort(404);
			return redirect()->to('users/home')->with('message', 'You are not allowed to access that site');
		}
		return $next($request);
	}
}
