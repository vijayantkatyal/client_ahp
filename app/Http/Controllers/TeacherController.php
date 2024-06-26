<?php

namespace App\Http\Controllers;

// use Log;

use App\Models\User;
use Mail;
use Session;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

	// dashboard
	public function index(Request $request)
	{
		return view('teacher.index');
	}

	// settings
	public function getSettings(Request $request)
	{
		return view('teacher.settings');
	}

	// teacher settings password (post)
	public function postSettingsPassword(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'password'      =>  'required|string|min:6|max:50',
				'password_confirm' =>  'required|string|min:6|max:50|same:password',
			]);
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_teacher_settings')->withErrors($isValid)->withInput();
			}
			$user = User::find(Auth::id());
			if($user)
			{
				$user->password = bcrypt($request->input('password'));
				$user->save();
				return redirect()->route('get_teacher_settings')->with('status.success', 'Password Changed.');
			}
			else
			{
				return redirect()->route('get_teacher_settings')->with('status.error', 'Something went wrong');
			}
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_teacher_settings')->with('status.error', 'Something went wrong');
		}
	}

}
