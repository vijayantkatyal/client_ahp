<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Courses;
use App\Models\StudentClass;
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

class StudentController extends Controller
{
	use DispatchesJobs;

	public function getIndex(Request $request)
	{
		$classes = [];
		$get_classes_info = StudentClass::where('student_id', Auth::user()->id)->get();

		foreach ($get_classes_info as $class_info)
		{
			$get_class_info = StudentClass::join('courses', 'student_classes.course_id', '=', 'courses.id')
								->where('student_classes.id', $class_info->id)
								->join('classes', 'student_classes.class_id', '=', 'classes.id')
								->select('classes.id', 'courses.name as course_name', 'classes.name as class_name', 'classes.start_date', 'classes.end_date')
								->first();

			array_push($classes, $get_class_info);
		}

		$attendance = [];

		$class_id = null;

		if($request->filled('class_id'))
		{
			$class_id = $request->input('class_id');
			$attendance = Attendance::where('user_id', Auth::user()->id)->where('class_id', $request->input('class_id'))->get();
		}

		return view('student.index')
			->with('classes', $classes)
			->with('attendance', $attendance)
			->with('class_id', $class_id);
	}

	public function postSettingsGeneral(Request $request)
	{
		try {
			$isValid =  Validator::make($request->all(), [
				'first_name'	=> 'required',
				'last_name'		=> 'required'
			]);

			if ($isValid->fails()) {
				$messages = $isValid->messages();
				return redirect($request->header('Referer'))->withErrors($isValid)->withInput();
			}

			$user = User::find(Auth::id());
			if ($user) {
				$user->first_name = $request->input('first_name');
				$user->last_name = $request->input('last_name');
				$user->save();

				return redirect($request->header('Referer'))->with('status.success', 'Profile Updated.');
			} else {
				return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
			}

			return redirect($request->header('Referer'))->with('status.success', 'Settings Updated.');
		} catch (\Exception $ex) {
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	public function postSettingsPassword(Request $request)
	{
		try {
			$isValid =  Validator::make($request->all(), [
				'password'      =>  'required|string|min:6|max:50',
				'password_confirm' =>  'required|string|min:6|max:50|same:password',
			]);
			if ($isValid->fails()) {
				$messages = $isValid->messages();
				return redirect($request->header('Referer'))->withErrors($isValid)->withInput();
			}
			$user = User::find(Auth::id());
			if ($user) {
				$user->password = bcrypt($request->input('password'));
				$user->save();
				return redirect($request->header('Referer'))->with('status.success', 'Password Changed.');
			} else {
				return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
			}
		} catch (\Exception $ex) {
			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
		}
	}
}
