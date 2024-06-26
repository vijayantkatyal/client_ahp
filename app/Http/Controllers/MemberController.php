<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Courses;
use App\Models\User;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use Illuminate\Foundation\Bus\DispatchesJobs;
use DateTime;

class MemberController extends Controller
{
	use DispatchesJobs;

	public function getIndex(Request $request)
	{
		return view('member.index');
	}

	// public function postSettingsGeneral(Request $request)
	// {
	// 	try {
	// 		$isValid =  Validator::make($request->all(), [
	// 			'first_name'	=> 'required',
	// 			'last_name'		=> 'required'
	// 		]);

	// 		if ($isValid->fails()) {
	// 			$messages = $isValid->messages();
	// 			return redirect($request->header('Referer'))->withErrors($isValid)->withInput();
	// 		}

	// 		$user = User::find(Auth::id());
	// 		if ($user) {
	// 			$user->first_name = $request->input('first_name');
	// 			$user->last_name = $request->input('last_name');
	// 			$user->save();

	// 			return redirect($request->header('Referer'))->with('status.success', 'Profile Updated.');
	// 		} else {
	// 			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
	// 		}

	// 		return redirect($request->header('Referer'))->with('status.success', 'Settings Updated.');
	// 	} catch (\Exception $ex) {
	// 		return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
	// 	}
	// }

	// public function postSettingsPassword(Request $request)
	// {
	// 	try {
	// 		$isValid =  Validator::make($request->all(), [
	// 			'password'      =>  'required|string|min:6|max:50',
	// 			'password_confirm' =>  'required|string|min:6|max:50|same:password',
	// 		]);
	// 		if ($isValid->fails()) {
	// 			$messages = $isValid->messages();
	// 			return redirect($request->header('Referer'))->withErrors($isValid)->withInput();
	// 		}
	// 		$user = User::find(Auth::id());
	// 		if ($user) {
	// 			$user->password = bcrypt($request->input('password'));
	// 			$user->save();
	// 			return redirect($request->header('Referer'))->with('status.success', 'Password Changed.');
	// 		} else {
	// 			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
	// 		}
	// 	} catch (\Exception $ex) {
	// 		return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
	// 	}
	// }
}
