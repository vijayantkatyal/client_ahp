<?php

namespace App\Http\Middleware;

use App;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class CheckIsStudent
{
	public function handle($request, Closure $next)
	{
		$user = Auth::user();

		if ($user) {
			if ($user->isStudent()) {
				App::setLocale(Auth::user()->language);
				return $next($request);
			}
		}
		
		return redirect('/');
		
	}
}