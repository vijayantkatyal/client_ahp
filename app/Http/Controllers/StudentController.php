<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\ClassAssignment;
use App\Models\Classes;
use App\Models\Courses;
use App\Models\StudentAssignment;
use App\Models\StudentAssignmentThread;
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
		$assignments = [];

		$class_id = null;

		if($request->filled('class_id'))
		{
			$class_id = $request->input('class_id');
			$attendance = Attendance::where('user_id', Auth::user()->id)->where('class_id', $request->input('class_id'))->get();

			$assignments = StudentAssignment::where('user_id', Auth::user()->id)->where('class_id', $request->input('class_id'))->get();
			foreach($assignments as $assignment)
			{
				$get_info = ClassAssignment::where('id', $assignment->assignment_id)->first();
				if($get_info)
				{
					$assignment->assignment_name = $get_info->name;
				}
			}
		}

		return view('student.index')
			->with('classes', $classes)
			->with('attendance', $attendance)
			->with('assignments', $assignments)
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

	public function getAssignment(Request $request, $id)
	{
		// get assignment info
		$assignment = StudentAssignment::where('id', $id)->where('user_id', Auth::id())->first();
		if($assignment)
		{
			// class info
			$get_class_info = Classes::where('id', $assignment->class_id)->first();
			if($get_class_info)
			{
				$assignment->class_info = $get_class_info;
				// get assignment thread
			}

			// assignment info
			$get_assignment_info = ClassAssignment::where('id', $assignment->assignment_id)->first();
			if($get_assignment_info)
			{
				$assignment->assignment_info = $get_assignment_info;
			}

			// thread
			$get_assignment_thread = StudentAssignmentThread::where('student_assignment_id', $assignment->id)->where('class_id', $assignment->class_id)->get();
			$assignment->thread = $get_assignment_thread;

			// return $assignment;

			return view('student.assignment')->with('assignment', $assignment);
		}
	}

	public function postAssignmentFile(Request $request)
	{
		$file_to_upload = $request->file('file');
		$file_path = null;

		if($file_to_upload)
		{
			// check size
			// $size = $request->file('file')->getSize();
			// if($size > 2000000)
			// {
			// 	return json_encode("file should not exceed 2mb");
			// }

			$extension = $file_to_upload->getClientOriginalExtension();
			if($extension == "doc" || $extension == "docx" || $extension == "pdf")
			{
				$uniq_id = rand();
				$random_name = $uniq_id.".".$request->file('file')->clientExtension();

				Storage::disk('uploads')->putFileAs('assignments', $request->file('file'), $random_name);
				$file_path = "/uploads/assignments/".$random_name;

				StudentAssignment::where('id', $request->input('assignment_id'))->update([
					'file'	=>	$file_path
				]);

				return redirect($request->header('Referer'))->with('status.success', 'Assignment Uploaded');
			}
			else
			{
				return redirect($request->header('Referer'))->with('status.error', 'UnSupported file');
			}
		}
	}

	public function postAssignmentNote(Request $request)
	{
		StudentAssignment::where('id', $request->input('assignment_id'))->update([
			'note'	=>	$request->input('note')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Assignment Posted');
	}

	public function postAssignmentMessage(Request $request)
	{
		StudentAssignmentThread::insert([
			'student_assignment_id'	=>	$request->input('assignment_id'),
			'class_id'				=>	$request->input('class_id'),
			'user_id'				=>	Auth::id(),
			'message'				=>	$request->input('message'),
			'time'					=>	time()
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Message Sent');
	}
}
