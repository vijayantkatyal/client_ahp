<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CheckIsAdmin
{
	public function handle($request, Closure $next)
	{
		$user = Auth::user();

		if ($user) {
			if ($user->isAdmin() || $user->isTeacher() == true || $user->isPrincipal() == true || $user->isBoardMember() == true) {
				return $next($request);
			}
		}
		
		return redirect('/');
		
	}
}