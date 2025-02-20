<?php

namespace App\Http\Controllers;

use App\Jobs\MailSend_Direct;
use App\Jobs\MailSend_SignUp;
use App\Jobs\SaveEmbedding;
use App\Libraries\CaptionsData;
use App\Models\Attendance;
use App\Models\CalendarDirector;
use App\Models\CalendarSchool;
use App\Models\ClassAssignment;
use App\Models\Classes;
use App\Models\ClassResource;
use App\Models\Courses;
use App\Models\CustomProperties;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Mail;

use Config;

use Illuminate\Support\Facades\Cookie;
use App\Models\VideoSite;
use App\Models\VideoPage;
use App\Models\Video;
use App\Models\VideoReactions;
use App\Models\Domain;
use App\Models\FieldAttendance;
use App\Models\FormMembership;
use App\Models\FormRegistration;
use App\Models\Levels;
use App\Models\Message;
use App\Models\Page;
use App\Models\Post;
use App\Models\SchoolEventPhotos;
use App\Models\SchoolEvents;
use App\Models\Site;
use App\Models\StudentAssignment;
use App\Models\StudentAssignmentThread;
use App\Models\StudentClass;
use App\Models\Terms;
use App\Models\User as ModelsUser;
use App\Models\VidChapterProject;
use Google\Service\StreetViewPublish\Level;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // dashboard
	public function index(Request $request)
	{
		// return redirect()->route('get_admin_users_index');
		return view('admin.index');
	}

	public function postLogout(Request $request)
    {
		$login_type = "user";
		$login_url = "/login";

		if($request->has('login_type'))
		{
			$login_type = $request->input('login_type');
		}
		
		if($login_type == "user")
		{
			$login_url = "/login";
		}
		if($login_type == "admin")
		{
			$login_url = "/login";
		}

        Session::flush();
        return redirect($login_url);
    }

	// users
	public function getUsers(Request $request)
	{
		$admin_accounts = config('isotopekit_admin.account_list');
		$plans = Levels::where('id', '!=', '1')->get();
		$users = \App\Models\User::whereNotIn('id', $admin_accounts)->select('id','first_name', 'last_name', 'email', 'enabled', 'created_at', 'created_by', 'phone')->orderByDesc('id')->get();

		$filter = "All";

		if($request->filter)
		{
			// board_members
			if($request->filter == "board_members")
			{
				$filter = "Board Member(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '2')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.profile_pic', 'users.phone')->orderByDesc('id')->get();
			}

			// principals
			if($request->filter == "principals")
			{
				$filter = "Principal(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '3')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.phone')->orderByDesc('id')->get();
			}
			
			// teachers
			if($request->filter == "teachers")
			{
				$filter = "Teacher(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '4')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.phone')->orderByDesc('id')->get();
			}

			// students
			if($request->filter == "students")
			{
				$filter = "Student(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '5')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.phone')->orderByDesc('id')->get();
			}

			// members
			if($request->filter == "members")
			{
				$filter = "Member(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '6')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.phone')->orderByDesc('id')->get();
			}
		}

		// return $users;

		foreach($users as $user)
		{
			$user->plan_name = null;
			$user->owner_details = null;
			$user->agency_details = null;

			// get user level
			$fetch_roles = \App\Models\User_Role::where('user_id', '=', $user->id)->first();
			if($fetch_roles)
			{
				if(json_decode($fetch_roles->levels) != null && json_decode($fetch_roles->levels) != "")
				{
					if(array_key_exists(1, json_decode($fetch_roles->levels)))
					{
						$get_level_id = json_decode($fetch_roles->levels)[1];
						$level_info = Levels::where('id', $get_level_id)->first();
						if($level_info)
						{
							$user->plan_name = $level_info->name;
						}
					}
				}
			}

			$user->classes = [];

			// add class info
			if($request->filter == "students")
			{
				$user_classes = [];

				$classes_info = StudentClass::where('student_id', $user->id)->get();
				foreach ($classes_info as $class_info)
				{
					$get_class_info = Classes::where('id', $class_info->class_id)->first();
					$class_item_info = $get_class_info->name." (".$get_class_info->start_date." - ".$get_class_info->end_date.")";
					array_push($user_classes, $class_item_info);
				}

				$user->classes = $user_classes;
			}
		}

		// return $users;

		$classes = Classes::join('courses', 'classes.course_id', '=', 'courses.id')
					->select('classes.id', 'courses.name as course_name', 'classes.name', 'classes.start_date', 'classes.end_date', 'courses.id as course_id')
					->get();

		// return $classes;

		return view('admin.users.index')
				->with('filter', $filter)	
				->with('plans', $plans)
				->with('users', $users)
				->with('classes', $classes);
	}

	// add user (post)
	public function postAddUser(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'first_name'    =>  'required|string|min:3',
                'last_name'     =>  'required|string|min:3',
                'email'         =>  'required|string|email|min:5|max:50|unique:users',
                'password'      =>  'required|string|min:6|max:20',
                'plan_id'       =>  'required'
			]);
			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_users_index', ['mode'	=>	'user_add'])->withErrors($isValid)->withInput();
			}

			$random_text_generator = new \IsotopeKit\Utility\RandomTextGenerator();
			$random_token = $random_text_generator->get_random_value_in_string(20);

			// create account
			$user = \App\Models\User::create([
				'first_name'    =>  $request->input('first_name'),
				'last_name'     =>  $request->input('last_name'),
				'email'         =>  $request->input('email'),
				'password'      =>  bcrypt($request->input('password')),
				'email_token'   =>  $random_token,
				'enabled'       =>  true
			]);

			$plan_id = json_encode($request->input('plan_id'));
			// save role
			$save_role = \App\Models\User_Role::create([
				'user_id'	=>	$user->id,
				'levels'    => '["1",'.$plan_id.']', // by default user with 'basic' plan
			]);
			
			// $app_library = new \App\Libraries\Utility();
			// $res = $app_library->send_email_agency_generic($request->input('first_name'), $request->input('email'), $request->input('password'), 0);

			if($user)
			{
				// send signup email
                MailSend_SignUp::dispatch($user->id);

				$get_site_settings = Site::where('id', '1')->first();
				if($get_site_settings != null)
				{
					$site_settings = $get_site_settings;
				}

				$data = [
					'email' =>  $request->input('email'),
					'name'  =>  $request->input('first_name'),
					'password'  =>  $request->input('password'),
					'app_name'	=>	$site_settings->name,
					'app_domain'	=>	$site_settings->external_url
				];

				$emails_to = array(
					'email' => $request->input('email'),
					'name' => $request->input('first_name'),
					'subject'	=>	config('isotopekit_admin.mail_subject')
				);

				Config::set('mail.encryption',$site_settings->encryption);
				Config::set('mail.host', $site_settings->host);
				Config::set('mail.port', $site_settings->port);
				Config::set('mail.username', $site_settings->username);
				Config::set('mail.password', $site_settings->password);
				Config::set('mail.from',  ['address' => $site_settings->from_address , 'name' => $site_settings->from_name]);
				
				// Mail::send('emails.welcome', $data, function($message) use ($emails_to)
				// {
				// 	$message->to($emails_to['email'], $emails_to['name'])->subject($emails_to['subject']);
				// });
			}

			return redirect($request->header('Referer'))->with('status.success', 'User Created.');
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong, try again later');

		}
	}

	// edit user
	public function getEditUser(Request $request, $id)
	{
		$user = \App\Models\User::find($id);
		if($user)
		{
			$plans = Levels::where('id', '!=', '1')->get();
			$user_plan = \App\Models\User_Role::where('user_id', $id)->first();
			$plan_id = null;
			if($user_plan != null)
			{
				$levels = json_decode($user_plan->levels);
				if($levels != null)
				{
					if(array_key_exists(1, $levels))
					{
						$plan_id = $levels[1];

						$user->plan_name = null;
						$level_info = Levels::where('id', $plan_id)->first();
						if($level_info)
						{
							$user->plan_name = $level_info->name;

							if($user->plan_name == "Student")
							{
								$classes = [];
								$get_classes_info = StudentClass::where('student_id', $id)->get();

								foreach ($get_classes_info as $class_info)
								{
									// course name
									// class name
									// $get_class_info = Classes::join('courses', 'classes.course_id', '=', 'courses.id')->select('classes.id', 'classes.name', 'classes.start_date', 'classes.end_date', 'courses.name as course_name')->first();

									$get_class_info = StudentClass::join('courses', 'student_classes.course_id', '=', 'courses.id')
														->where('student_classes.id', $class_info->id)
														->join('classes', 'student_classes.class_id', '=', 'classes.id')
														->select('student_classes.id', 'courses.name as course_name', 'classes.name as class_name', 'classes.start_date', 'classes.end_date')
														->first();

									array_push($classes, $get_class_info);
									
								}

								$user->classes_info = $classes;
							}
						}
					}
				}
			}

			// return $user->classes_info;

			$courses = Courses::get();
			$classes = Classes::where('course_id', $user->course_id)->get();

			return view('admin.users.edit')
				->with('user', $user)->with('plans', $plans)
				->with('plan_id', $plan_id)
				->with('courses', $courses)
				->with('classes', $classes);
		}
		else
		{
			return view('errors.404');
		}
	}

	// update user (post)
	public function postEditUser(Request $request, $id)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'first_name'    =>  'required|string|min:3',
				'last_name'     =>  'required|string|min:3',
				'email'         =>  'required|string|email|min:5|max:50|unique:users,email,'.$id,
				'plan_id'       =>  'required'
			]);

			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->withErrors($isValid)->withInput();
			}

			$user = \App\Models\User::find($id);
			if($user)
			{
				$user->first_name = $request->input('first_name');
				$user->last_name = $request->input('last_name');
				$user->email = $request->input('email');
				$user->phone = $request->input('phone');
				$user->save();

				$user_role = \App\Models\User_Role::where('user_id', $id)->first();
				if($user_role)
				{
					$user_role->levels = '["1",'.json_encode($request->input('plan_id')).']';
					$user_role->save();
				}
				else
				{
					$user_role = \App\Models\User_Role::create([
						'user_id'	=>	$id,
						'levels'    => '["1",'.json_encode($request->input('plan_id')).']',
					]);
				}
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.success', 'User Updated.');
			}
			else
			{
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
			}
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
		}
	}

	// post edit user pic
	public function postEditUserPic(Request $request)
	{

		\App\Models\User::where('id', $request->input('user_id'))->update([
			'title'			=>	$request->input('title'),
			'description'	=>	$request->input('description')
		]);

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
			if($extension == "png" || $extension == "jpeg" || $extension == "jpg")
			{
				$uniq_id = rand();
				$random_name = $uniq_id.".".$request->file('file')->clientExtension();

				Storage::disk('uploads')->putFileAs('profile', $request->file('file'), $random_name);
				$file_path = "/uploads/profile/".$random_name;

				\App\Models\User::where('id', $request->input('user_id'))->update([
					'profile_pic'	=>	$file_path
				]);

				return redirect($request->header('Referer'))->with('status.success', 'Changes Saved');
			}
			else
			{
				return redirect($request->header('Referer'))->with('status.error', 'UnSupported file');
			}
		}

		return redirect($request->header('Referer'))->with('status.success', 'Changes Saved');
	}

	// post edit user pic
	public function postEditUserHourlyRate(Request $request)
	{

		\App\Models\User::where('id', $request->input('user_id'))->update([
			'hourly_rate'	=>	$request->input('hourly_rate')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Changes Saved');
	}

	public function postChangeUserBonus(Request $request, $id)
	{
		try
		{
			$user = \App\Models\User::find($id);
			if($user)
			{
				$custom_property = [];
				$custom_properties_id = $request->input('custom_properties_id');
				$custom_properties_value = $request->input('custom_properties_value');
				foreach ($custom_properties_id as $key => $val) {
					$item = [
						"id"	=>	$val,
						"value"	=>	$custom_properties_value[$key]
					];
					array_push($custom_property, $item);
				}

				\App\Models\User::where('id', $id)->update([	
					// branding
					'remove_branding'	=>	$request->input('remove_branding'),
					'custom_branding'	=>	$request->input('custom_branding'),

					// team
					'enable_team'	=>	$request->input('enable_team'),
					'team_members'	=>	$request->input('team_members'),

					// custom domains
					'enable_custom_domains'	=>	$request->input('enable_custom_domains'),
					'custom_domains'	=>	$request->input('custom_domains'),

					'custom_properties'		=>	json_encode($custom_property)
				]);
				
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.success', 'Bonus Settings Updated.');

			}
			else
			{
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
			}
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
		}
	}

	// change user password (post)
	public function postChangeUserPassword(Request $request, $id)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'password'      =>  'required|string|min:6|max:50',
				'password_confirm' =>  'required|string|min:6|max:50|same:password',
			]);
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->withErrors($isValid)->withInput();
			}
			$user = \App\Models\User::find($id);
			if($user)
			{
				$user->password = bcrypt($request->input('password'));
				$user->save();
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.success', 'Password Changed.');
			}
			else
			{
				return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
			}
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
		}
	}

	// change user status
	public function postChangeUserStatus(Request $request, $id)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'enabled'	=> 'required|boolean'
			]);

			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
			}

			\App\Models\User::where('id', $id)->update([
				'enabled'	=>	$request->input('enabled')
			]);

			if($request->input('enabled') == true)
			{
				return redirect($request->header('Referer'))->with('status.success', 'User now Active.');
			}
			else
			{
				return redirect($request->header('Referer'))->with('status.error', 'User now Inactive.');
			}

		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	// delete user (post)
	public function postDeleteUser(Request $request, $id)
	{
		try
		{
			\App\Models\User::where('id', $id)->delete();
			return redirect($request->header('Referer'))->with('status.success', 'User Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	// delete multiple user (post)
	public function postDeleteMultipleUser(Request $request)
	{
		try
		{
			$user_ids = $request->input("users_id");
			$user_ids = explode(",", $user_ids);

			foreach($user_ids as $id)
			{
				\App\Models\User::where('id', $id)->delete();
			}
			
			return redirect($request->header('Referer'))->with('status.success', 'Users Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	// disable multiple user (post)
	public function postDisableMultipleUser(Request $request)
	{
		try
		{
			$user_ids = $request->input("users_id");
			$user_ids = explode(",", $user_ids);

			foreach($user_ids as $id)
			{
				\App\Models\User::where('id', $id)->update([
					'enabled'	=>	false
				]);
			}
			
			return redirect($request->header('Referer'))->with('status.success', 'Users Disabled.');
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	// change plans of multiple users
	public function postPlanMultipleUser(Request $request)
	{
		try
		{
			$user_ids = $request->input("users_id");
			$user_ids = explode(",", $user_ids);

			foreach($user_ids as $id)
			{
				$user_role = \App\Models\User_Role::where('user_id', $id)->first();
				if($user_role)
				{
					$user_role->levels = '["1",'.json_encode($request->input('new_plan_id')).']';
					$user_role->save();
				}
				else
				{
					$user_role = \App\Models\User_Role::create([
						'user_id'	=>	$id,
						'levels'    => '["1",'.json_encode($request->input('new_plan_id')).']',
					]);
				}
			}
			
			return redirect($request->header('Referer'))->with('status.success', 'Users Plan Updated.');
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	// access user (post)
	public function postAccessUser(Request $request, $id)
	{
		Auth::loginUsingId($id);
		return redirect('/user/');
	}

	// reset user (post)
	public function postResetUser(Request $request, $id)
	{
		try
		{
			$user = \App\Models\User::where('id', $id)->first();

			if($user)
			{
				$random_text_generator = new \IsotopeKit\Utility\RandomTextGenerator();
				$new_password = $random_text_generator->get_random_value_in_string(12);
			
				$user->password = bcrypt($new_password);
				$user->save();

				$get_site_settings = Site::where('id', '1')->first();
				if($get_site_settings != null)
				{
					$site_settings = $get_site_settings;
				}

				$data = [
					'email' =>  $user->email,
					'name'  =>  $user->first_name,
					'password'  =>  $new_password,
					'app_name'	=>	$site_settings->name,
					'app_domain'	=>	$site_settings->external_url
				];

				$emails_to = array(
					'email'	=> $user->email,
					'name'	=> $user->first_name,
					'subject'	=>	config('isotopekit_admin.mail_subject')
				);

				Config::set('mail.encryption',$site_settings->encryption);
				Config::set('mail.host', $site_settings->host);
				Config::set('mail.port', $site_settings->port);
				Config::set('mail.username', $site_settings->username);
				Config::set('mail.password', $site_settings->password);
				Config::set('mail.from',  ['address' => $site_settings->from_address , 'name' => $site_settings->from_name]);
				
				Mail::send('emails.welcome', $data, function($message) use ($emails_to)
				{
					$message->to($emails_to['email'], $emails_to['name'])->subject($emails_to['subject']);
				});

				return redirect('/admin/users')->with('status.success', 'Email with credentials sent.');
			}
			else
			{
				return redirect($request->header('Referer'))->with('status.error', 'User Not Found.');
			}
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong, try again later');
		}
	}

	// custom domains
	public function getDomains(Request $request)
	{
		$domains = Domains::get();
		return view('admin.domains.index')->with('domains', $domains);
	}

	// agency domains
	public function getAgencyDomains(Request $request)
	{
		$domains = \App\Models\User::where('external_url', '!=', null)->where('id', '!=', 1)->get();
		return view('admin.domains.agency')->with('domains', $domains);
	}

	public function getDomainsCheckAll(Request $request)
	{
		$domains = Domains::where('checked', false)->orWhere('checked', null)->get();
		
		foreach($domains as $domain_info)
		{
			if($domain_info == null)
			{
				continue;
			}

			try
			{
				$doamin_verification = new \IsotopeKit\Utility\Domain($domain_info->url, config('isotopekit_admin.ip'));
				
				$domain_status = $doamin_verification->verify();

				if($domain_status == "managed_by_cloudflare")
				{
					// return "managed by cloudflare";
					Domains::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	false,
						'is_secured'	=>	true
					]);

					continue;
				}

				if($domain_status == "not_pointing_to_ip")
				{
					// return "not pointing to correct IP";
					Domains::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	true,
						'is_secured'	=>	false
					]);

					continue;
				}

				if($domain_status == "ssl_enabled")
				{
					// return "now secured";
					Domains::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	false,
						'is_secured'	=>	true
					]);
					
					continue;
				}

				if($domain_status == "already_secured")
				{
					// return "already secured";
					Domains::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	false,
						'is_secured'	=>	true
					]);
					
					continue;
				}

				if($domain_status == "something_went_wrong")
				{
					// return "something went wrong";
					Domains::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	true,
						'is_secured'	=>	false
					]);
					
					continue;
				}
			}
			catch(\Exception $ex)
			{
				continue;
			}
		}

		return redirect($request->header('Referer'))->with('status.success', 'All Domains checked');
	}

	public function getDomainsCheck($id, Request $request)
	{
		
		// check domain info exists in database
		$domain_info = Domains::where('id', $id)->first();
		if($domain_info == null)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Domain not found');
		}

		try
		{
			$doamin_verification = new \IsotopeKit\Utility\Domain($domain_info->url, config('isotopekit_admin.ip'));
			$domain_status = $doamin_verification->verify();

			if($domain_status == "managed_by_cloudflare")
			{
				// return "managed by cloudflare";
				Domains::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	false,
					'is_secured'	=>	true
				]);
				return redirect($request->header('Referer'))->with('status.error', 'Cloudflare Managed Domain: '. $domain_info->url);
			}

			if($domain_status == "not_pointing_to_ip")
			{
				// return "not pointing to correct IP";
				Domains::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	true,
					'is_secured'	=>	false
				]);
				return redirect($request->header('Referer'))->with('status.error', 'A Record not exists or incorrect for domain: '. $domain_info->url);
			}

			if($domain_status == "ssl_enabled")
			{
				// return "now secured";
				Domains::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	false,
					'is_secured'	=>	true
				]);
				return redirect($request->header('Referer'))->with('status.success', 'SSL Enabled for Domain: '. $domain_info->url);
			}

			if($domain_status == "already_secured")
			{
				// return "already secured";
				Domains::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	false,
					'is_secured'	=>	true
				]);
				return redirect($request->header('Referer'))->with('status.success', 'Already Secured Domain: '. $domain_info->url);
			}

			if($domain_status == "something_went_wrong")
			{
				// return "something went wrong";
				Domains::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	true,
					'is_secured'	=>	false
				]);
				return redirect($request->header('Referer'))->with('status.error', 'Unable to Secure Domain: '. $domain_info->url);
			}
		}
		catch(\Exception $ex)
		{
			Domains::where('id', $id)->update([
				'checked'		=>	true,
				'has_error'		=>	true,
				'is_secured'	=>	false
			]);
			return redirect($request->header('Referer'))->with('status.error', 'Unable to Secure Domain: '. $domain_info->url);
		}
	}

	public function getAgencyDomainsCheck($id, Request $request)
	{
		
		// check domain info exists in database
		$domain_info = Site::where('id', $id)->first();
		if($domain_info == null)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Domain not found');
		}

		try
		{
			$doamin_verification = new \IsotopeKit\Utility\Domain($domain_info->external_url, config('isotopekit_admin.ip'));
			$domain_status = $doamin_verification->verify();

			if($domain_status == "managed_by_cloudflare")
			{
				// return "managed by cloudflare";
				Site::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	false,
					'is_secured'	=>	true
				]);
				return redirect($request->header('Referer'))->with('status.error', 'Cloudflare Managed Domain: '. $domain_info->external_url);
			}

			if($domain_status == "not_pointing_to_ip")
			{
				// return "not pointing to correct IP";
				Site::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	true,
					'is_secured'	=>	false
				]);
				return redirect($request->header('Referer'))->with('status.error', 'A Record not exists or incorrect for domain: '. $domain_info->external_url);
			}

			if($domain_status == "ssl_enabled")
			{
				// return "now secured";
				Site::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	false,
					'is_secured'	=>	true
				]);
				return redirect($request->header('Referer'))->with('status.success', 'SSL Enabled for Domain: '. $domain_info->external_url);
			}

			if($domain_status == "already_secured")
			{
				// return "already secured";
				Site::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	false,
					'is_secured'	=>	true
				]);
				return redirect($request->header('Referer'))->with('status.success', 'Already Secured Domain: '. $domain_info->external_url);
			}

			if($domain_status == "something_went_wrong")
			{
				// return "something went wrong";
				Site::where('id', $id)->update([
					'checked'		=>	true,
					'has_error'		=>	true,
					'is_secured'	=>	false
				]);
				return redirect($request->header('Referer'))->with('status.error', 'Unable to Secure Domain: '. $domain_info->external_url);
			}
		}
		catch(\Exception $ex)
		{
			Site::where('id', $id)->update([
				'checked'		=>	true,
				'has_error'		=>	true,
				'is_secured'	=>	false
			]);
			return redirect($request->header('Referer'))->with('status.error', 'Unable to Secure Domain: '. $domain_info->external_url);
		}
	}

	public function getAgencyDomainsCheckAll(Request $request)
	{
		$domains = Site::where('checked', false)->orWhere('checked', null)->get();
		
		foreach($domains as $domain_info)
		{
			if($domain_info == null)
			{
				continue;
			}

			try
			{
				$doamin_verification = new \IsotopeKit\Utility\Domain($domain_info->external_url, config('isotopekit_admin.ip'));
				
				$domain_status = $doamin_verification->verify();

				if($domain_status == "managed_by_cloudflare")
				{
					// return "managed by cloudflare";
					Site::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	false,
						'is_secured'	=>	true
					]);

					continue;
				}

				if($domain_status == "not_pointing_to_ip")
				{
					// return "not pointing to correct IP";
					Site::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	true,
						'is_secured'	=>	false
					]);

					continue;
				}

				if($domain_status == "ssl_enabled")
				{
					// return "now secured";
					Site::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	false,
						'is_secured'	=>	true
					]);
					
					continue;
				}

				if($domain_status == "already_secured")
				{
					// return "already secured";
					Site::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	false,
						'is_secured'	=>	true
					]);
					
					continue;
				}

				if($domain_status == "something_went_wrong")
				{
					// return "something went wrong";
					Site::where('id', $domain_info->id)->update([
						'checked'		=>	true,
						'has_error'		=>	true,
						'is_secured'	=>	false
					]);
					
					continue;
				}
			}
			catch(\Exception $ex)
			{
				continue;
			}
		}
		
		return redirect($request->header('Referer'))->with('status.success', 'All Domains checked');
	}

	public function getDomainsRefresh(Request $request)
	{
		exec("sudo apache2ctl graceful");
		// return "all new domains scheduled for activation";
		return redirect($request->header('Referer'))->with('status.success', 'All new domains scheduled for activation');
	}

	// plans
	public function getPlans(Request $request)
	{
		// get all levels except admin level (id: 1)
		$levels = Levels::where('id','!=',1)->get();
		return view('admin.plans.index')->with('plans', $levels);
	}

	// plan schema
	public function getPlanSchema(Request $request)
	{
		$custom_properties = CustomProperties::get();
		return view('admin.plans.schema')->with('custom_properties', $custom_properties);
	}

	public function postPlanSchema(Request $request)
	{
		// return json_encode($request->all());

		try
		{
			$isValid =  Validator::make($request->all(), [
				'name'    			=> 'required|string',
				'unique_name'     	=> 'required|alpha_dash|string|unique:custom_properties',
				'type'				=> 'required|string',
				'agency_enabled'	=>	'required'
			]);
			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_plans_schema')->withErrors($isValid)->withInput();
			}

			CustomProperties::insert([
				'name'				=>	$request->input('name'),
				'unique_name'		=>	$request->input('unique_name'),
				'type'				=>	$request->input('type'),
				'agency_enabled'	=>	$request->input('agency_enabled')
			]);

			return redirect()->route('get_admin_plans_schema')->with('status.success', 'Plans Schema Updated.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_plans_schema')->with('status.error', 'Something went wrong, try again later');
		}
	}

	public function getDeletePlanSchema(Request $request, $id)
	{
		try
		{
			CustomProperties::where('id', $id)->delete();
			return redirect()->route('get_admin_plans_schema')->with('status.success', 'Custom Property Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_plans_schema')->with('status.error', 'Something Went Wrong');
		}

	}

	// add plan
	public function getAddPlan(Request $request)
	{
		$custom_properties = CustomProperties::get();
		return view('admin.plans.add')->with('custom_properties', $custom_properties);
	}

	// add plan (post)
	public function postAddPlan(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'name'    		=> 'required|string',
				'price'     		=> 'required|string',
				'valid_time'	=> 'required|string'
			]);
			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_plans_add')->withErrors($isValid)->withInput();
			}

			$custom_property = [];
			$custom_properties_id = $request->input('custom_properties_id');
			$custom_properties_value = $request->input('custom_properties_value');
			if($custom_properties_id)
			{
				foreach ($custom_properties_id as $key => $val) {
					$item = [
						"id"	=>	$val,
						"value"	=>	$custom_properties_value[$key]
					];
					array_push($custom_property, $item);
				}
			}

			$agency_custom_property = [];
			$agency_custom_properties_id = $request->input('agency_custom_properties_id');
			$agency_custom_properties_value = $request->input('agency_custom_properties_value');

			if($custom_properties_id)
			{
				foreach ($agency_custom_properties_id as $key => $val) {
					$item = [
						"id"	=>	$val,
						"value"	=>	$agency_custom_properties_value[$key]
					];
					array_push($agency_custom_property, $item);
				}
			}

			Levels::insert([
				'name'			=>	$request->input('name'),
				'price'			=>	$request->input('price'),
				'enabled'		=>	$request->input('enabled'),
				'valid_time'	=>	$request->input('valid_time'),

				// branding
				'remove_branding'	=>	$request->input('remove_branding'),
				'custom_branding'	=>	$request->input('custom_branding'),

				// team
				'enable_team'	=>	$request->input('enable_team'),
				'team_members'	=>	$request->input('team_members'),

				// custom domains
				'enable_custom_domains'	=>	$request->input('enable_custom_domains'),
				'custom_domains'	=>	$request->input('custom_domains'),

				// agency
				'enable_agency'		=>	$request->input('enable_agency'),
				'agency_members'	=>	$request->input('agency_members'),

				// agency team
				'agency_enable_team'	=>	$request->input('agency_enable_team'),
				'agency_team_members'	=>	$request->input('agency_team_members'),

				// agency custom domains
				'agency_enable_custom_domains'	=>	$request->input('agency_enable_custom_domains'),
				'agency_custom_domains'			=>	$request->input('agency_custom_domains'),

				'custom_properties'		=>	json_encode($custom_property),
				'agency_custom_properties'		=>	json_encode($agency_custom_property)
			]);

			return redirect()->route('get_admin_plans_index')->with('status.success', 'Plan Created.');
		}
		catch(\Exception $ex)
		{
			return $ex;
			return redirect()->route('get_admin_plans_add')->with('status.error', 'Something went wrong, try again later');
		}
	}

	// edit plan
	public function getEditPlan(Request $request, $id)
	{
		$custom_properties = CustomProperties::get();
		$plan = Levels::find($id);
		if($plan)
		{
			return view('admin.plans.edit')->with('plan', $plan)->with('custom_properties', $custom_properties);
		}
		else
		{
			return view('errors.404');
		}
	}
	
	// edit plan (post)
	public function postEditPlan(Request $request, $id)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'name'    		=> 'required|string',
				'price'     	=> 'required|string',
				'valid_time'	=> 'required|string'
			]);

			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_plans_edit', ['id' => $id])->withErrors($isValid)->withInput();
			}

			$custom_property = [];
			$custom_properties_id = $request->input('custom_properties_id');
			$custom_properties_value = $request->input('custom_properties_value');
			foreach ($custom_properties_id as $key => $val) {
				$item = [
					"id"	=>	$val,
					"value"	=>	$custom_properties_value[$key]
				];
				array_push($custom_property, $item);
			}

			$agency_custom_property = [];
			$agency_custom_properties_id = $request->input('agency_custom_properties_id');
			$agency_custom_properties_value = $request->input('agency_custom_properties_value');
			foreach ($agency_custom_properties_id as $key => $val) {
				$item = [
					"id"	=>	$val,
					"value"	=>	$agency_custom_properties_value[$key]
				];
				array_push($agency_custom_property, $item);
			}

			Levels::where('id', $id)->update([
				'name'			=>	$request->input('name'),
				'price'			=>	$request->input('price'),
				'enabled'		=>	$request->input('enabled'),
				'valid_time'	=>	$request->input('valid_time'),

				// branding
				'remove_branding'	=>	$request->input('remove_branding'),
				'custom_branding'	=>	$request->input('custom_branding'),

				// team
				'enable_team'	=>	$request->input('enable_team'),
				'team_members'	=>	$request->input('team_members'),

				// custom domains
				'enable_custom_domains'	=>	$request->input('enable_custom_domains'),
				'custom_domains'	=>	$request->input('custom_domains'),

				// agency
				'enable_agency'		=>	$request->input('enable_agency'),
				'agency_members'	=>	$request->input('agency_members'),

				// agency team
				'agency_enable_team'	=>	$request->input('agency_enable_team'),
				'agency_team_members'	=>	$request->input('agency_team_members'),

				// agency custom domains
				'agency_enable_custom_domains'	=>	$request->input('agency_enable_custom_domains'),
				'agency_custom_domains'			=>	$request->input('agency_custom_domains'),

				'custom_properties'		=>	json_encode($custom_property),
				'agency_custom_properties'		=>	json_encode($agency_custom_property)
			]);

			return redirect()->route('get_admin_plans_index')->with('status.success', 'Plan Updated.');

		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_plans_edit', ['id' => $id])->with('status.error', 'Something went wrong, try again later');
		}
	}

	// change plan status
	public function postChangePlanStatus(Request $request, $id)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'enabled'	=> 'required|boolean'
			]);

			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_plans_index')->with('status.error', 'Something Went Wrong');
			}

			Levels::where('id', $id)->update([
				'enabled'	=>	$request->input('enabled')
			]);

			if($request->input('enabled') == true)
			{
				return redirect()->route('get_admin_plans_index')->with('status.success', 'Plan now Active.');
			}
			else
			{
				return redirect()->route('get_admin_plans_index')->with('status.error', 'Plan now Inactive.');
			}

		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_plans_index')->with('status.error', 'Something Went Wrong');
		}
	}

	// delete plan (post)
	public function postDeletePlan(Request $request, $id)
	{
		try
		{
			Levels::where('id', $id)->delete();
			return redirect()->route('get_admin_plans_index')->with('status.success', 'Plan Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_plans_index')->with('status.error', 'Something Went Wrong');
		}
	}


	// settings
	public function getSettings(Request $request)
	{
		$site_settings = Site::first();
		return view('admin.settings')->with('settings', $site_settings);
	}

	// admin settings general (post)
	public function postSettingsGeneral(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'name'			=> 'required',
				'language'		=> 'required',
				'theme'			=> 'required'
			]);

			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_settings')->withErrors($isValid)->withInput();
			}

			Site::where('id', 1)->update([
				'name'		=>	$request->input('name'),
				'language'	=>	$request->input('language'),
				'theme'		=>	$request->input('theme'),
				'logo'		=>	$request->input('logo'),
				'favicon'	=>	$request->input('favicon'),
				'page_description'	=>	$request->input('page_description'),
				'support_email'		=>	$request->input('support_email'),
				'support_url'		=>	$request->input('support_url'),
				'show_training_url'	=>	$request->input('show_training_url'),
				'training_url'		=>	$request->input('training_url'),

				'appointment_url'	=>	$request->input('appointment_url'),
				'phone'				=>	$request->input('phone'),
				'address'			=>	$request->input('address'),
				'maps_link'			=>	$request->input('maps_link'),
				
				'hide_top_alert_bar'	=>	$request->input('hide_top_alert_bar'),
				'custom_top_alert_bar_text'	=>	$request->input('custom_top_alert_bar_text'),
				'working_hours_mon_thu'	=>	$request->input('working_hours_mon_thu'),
				'working_hours_friday'	=>	$request->input('working_hours_friday'),
				'working_hours_sat_sun'	=>	$request->input('working_hours_sat_sun'),
				
				'social_link_facebook'	=>	$request->input('social_link_facebook'),
				'social_link_instagram'	=>	$request->input('social_link_instagram'),
				'social_link_linkedin'	=>	$request->input('social_link_linkedin'),
				'social_link_twitter'	=>	$request->input('social_link_twitter'),

				'analytics_code'		=>	$request->input('analytics_code'),
				'custom_style'			=>	$request->input('custom_style'),
				'custom_script'			=>	$request->input('custom_script')
			]);

			return redirect()->route('get_admin_settings')->with('status.success', 'General Settings Updated.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_settings')->with('status.error', 'Something Went Wrong');
		}
	}

	// admin settings email (post)
	public function postSettingsEmail(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'from_name'			=> 'required',
				'from_address'		=> 'required'
			]);

			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_settings')->withErrors($isValid)->withInput();
			}

			Site::where('id', 1)->update([
				'host'			=>	$request->input('host'),
				'port'			=>	$request->input('port'),
				'encryption'	=>	$request->input('encryption'),
				'username'		=>	$request->input('username'),
				'password'		=>	$request->input('password'),
				'from_address'	=>	$request->input('from_address'),
				'from_name'		=>	$request->input('from_name')
			]);

			return redirect()->route('get_admin_settings')->with('status.success', 'Email Settings Updated.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_settings')->with('status.error', 'Something Went Wrong');
		}
	}

	// admin settings domain (post)
	public function postSettingsDomain(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'unique_name'   =>  'required|min:3|max:50|unique:site_settings,unique_name,1',
			]);
			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_settings')->withErrors($isValid)->withInput();
			}

			Site::where('id', 1)->update([
				'unique_name'	=>	$request->input('unique_name'),
				'external_url'	=>	$request->input('external_url')
			]);

			return redirect()->route('get_admin_settings')->with('status.success', 'Domain Settings Updated.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_settings')->with('status.error', 'Something Went Wrong');
		}
	}

	// admin settings password (post)
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
				return redirect()->route('get_admin_settings')->withErrors($isValid)->withInput();
			}
			$user = \App\Models\User::find(Auth::id());
			if($user)
			{
				$user->password = bcrypt($request->input('password'));
				$user->save();
				return redirect()->route('get_admin_settings')->with('status.success', 'Password Changed.');
			}
			else
			{
				return redirect()->route('get_admin_settings')->with('status.error', 'Something went wrong');
			}
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_settings')->with('status.error', 'Something went wrong');
		}
	}

	public function getCourses()
	{
        $courses = Courses::get();
		return view('admin.courses.all')->with('courses', $courses);
	}

    public function postCourse(Request $request)
    {
        Courses::create([
            'name'  		=>  $request->input('name'),
			'description' 	=>	$request->input('description'),
            'added_on'  	=>  time()
        ]);

        return redirect($request->header('Referer'))->with('status.success', 'Course Created');
    }

	// delete multiple user (post)
	public function postDeleteMultipleCourses(Request $request)
	{
		try
		{
			$user_ids = $request->input("users_id");
			$user_ids = explode(",", $user_ids);

			foreach($user_ids as $id)
			{
				Courses::where('id', $id)->delete();
			}
			
			return redirect()->route('get_admin_courses_all')->with('status.success', 'Courses Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_courses_all')->with('status.error', 'Something Went Wrong');
		}
	}

	// edit user
	public function getEditCourse(Request $request, $id)
	{
		$course = Courses::find($id);
		if($course)
		{
			return view('admin.courses.edit')->with('course', $course);
		}
		else
		{
			return view('errors.404');
		}
	}

	// update user (post)
	public function postEditCourse(Request $request, $id)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'name'    =>  'required|string|min:3'
			]);

			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_course_edit', ['id'	=>	$id])->withErrors($isValid)->withInput();
			}

			$course = Courses::find($id);
			if($course)
			{
				$course->name = $request->input('name');
				$course->description = $request->input('description');
				$course->save();

				return redirect()->route('get_admin_course_edit', ['id'	=>	$id])->with('status.success', 'Course Updated.');
			}
			else
			{
				return redirect()->route('get_admin_course_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
			}
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_course_edit', ['id'	=>	$id])->with('status.error', 'Something went wrong');
		}
	}

    // classes

    public function getClasses()
	{
        $classes = Classes::get();
        $courses = Courses::get();

		// get all teachers
		$teachers = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '4')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();

        foreach ($classes as $class)
        {
            $course_name = "";

            $get_course = Courses::where('id', $class->course_id)->first();
            if($get_course)
            {
                $course_name = $get_course->name;
            }

            $class->course_name = $course_name;

			if($class->assigned_member_id != null)
			{
				$teachers_info = [];

				foreach (json_decode($class->assigned_member_id) as $teacher_id)
				{

					$teacher_info = $teachers->where('id', $teacher_id)->first();

					if($teacher_info)
					{
						array_push($teachers_info, $teacher_info);
					}
				}

				$class->assigned_member_id = $teachers_info;
			}
        }

		if(Auth::user()->isTeacher() == true)
		{
			$classes = $classes->filter(function($class){
				if($class->assigned_member_id != null)
				{
					if(array_search(Auth::id(), array_column($class->assigned_member_id, 'id')) !== FALSE)
					{
						return $class;
					}
				}
			})->values();
		}
		
		// return $classes;
		
        return view('admin.classes.all')
            ->with('classes', $classes)
            ->with('courses', $courses)
			->with('teachers', $teachers);
	}

    public function postClass(Request $request)
    {
        Classes::create([
            'name'          =>  $request->input('name'),
            'start_date'    =>  $request->input('start_date'),
            'end_date'      =>  $request->input('end_date'),
            'course_id'     =>  $request->input('course_id'),
            'added_on'      =>  time(),

            'assigned_member_id'    =>  json_encode($request->input('assigned_member_id'))
        ]);

        return redirect($request->header('Referer'))->with('status.success', 'Class Created');
    }

    public function getEditClass(Request $request, $id)
    {
        $class = Classes::where('id', $id)->first();
        if($class)
        {
            $courses = Courses::get();

			// get all teachers
			$teachers = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '4')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();

            $course_name = "";

            $get_course = Courses::where('id', $class->course_id)->first();
            if($get_course)
            {
                $course_name = $get_course->name;
            }

            $class->course_name = $course_name;

			if($class->assigned_member_id != null)
			{
				$teachers_info = [];

				foreach (json_decode($class->assigned_member_id) as $teacher_id)
				{
					$teacher_info = $teachers->where('id', $teacher_id)->first();

					if($teacher_info)
					{
						array_push($teachers_info, $teacher_info);
					}
				}

				$class->assigned_member_id = $teachers_info;				
			}
            
            return view('admin.classes.edit')
                ->with('class', $class)
                ->with('courses', $courses)
				->with('teachers', $teachers);
        }
        else
        {
            return "not found";
        }
    }

    public function postEditClass(Request $request)
    {
        try
        {
            Classes::where('id', $request->input('class_id'))->update([
                'name'  =>  $request->input('name'),
                'start_date'    =>  $request->input('start_date'),
                'end_date'      =>  $request->input('end_date'),
                'course_id'     =>  $request->input('course_id'),

                'assigned_member_id'    =>  $request->input('assigned_member_id')

            ]);

            return redirect($request->header('Referer'))->with('status.success', 'Class Updated');
        }
        catch(\Exception $ex)
        {
            return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
        }

    }

	public function postClassMultipleUser(Request $request)
	{
		try
		{
			$user_ids = $request->input("users_id");
			$user_ids = explode(",", $user_ids);

			$get_ids = explode("--", $request->input('new_plan_id'));

			$course_id = $get_ids[0];
			$class_id = $get_ids[1];

			// return json_encode($request->all());

			foreach($user_ids as $id)
			{

				// if exists
				$get_existsing_class = StudentClass::where('student_id', $id)->where('course_id', $course_id)->where('class_id', $class_id)->first();
				if(!$get_existsing_class)
				{
					StudentClass::create([
						'student_id'	=>	$id,
						'course_id'		=>	$course_id,
						'class_id'		=>	$class_id
					]);
				}
			}
			
			return redirect()->route('get_admin_users_index', ['filter' => 'students'])->with('status.success', 'Class Updated.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_index', ['filter' => 'students'])->with('status.error', 'Something Went Wrong');
		}
	}

	// delete multiple user (post)
	public function postDeleteMultipleClass(Request $request)
	{
		try
		{
			$user_ids = $request->input("users_id");
			$user_ids = explode(",", $user_ids);

			foreach($user_ids as $id)
			{
				Classes::where('id', $id)->delete();
			}
			
			return redirect()->route('get_admin_classes_all')->with('status.success', 'Class Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_classes_all')->with('status.error', 'Something Went Wrong');
		}
	}

    public function getManageClass(Request $request, $id)
    {
        // get class info
        $class = Classes::where('id', $id)->first();
        if($class)
        {
            // get all students
            $students = \App\Models\User
						::join('student_classes', 'users.id', '=', 'student_classes.student_id')
						->where('student_classes.class_id', $id)
						->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'student_classes.student_id', 'student_classes.course_id', 'student_classes.class_id')
						->get();

			// get marks
			foreach ($students as $student)
			{
				$assignments = StudentAssignment::where('user_id', $student->id)->where('class_id', $id)->get();

				$total_marks = 0;
				$obtained_marks = 0;

				foreach ($assignments as $assignment)
				{
					// if assignment has marks
					// get assignment info
					$get_assignment_info = ClassAssignment::where('id', $assignment->assignment_id)->first();
					if($get_assignment_info)
					{
						if($get_assignment_info->max_marks != null)
						{
							$total_marks += $get_assignment_info->max_marks;
							$obtained_marks += $assignment->marks_obtained;
						}
					}
				}

				$student->total_marks = $total_marks;
				$student->marks_obtained = $obtained_marks;
			}

            return view('admin.classes.manage')->with('class', $class)->with('students', $students);
        }
        else
        {
            return "not found";
        }
    }

    public function getClassesByCourseId(Request $request)
    {
        return Classes::where('course_id', $request->get('id'))->get();
    }

    public function postAddClassToUser(Request $request)
    {
		StudentClass::create([
			'student_id'	=>	$request->input('user_id'),
			'course_id' 	=>  $request->input('course_id'),
            'class_id'  	=>  $request->input('class_id')
		]);

        return redirect($request->header('Referer'))->with('status.success', 'Class Attached to Student');
    }

	public function getRemoveClassFromUser(Request $request, $id)
    {
		StudentClass::where('id', $id)->delete();

        return redirect($request->header('Referer'))->with('status.success', 'Class Removed from Student');
    }

	// attendance

    public function getAttendanceClass(Request $request, $id)
    {
        $class = Classes::where('id', $id)->first();
        if($class)
        {
            // all attendance

            // $today = time();
            // $wday = date('w', $today);   
            // $datemon = date('m-d-Y', $today - ($wday - 1)*86400);
            // $datetue = date('m-d-Y', $today - ($wday - 2)*86400);
            // $datewed = date('m-d-Y', $today - ($wday - 3)*86400);
            // $datethu = date('m-d-Y', $today - ($wday - 4)*86400);
            // $datefri = date('m-d-Y', $today - ($wday - 5)*86400);

            // $days = [];

            // // mon
            // $monday = [
            //     "day"   =>  "Monday",
            //     "date"  =>  $datemon
            // ];
            // array_push($days, $monday);

            // // tue
            // $tuesday = [
            //     "day"   =>  "Tuesday",
            //     "date"  =>  $datetue
            // ];
            // array_push($days, $tuesday);

            // // wed
            // $wednesday = [
            //     "day"   =>  "Wednesday",
            //     "date"  =>  $datewed
            // ];
            // array_push($days, $wednesday);

            // // thursday
            // $thursday = [
            //     "day"   =>  "Thursday",
            //     "date"  =>  $datethu
            // ];
            // array_push($days, $thursday);

            // // friday
            // $friday = [
            //     "day"   =>  "Friday",
            //     "date"  =>  $datefri
            // ];
            // array_push($days, $friday);

			$days = [];

			// get calendar dates
			$calendar_days = CalendarSchool::select('date')->get();

            $today_date = date('Y-m-d',(strtotime ('-2 day', strtotime (date('Y-m-d')))));

			// array_push($days, $today_date);

			$range = null;

			if($request->filled('range'))
			{
				$range = $request->input("range");
			}

			foreach ($calendar_days as $day)
			{
				// omit old dates

				$item_date = date('Y-m-d', strtotime($day->date));

				if($request->filled('range'))
				{
					$dates = explode(" - ", $request->input('range'));

					if($item_date >= $dates[0] && $dates[1] >= $item_date )
					{
						array_push($days, $day);
					}
				}
				else
				{
					if($item_date > $today_date)
					{
						array_push($days, $day);
					}
				}
			}

            // return $days;

            // get all students
            // $students = \App\Models\User::where('class_id', $id)->get();
			$students = \App\Models\User
						::join('student_classes', 'users.id', '=', 'student_classes.student_id')
						->where('student_classes.class_id', $id)
						->select('users.id', 'users.first_name', 'users.last_name', 'users.email')
						->get();

			// return $students;

            if(sizeof($students) > 0)
            {
                return view('admin.classes.attendance')->with('class', $class)->with('students', $students)->with('days', $days)->with('range', $range);
            }
            else
            {
                return redirect($request->header('Referer'))->with('status.error', 'No Students Found');    
            }
        }
        else
        {
            return redirect($request->header('Referer'))->with('status.error', 'Class Not Found');
        }
    }

	public function getStaffAttendanceClass(Request $request, $id)
    {
        $class = Classes::where('id', $id)->first();
        if($class)
        {
            // all attendance

            // $today = time();
            // $wday = date('w', $today);   
            // $datemon = date('m-d-Y', $today - ($wday - 1)*86400);
            // $datetue = date('m-d-Y', $today - ($wday - 2)*86400);
            // $datewed = date('m-d-Y', $today - ($wday - 3)*86400);
            // $datethu = date('m-d-Y', $today - ($wday - 4)*86400);
            // $datefri = date('m-d-Y', $today - ($wday - 5)*86400);

            // $days = [];

            // // mon
            // $monday = [
            //     "day"   =>  "Monday",
            //     "date"  =>  $datemon
            // ];
            // array_push($days, $monday);

            // // tue
            // $tuesday = [
            //     "day"   =>  "Tuesday",
            //     "date"  =>  $datetue
            // ];
            // array_push($days, $tuesday);

            // // wed
            // $wednesday = [
            //     "day"   =>  "Wednesday",
            //     "date"  =>  $datewed
            // ];
            // array_push($days, $wednesday);

            // // thursday
            // $thursday = [
            //     "day"   =>  "Thursday",
            //     "date"  =>  $datethu
            // ];
            // array_push($days, $thursday);

            // // friday
            // $friday = [
            //     "day"   =>  "Friday",
            //     "date"  =>  $datefri
            // ];
            // array_push($days, $friday);

			$days = [];

			// get calendar dates
			$calendar_days = CalendarSchool::select('date')->get();

            $today_date = date('Y-m-d',(strtotime ('-2 day', strtotime (date('Y-m-d')))));

			// array_push($days, $today_date);

			$range = null;

			if($request->filled('range'))
			{
				$range = $request->input("range");
			}

			foreach ($calendar_days as $day)
			{
				// omit old dates

				$item_date = date('Y-m-d', strtotime($day->date));

				if($request->filled('range'))
				{
					$dates = explode(" - ", $request->input('range'));

					if($item_date >= $dates[0] && $dates[1] >= $item_date )
					{
						array_push($days, $day);
					}
				}
				else
				{
					if($item_date > $today_date)
					{
						array_push($days, $day);
					}
				}
			}

            // return $days;

            // get all students
            // $students = \App\Models\User::where('class_id', $id)->get();

			$teachers = [];

			if($class->assigned_member_id != null)
			{
				foreach (json_decode($class->assigned_member_id) as $member_id)
				{
					$teacher = \App\Models\User
						::where('id', $member_id)
						->select('users.id', 'users.first_name', 'users.last_name')
						->first();

						array_push($teachers, $teacher);
				}
			}

            if(sizeof($teachers) > 0)
            {
                return view('admin.classes.staff-attendance')->with('class', $class)->with('students', $teachers)->with('days', $days)->with('range', $range);
            }
            else
            {
                return redirect($request->header('Referer'))->with('status.error', 'No Teachers Found');    
            }
        }
        else
        {
            return redirect($request->header('Referer'))->with('status.error', 'Class Not Found');
        }
    }

    public function getAttendanceSingle(Request $request)
    {
        $attendance = Attendance::where('user_id', $request->input('user_id'))->where('class_id', $request->input('class_id'))->where('date', $request->input('date'))->first();
        if($attendance)
        {
            return json_encode($attendance);
        }
        else
        {
            return json_encode(null);
        }
    }

    public function postAttendanceSingle(Request $request)
    {
		// check if already exists

		$attendance_exists = Attendance::where('user_id', $request->input('user_id'))->where('class_id', $request->input('class_id'))->where('date', $request->input('date_id'))->first();
		if($attendance_exists)
		{
			Attendance::where('user_id', $request->input('user_id'))
				->where('class_id', $request->input('class_id'))
				->where('date', $request->input('date_id'))
				->update([
					'user_id'   =>  $request->input('user_id'),
					'class_id'  =>  $request->input('class_id'),
					'date'      =>  $request->input('date_id'),
					'present'   =>  (boolean) json_decode($request->input('present')),
				]);

			$attendance = Attendance::where('user_id', $request->input('user_id'))->first();
			return $attendance;
		}
		else
		{
			$attendance = Attendance::create([
				'user_id'   =>  $request->input('user_id'),
				'class_id'  =>  $request->input('class_id'),
				'date'      =>  $request->input('date_id'),
				'present'   =>  (boolean) json_decode($request->input('present')),
			]);

			return $attendance;
		}
    }

	public function postAttendanceSingleHours(Request $request)
    {
		// check if already exists

		$attendance_exists = Attendance::where('user_id', $request->input('user_id'))->where('class_id', $request->input('class_id'))->where('date', $request->input('date_id'))->first();
		if($attendance_exists)
		{
			Attendance::where('user_id', $request->input('user_id'))
				->where('class_id', $request->input('class_id'))
				->where('date', $request->input('date_id'))
				->update([
					'hours'      =>  $request->input('hours')
				]);
		}
		else
		{
			Attendance::insert([
				'user_id'   =>  $request->input('user_id'),
				'class_id'  =>  $request->input('class_id'),
				'date'      =>  $request->input('date_id'),
				'hours'     =>  $request->input('hours'),
				'present'	=>	true
			]);
		}

        return "done";
    }

	// report pdf
	public function getReportPDFDownload($uid, $cid, Request $request)
	{
		//return json_encode($request->all());

		// get student
		$user = User::where('id', $uid)->select('id', 'first_name', 'last_name')->first();
		
		// get class info
		$class = Classes::where('id', $cid)->first();

		$attendance_percentage = "0%";

		if($user && $class)
		{
			// get class start time and end time
			$start_date = date('Y-m-d', strtotime($class->start_date));
			
			$end_date = date('Y-m-d', strtotime($class->end_date));

			// get all dates till now

			$days = [];

			// get calendar dates
			$calendar_days = CalendarSchool::select('date')->get();

            $today_date = date('Y-m-d');

			if($today_date > $end_date)
			{
				$today_date = $end_date;
			}

			$range = null;

			if($request->filled('range'))
			{
				$range = $request->input("range");
			}

			foreach ($calendar_days as $day)
			{
				// omit old dates

				$item_date = date('Y-m-d', strtotime($day->date));

				if($request->filled('range'))
				{
					$dates = explode(" - ", $request->input('range'));

					$start_date = date('Y-m-d', strtotime($dates[0]));
					$end_date = date('Y-m-d', strtotime($dates[1]));

					$today_date = date('Y-m-d');
					if($today_date > $end_date)
					{
						$today_date = $end_date;
					}

					if($item_date >= $dates[0] && $dates[1] >= $item_date )
					{
						array_push($days, $day);
					}
				}
				else
				{
					if($item_date >= $start_date && $item_date <= $today_date)
					{
						array_push($days, $day);
					}
				}
			}

			// return $days;

			// get attendance of each day

			$present_days = 0;

			foreach ($days as $adate)
			{
				$current_status = "-";

				$get_status = Attendance::where('user_id', $uid)->where('class_id', $cid)->where('date', $adate["date"])->first();
				if($get_status)
				{
					if($get_status->present)
					{
						$present_days++;
						$current_status = "Present";
					}
					else
					{
						$current_status = "Absent";
					}
				}

				$adate["status"] = $current_status;
			}


			if(count($days) == 0)
			{
				$attendance_percentage = "-";
			}

			if($present_days > 0 && count($days) > 0)
			{
				$attendance_percentage = number_format(floatval($present_days / count($days)) * 100, 2, '.', '')."%";
			}

			$data = [
				"title"	=>	"Attendance",
				"user"	=>	$user,
				"class"	=>	$class,
				"days"	=>	$days,

				"start_date"	=>	$start_date,
				"end_date"		=>	$today_date,
				"attendance_percentags" => $attendance_percentage
			];

			// return $data;
	
			$pdf = Pdf::loadView('pdf.student_single_attendance', $data);  
			return $pdf->download($user->first_name.'.pdf');

			// return view('pdf.student_single_attendance');
		}
	}

	public function getReportPDFMDownload($cid, Request $request)
	{
		//return json_encode($request->all());

		// get students
		$users = \App\Models\User
						::join('student_classes', 'users.id', '=', 'student_classes.student_id')
						->where('student_classes.class_id', $cid)
						->select('users.id', 'users.first_name', 'users.last_name', 'users.email')
						->get();

		// get class info
		$class = Classes::where('id', $cid)->first();

		$users_data = [];
		foreach ($users as $user)
		{
			// get student
			// $user = User::where('id', $uid)->select('id', 'first_name', 'last_name')->first();

			$attendance_percentage = "0%";

			if($user && $class)
			{
				// get class start time and end time
				$start_date = date('Y-m-d', strtotime($class->start_date));
				
				$end_date = date('Y-m-d', strtotime($class->end_date));

				// get all dates till now

				$days = [];

				// get calendar dates
				$calendar_days = CalendarSchool::select('date')->get();

				$today_date = date('Y-m-d');

				if($today_date > $end_date)
				{
					$today_date = $end_date;
				}

				$range = null;

				if($request->filled('range'))
				{
					$range = $request->input("range");
				}

				foreach ($calendar_days as $day)
				{
					// omit old dates

					$item_date = date('Y-m-d', strtotime($day->date));

					if($request->filled('range'))
					{
						$dates = explode(" - ", $request->input('range'));

						$start_date = date('Y-m-d', strtotime($dates[0]));
						$end_date = date('Y-m-d', strtotime($dates[1]));

						$today_date = date('Y-m-d');
						if($today_date > $end_date)
						{
							$today_date = $end_date;
						}

						if($item_date >= $dates[0] && $dates[1] >= $item_date )
						{
							array_push($days, $day);
						}
					}
					else
					{
						if($item_date >= $start_date && $item_date <= $today_date)
						{
							array_push($days, $day);
						}
					}
				}

				// return $days;

				// get attendance of each day

				$present_days = 0;

				foreach ($days as $adate)
				{
					$current_status = "-";

					$get_status = Attendance::where('user_id', $user->id)->where('class_id', $cid)->where('date', $adate["date"])->first();
					if($get_status)
					{
						if($get_status->present)
						{
							$present_days++;
							$current_status = "Present";
						}
						else
						{
							$current_status = "Absent";
						}
					}

					$adate["status"] = $current_status;
				}


				if(count($days) == 0)
				{
					$attendance_percentage = "-";
				}

				if($present_days > 0 && count($days) > 0)
				{
					$attendance_percentage = number_format(floatval($present_days / count($days)) * 100, 2, '.', '')."%";
				}

				$data = [
					"title"	=>	"Attendance",
					"user"	=>	$user,
					// "class"	=>	$class,
					"days"	=>	$days,

					"start_date"	=>	$start_date,
					"end_date"		=>	$today_date,
					"attendance_percentags" => $attendance_percentage
				];

				array_push($users_data, $data);
			}
		}

		$users_data_item = [
			"class"	=>	$class,
			"data"	=>	$users_data
		];

		// return $users_data_item;

		$pdf = Pdf::loadView('pdf.student_multiple_attendance', $users_data_item);  
		return $pdf->download($class->name.'_attendance.pdf');
	}

	// report excel
	public function getReportExcelDownload($uid, $cid, Request $request)
	{
		//return json_encode($request->all());

		// get student
		$user = User::where('id', $uid)->select('id', 'first_name', 'last_name')->first();
		
		// get class info
		$class = Classes::where('id', $cid)->first();

		$attendance_percentage = "0%";

		if($user && $class)
		{
			// get class start time and end time
			$start_date = date('Y-m-d', strtotime($class->start_date));
			
			$end_date = date('Y-m-d', strtotime($class->end_date));

			// get all dates till now

			$days = [];

			// get calendar dates
			$calendar_days = CalendarSchool::select('date')->get();

            $today_date = date('Y-m-d');

			if($today_date > $end_date)
			{
				$today_date = $end_date;
			}

			$range = null;

			if($request->filled('range'))
			{
				$range = $request->input("range");
			}

			foreach ($calendar_days as $day)
			{
				// omit old dates

				$item_date = date('Y-m-d', strtotime($day->date));

				if($request->filled('range'))
				{
					$dates = explode(" - ", $request->input('range'));

					$start_date = date('Y-m-d', strtotime($dates[0]));
					$end_date = date('Y-m-d', strtotime($dates[1]));

					$today_date = date('Y-m-d');
					if($today_date > $end_date)
					{
						$today_date = $end_date;
					}

					if($item_date >= $dates[0] && $dates[1] >= $item_date )
					{
						array_push($days, $day);
					}
				}
				else
				{
					if($item_date >= $start_date && $item_date <= $today_date)
					{
						array_push($days, $day);
					}
				}
			}

			// return $days;

			// get attendance of each day

			$present_days = 0;

			foreach ($days as $adate)
			{
				$current_status = "-";

				$get_status = Attendance::where('user_id', $uid)->where('class_id', $cid)->where('date', $adate["date"])->first();
				if($get_status)
				{
					if($get_status->present)
					{
						$present_days++;
						$current_status = "Present";
					}
					else
					{
						$current_status = "Absent";
					}
				}

				$adate["status"] = $current_status;
			}


			if(count($days) == 0)
			{
				$attendance_percentage = "-";
			}

			if($present_days > 0 && count($days) > 0)
			{
				$attendance_percentage = number_format(floatval($present_days / count($days)) * 100, 2, '.', '')."%";
			}

			$data = [
				"title"	=>	"Attendance",
				"user"	=>	$user,
				"class"	=>	$class,
				"days"	=>	$days,

				"start_date"	=>	$start_date,
				"end_date"		=>	$today_date,
				"attendance_percentags" => $attendance_percentage
			];

			// return $data;

			$filename = public_path("/tmp/".$user->id.'.xlsx');
	
			$spreadsheet = new Spreadsheet();

			$response = [
				[$user->first_name. " " .$user->last_name],
				
				[""],
				
				["Class: ".$class->name."(". $class->start_date." - ". $class->end_date],
				["Attendance from: ".$start_date." to ". $end_date],
				["Attendance Percentage: ". $attendance_percentage],
				
				[""],

				["Date", "Status"],
				[""],
			];

			foreach ($days as $day)
			{
				$item = [
					$day["date"],
					$day["status"]
				];

				array_push($response, $item);
			}

			// return $response;

			$spreadsheet->getActiveSheet()->fromArray(
				$response,
				NULL,
				'A1'
			);

			$writer = new Xlsx($spreadsheet);
			$writer->save($filename);

			return response()->download($filename);
		}
	}

	// report excel
	public function getReportExcelMDownload($cid, Request $request)
	{
		// get students
		$users = \App\Models\User
						::join('student_classes', 'users.id', '=', 'student_classes.student_id')
						->where('student_classes.class_id', $cid)
						->select('users.id', 'users.first_name', 'users.last_name', 'users.email')
						->get();

		// get class info
		$class = Classes::where('id', $cid)->first();

		$filename = public_path("/tmp/".$class->name.'_attendance.xlsx');
		
		$spreadsheet = new Spreadsheet();

		foreach ($users as $user_index => $user)
		{
			// get student
			$user = User::where('id', $user->id)->select('id', 'first_name', 'last_name')->first();

			$attendance_percentage = "0%";

			if($user && $class)
			{
				// get class start time and end time
				$start_date = date('Y-m-d', strtotime($class->start_date));
				
				$end_date = date('Y-m-d', strtotime($class->end_date));

				// get all dates till now

				$days = [];

				// get calendar dates
				$calendar_days = CalendarSchool::select('date')->get();

				$today_date = date('Y-m-d');

				if($today_date > $end_date)
				{
					$today_date = $end_date;
				}

				$range = null;

				if($request->filled('range'))
				{
					$range = $request->input("range");
				}

				foreach ($calendar_days as $day)
				{
					// omit old dates

					$item_date = date('Y-m-d', strtotime($day->date));

					if($request->filled('range'))
					{
						$dates = explode(" - ", $request->input('range'));

						$start_date = date('Y-m-d', strtotime($dates[0]));
						$end_date = date('Y-m-d', strtotime($dates[1]));

						$today_date = date('Y-m-d');
						if($today_date > $end_date)
						{
							$today_date = $end_date;
						}

						if($item_date >= $dates[0] && $dates[1] >= $item_date )
						{
							array_push($days, $day);
						}
					}
					else
					{
						if($item_date >= $start_date && $item_date <= $today_date)
						{
							array_push($days, $day);
						}
					}
				}

				// return $days;

				// get attendance of each day

				$present_days = 0;

				foreach ($days as $adate)
				{
					$current_status = "-";

					$get_status = Attendance::where('user_id', $user->id)->where('class_id', $cid)->where('date', $adate["date"])->first();
					if($get_status)
					{
						if($get_status->present)
						{
							$present_days++;
							$current_status = "Present";
						}
						else
						{
							$current_status = "Absent";
						}
					}

					$adate["status"] = $current_status;
				}


				if(count($days) == 0)
				{
					$attendance_percentage = "-";
				}

				if($present_days > 0 && count($days) > 0)
				{
					$attendance_percentage = number_format(floatval($present_days / count($days)) * 100, 2, '.', '')."%";
				}

				// return $data;

				$response = [
					[$user->first_name. " " .$user->last_name],
					
					[""],
					
					["Class: ".$class->name."(". $class->start_date." - ". $class->end_date],
					["Attendance from: ".$start_date." to ". $end_date],
					["Attendance Percentage: ". $attendance_percentage],
					
					[""],

					["Date", "Status"],
					[""],
				];

				foreach ($days as $day)
				{
					$item = [
						$day["date"],
						$day["status"]
					];

					array_push($response, $item);
				}

				// return $response;

				if($user_index == 0)
				{
					$spreadsheet->getActiveSheet()->fromArray(
						$response,
						NULL,
						'A1'
					);

					$spreadsheet->getActiveSheet()->setTitle($user->first_name." ".$user->last_name);
				}
				else
				{
					$spreadsheet->createSheet();
					$spreadsheet->setActiveSheetIndex(1);
					$spreadsheet->getActiveSheet()->fromArray(
						$response,
						NULL,
						'A1'
					);
					$spreadsheet->getActiveSheet()->setTitle($user->first_name." ".$user->last_name);
				}
			}
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save($filename);

		return response()->download($filename);
	}

	// resources

	public function getResourcesClass(Request $request, $id)
    {
        $class = Classes::where('id', $id)->first();
        if($class)
        {
			$resources_photos = ClassResource::where('class_id', $id)->where('type', 'photo')->get();
			$resources_videos = ClassResource::where('class_id', $id)->where('type', 'video')->get();
			$resources_docs = ClassResource::where('class_id', $id)->where('type', 'docs')->get();
			$resources_notes = ClassResource::where('class_id', $id)->where('type', 'note')->get();

            return view('admin.classes.resources')
					->with('class', $class)
					->with('photos', $resources_photos)
					->with('videos', $resources_videos)
					->with('docs', $resources_docs)
					->with('notes', $resources_notes);
        }
        else
        {
            return redirect($request->header('Referer'))->with('status.error', 'Class Not Found');
        }
    }

	// add photos
	public function postAddClassResourcePhotos(Request $request)
	{
		$total = count($_FILES['photos']['name']);

		// $result = [];

		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ )
		{
			//Get the temp file path
			$tmpFilePath = $_FILES['photos']['tmp_name'][$i];
		
			//Make sure we have a file path
			if($tmpFilePath != "")
			{
				// array_push($result, $tmpFilePath);
				$extension = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
				if($extension == "png" || $extension == "jpg" || $extension == "jpeg")
				{
					$random_name = rand();
					Storage::disk('uploads')->putFileAs('resources', $tmpFilePath, $random_name.".".$extension);
					$path = "/uploads/resources/".$random_name.".".$extension;

					ClassResource::insert([
						'class_id'	=>	$request->input('class_id'),
						'file_path'	=>	$path,
						'type'		=>	'photo',
						'tag'		=>	$request->input('tag')
					]);
				}
			}
		}

		return redirect($request->header('Referer'))->with('status.success', 'Photos Uploaded');
	}

	// add videos
	public function postAddClassResourceVideos(Request $request)
	{
		$total = count($_FILES['photos']['name']);

		// $result = [];

		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ )
		{
			//Get the temp file path
			$tmpFilePath = $_FILES['photos']['tmp_name'][$i];
		
			//Make sure we have a file path
			if($tmpFilePath != "")
			{
				// array_push($result, $tmpFilePath);
				$extension = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
				if($extension == "mp4" || $extension == "avi" || $extension == "mpeg")
				{
					$random_name = rand();
					Storage::disk('uploads')->putFileAs('resources', $tmpFilePath, $random_name.".".$extension);
					$path = "/uploads/resources/".$random_name.".".$extension;

					ClassResource::insert([
						'class_id'	=>	$request->input('class_id'),
						'file_path'	=>	$path,
						'type'		=>	'video',
						'tag'		=>	$request->input('tag')
					]);
				}
			}
		}

		return redirect($request->header('Referer'))->with('status.success', 'Videos Uploaded');
	}

	public function postAddClassResourceDocs(Request $request)
	{
		$total = count($_FILES['photos']['name']);

		// $result = [];

		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ )
		{
			//Get the temp file path
			$tmpFilePath = $_FILES['photos']['tmp_name'][$i];
		
			//Make sure we have a file path
			if($tmpFilePath != "")
			{
				// array_push($result, $tmpFilePath);
				$extension = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
				if($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "xsl" || $extension == "jpeg" || $extension == "jpg" || $extension == "png")
				{
					$random_name = rand();
					Storage::disk('uploads')->putFileAs('resources', $tmpFilePath, $random_name.".".$extension);
					$path = "/uploads/resources/".$random_name.".".$extension;

					ClassResource::insert([
						'class_id'	=>	$request->input('class_id'),
						'file_path'	=>	$path,
						'type'		=>	'docs',
						'tag'		=>	$request->input('tag')
					]);
				}
			}
		}

		return redirect($request->header('Referer'))->with('status.success', 'Videos Uploaded');
	}

	public function postAddClassResourceNote(Request $request)
	{
		ClassResource::insert([
			'class_id'	=>	$request->input('class_id'),
			'type'		=>	'note',
			'name'		=>	$request->input('name'),
			'description'		=>	$request->input('description'),
			'date'		=>	$request->input('date'),
			'tag'		=>	$request->input('tag')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Note Added');
	}

	public function getResourcesClassNote(Request $request, $id)
	{
		$note = ClassResource::where('id', $id)->first();
		if($note)
		{
			return view('admin.classes.note')->with('note', $note);
		}
		else
		{
			return redirect($request->header('Referer'))->with('status.error', 'Note Not Found');
		}
	}

	public function getResourcesDelete(Request $request, $id)
	{
		ClassResource::where('id', $id)->delete();
		return redirect($request->header('Referer'))->with('status.error', 'Note Deleted');
	}

	// assignments

	public function getAssignmentsClass(Request $request, $id)
    {
        $class = Classes::where('id', $id)->first();
        if($class)
        {
			$assignments = ClassAssignment::where('class_id', $id)->orderBy('id', 'desc')->get();

            return view('admin.classes.assignments.all')
					->with('class', $class)
					->with('assignments', $assignments);
        }
        else
        {
            return redirect($request->header('Referer'))->with('status.error', 'Class Not Found');
        }
    }

	public function postAddClassAssignmentFile(Request $request)
	{
		$total = count($_FILES['file']['name']);

		$files = [];

		// $result = [];

		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ )
		{
			//Get the temp file path
			$tmpFilePath = $_FILES['file']['tmp_name'][$i];
		
			//Make sure we have a file path
			if($tmpFilePath != "")
			{
				// array_push($result, $tmpFilePath);
				$extension = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
				if($extension == "doc" || $extension == "docx" || $extension == "pdf" || $extension == "xsl" || $extension == "jpeg" || $extension == "jpg" || $extension == "png")
				{
					$random_name = rand();
					Storage::disk('uploads')->putFileAs('assignments', $tmpFilePath, $random_name.".".$extension);
					$path = "/uploads/assignments/".$random_name.".".$extension;

					array_push($files, $path);
				}
			}
		}

		ClassAssignment::insert([
			'class_id'	=>	$request->input('class_id'),
			'type'		=>	$request->input('type'),
			'file_type'	=>	"file",
			'name'		=>	$request->input('name'),
			'file'		=>	json_encode($files),
			'max_marks'	=>	$request->input('max_marks'),
			'created_by_id'	=>	Auth::id()
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Assignment Created');
	}

	public function postAddClassAssignmentNote(Request $request)
	{
		ClassAssignment::insert([
			'class_id'	=>	$request->input('class_id'),
			'type'		=>	$request->input('type'),
			'file_type'	=>	"note",
			'name'		=>	$request->input('name'),
			'note'		=>	$request->input('note'),
			'max_marks'	=>	$request->input('max_marks'),
			'created_by_id'	=>	Auth::id()
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Assignment Created');
	}

	public function getAssignmentClassNote(Request $request, $id)
	{
		$note = ClassAssignment::where('id', $id)->first();
		if($note)
		{
			return view('admin.classes.assignments.note')->with('note', $note);
		}
		else
		{
			return redirect($request->header('Referer'))->with('status.error', 'Note Not Found');
		}
	}

	public function getAssignmentDelete(Request $request, $id)
	{
		ClassAssignment::where('id', $id)->delete();
		return redirect($request->header('Referer'))->with('status.success', 'Assignment Deleted');
	}

	public function postAssignClassAssignment(Request $request)
	{
		// get assignment
		$assignment = ClassAssignment::where('id', $request->input('assignment_id'))->first();
		if($assignment)
		{
			// get class
			$class = Classes::where('id', $assignment->class_id)->first();
			
			if($class)
			{
				// get students
				 $students = \App\Models\User::join('student_classes', 'users.id', '=', 'student_classes.student_id')
				 	->where('student_classes.class_id', $class->id)
					->select('users.id')
				 	->get();
				
				// assign assignment
				foreach ($students as $student)
				{
					StudentAssignment::insert([
						'user_id'	=>	$student->id,
						'class_id'	=>	$class->id,
						'assignment_id'	=>	$assignment->id,
					]);
				}

				// mark assignment as published
				ClassAssignment::where('id', $assignment->id)->update([
					'published'	=>	true
				]);

				return redirect($request->header('Referer'))->with('status.success', 'Assignment Assigned to Students');
			}
		}

		return redirect($request->header('Referer'))->with('status.error', 'Unable to Assign');
	}

	public function getAssignmentSubmissions(Request $request, $id)
	{
		$assignment = ClassAssignment::where('id', $id)->first();
		$assignments = StudentAssignment::where('assignment_id', $id)->get();

		// if($assignment->file_type == "file")
		// {
		// 	$assignments = StudentAssignment::where('assignment_id', $id)->where('file', '!=', null)->get();
		// }
		// if($assignment->file_type == "note")
		// {
		// 	$assignments = StudentAssignment::where('assignment_id', $id)->where('note', '!=', null)->get();
		// }

		foreach ($assignments as $assignment_item)
		{
			$assignment_item->user = \App\Models\User::where('id', $assignment_item->user_id)->select('id', 'first_name', 'last_name', 'email')->first();

			$last_message = StudentAssignmentThread::where('user_id', $assignment_item->user_id)->where('student_assignment_id', $assignment_item->id)->orderBy('id', 'desc')->first();
			
			// last message
			$assignment_item->message = $last_message;
		}

		// return $assignments;

		return view('admin.classes.assignments.submissions')->with('assignment', $assignment)->with('assignments', $assignments);
	}

	public function getAssignmentSubmissionDetail(Request $request, $id)
	{
		// get assignment info
		$assignment = StudentAssignment::where('id', $id)->first();
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

			return view('admin.classes.assignments.submission-detail')->with('assignment', $assignment);
		}
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

	public function postAssignmentAccept(Request $request)
	{
		StudentAssignment::where('id', $request->input('assignment_id'))->update([
			'marks_obtained'	=>	$request->input('marks_obtained'),
			'accepted'			=>	true
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Assignment Accepted');
	}

	// reg forms

	public function getFormsRegistration(Request $request)
	{
		$users = FormRegistration::join('users', 'forms_regs.user_id', '=', 'users.id')
					->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'forms_regs.id as form_id')
					->orderByDesc('id')
					->get();

		foreach($users as $user)
		{
			$user->plan_name = null;

			// get user level
			$fetch_roles = \App\Models\User_Role::where('user_id', '=', $user->id)->first();
			if($fetch_roles)
			{
				if(json_decode($fetch_roles->levels) != null && json_decode($fetch_roles->levels) != "")
				{
					if(array_key_exists(1, json_decode($fetch_roles->levels)))
					{
						$get_level_id = json_decode($fetch_roles->levels)[1];
						$level_info = Levels::where('id', $get_level_id)->first();
						if($level_info)
						{
							$user->plan_name = $level_info->name;
						}
					}
				}
			}
		}

		$plans = Levels::where('id', '!=', '1')->get();

		// return $users;
		
		return view('admin.forms.registration')
			->with('users', $users)
			->with('plans', $plans);
	}

	public function getFormsRegistrationDetail(Request $request, $id)
	{
		$form = FormRegistration::where('id', $id)->first();

		if($form)
		{
			return view('admin.forms.registration_detail')->with('form', $form);
		}
		else
		{
			return redirect($request->header('Referer'))->with('status.error', 'Not Found');
		}
	}

	public function postFormsRegistrationDetail(Request $request)
	{
		FormRegistration::where('id', $request->input('form_id'))->update([
			'receipt_fee'	=>	$request->input('receipt_fee'),
			'receipt_membership'	=>	$request->input('receipt_membership'),
			'supplies_provided'		=>	$request->input('supplies_provided')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Changes Saved');
	}

	// mem forms

	public function getFormsMembership(Request $request)
	{
		$users = FormMembership::join('users', 'forms_mems.user_id', '=', 'users.id')
					->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'forms_mems.id as form_id')
					->orderByDesc('id')
					->get();

		foreach($users as $user)
		{
			$user->plan_name = null;

			// get user level
			$fetch_roles = \App\Models\User_Role::where('user_id', '=', $user->id)->first();
			if($fetch_roles)
			{
				if(json_decode($fetch_roles->levels) != null && json_decode($fetch_roles->levels) != "")
				{
					if(array_key_exists(1, json_decode($fetch_roles->levels)))
					{
						$get_level_id = json_decode($fetch_roles->levels)[1];
						$level_info = Levels::where('id', $get_level_id)->first();
						if($level_info)
						{
							$user->plan_name = $level_info->name;
						}
					}
				}
			}
		}

		$plans = Levels::where('id', '!=', '1')->get();

		// return $users;
		
		return view('admin.forms.membership')
			->with('users', $users)
			->with('plans', $plans);
	}

	public function getFormsMembershipDetail(Request $request, $id)
	{
		$form = FormMembership::where('id', $id)->first();

		if($form)
		{
			return view('admin.forms.membership_detail')->with('form', $form);
		}
		else
		{
			return redirect($request->header('Referer'))->with('status.error', 'Not Found');
		}
	}

	public function postFormsMembershipDetail(Request $request)
	{
		FormMembership::where('id', $request->input('form_id'))->update([
			
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Changes Saved');
	}

	// school calendar

	public function getSchoolCalendar(Request $request)
	{
		$events = CalendarSchool::get();
		return view('admin.calendar.school')->with('events', $events);
	}

	public function postSchoolCalendarEvent(Request $request)
	{
		CalendarSchool::insert([
			'date'				=>	$request->input('date'),
			'school_activity'	=>	$request->input('school_activity'),
			'no_of_classes'		=>	$request->input('no_of_classes'),
			'activity'			=>	$request->input('activity')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Calendar Entry Created');
	}

	public function getEditSchoolCalendarEvent(Request $request, $id)
	{
		$event = CalendarSchool::where('id', $id)->first();
		return view('admin.calendar.school_edit')->with('event', $event);
	}

	public function postEditSchoolCalendarEvent(Request $request)
	{
		CalendarSchool::where('id', $request->input('event_id'))->update([
			'date'	=>	$request->input('date'),
			'school_activity'	=>	$request->input('school_activity'),
			'no_of_classes'		=>	$request->input('no_of_classes'),
			'activity'			=>	$request->input('activity')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Calendar Entry Updated');
	}

	public function postDeleteSchoolCalendarEvent(Request $request, $id)
	{
		CalendarSchool::where('id', $id)->delete();
		return redirect($request->header('Referer'))->with('status.success', 'Calendar Entry Deleted');
	}

	// director calendar

	public function getDirectorCalendar(Request $request)
	{
		$events = CalendarDirector::get();

		$directors = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '2')->select('users.id','users.first_name', 'users.last_name', 'users.email')->orderByDesc('id')->get();

		return view('admin.calendar.director')->with('events', $events)->with('directors', $directors);
	}

	public function postDirectorCalendarEvent(Request $request)
	{
		CalendarDirector::insert([
			'date'				=>	$request->input('date'),
			'school_activity'	=>	$request->input('school_activity'),
			'no_of_classes'		=>	$request->input('no_of_classes'),
			'director_on_duty'	=>	$request->input('director_on_duty'),
			'activity'			=>	$request->input('activity')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Calendar Entry Created');
	}

	public function getEditDirectorCalendarEvent(Request $request, $id)
	{
		$event = CalendarDirector::where('id', $id)->first();
		$directors = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '2')->select('users.id','users.first_name', 'users.last_name', 'users.email')->orderByDesc('id')->get();
		return view('admin.calendar.director_edit')->with('event', $event)->with('directors', $directors);
	}

	public function postEditDirectorCalendarEvent(Request $request)
	{
		CalendarDirector::where('id', $request->input('event_id'))->update([
			'date'	=>	$request->input('date'),
			'school_activity'	=>	$request->input('school_activity'),
			'no_of_classes'		=>	$request->input('no_of_classes'),
			'director_on_duty'	=>	$request->input('director_on_duty'),
			'activity'			=>	$request->input('activity')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Calendar Entry Updated');
	}

	public function postDeleteDirectorCalendarEvent(Request $request, $id)
	{
		CalendarDirector::where('id', $id)->delete();
		return redirect($request->header('Referer'))->with('status.success', 'Calendar Entry Deleted');
	}

	// school events

	public function getSchoolEvents(Request $request)
	{
		$events = SchoolEvents::get();
		return view('admin.events.index')->with('events', $events);
	}

	public function postSchoolEvent(Request $request)
	{
		SchoolEvents::insert([
			'name'	=>	$request->input('name'),
			'date'	=>	$request->input('date'),
			'description'	=>	$request->input('description')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'Even Entry Created');
	}

	public function getEditSchoolEvent(Request $request, $id)
	{
		$event = SchoolEvents::where('id', $id)->first();
		$photos = SchoolEventPhotos::where('event_id', $id)->get();
		return view('admin.events.edit')->with('event', $event)->with('photos', $photos);
	}

	public function postEditSchoolEvent(Request $request)
	{
		SchoolEvents::where('id', $request->input('event_id'))->update([
			'date'			=>	$request->input('date'),
			'name'			=>	$request->input('name'),
			'description'	=>	$request->input('description')
		]);

		return redirect($request->header('Referer'))->with('status.success', 'School Event Updated');
	}

	public function postDeleteSchoolEvent(Request $request, $id)
	{
		SchoolEvents::where('id', $id)->delete();
		return redirect($request->header('Referer'))->with('status.success', 'School Event Deleted');
	}

	public function postEditSchoolEventPhotos(Request $request)
	{
		$total = count($_FILES['photos']['name']);

		// $result = [];

		// Loop through each file
		for( $i=0 ; $i < $total ; $i++ )
		{
			//Get the temp file path
			$tmpFilePath = $_FILES['photos']['tmp_name'][$i];
		
			//Make sure we have a file path
			if($tmpFilePath != "")
			{
				// array_push($result, $tmpFilePath);
				$extension = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
				if($extension == "png" || $extension == "jpg" || $extension == "jpeg")
				{
					$random_name = rand();
					Storage::disk('uploads')->putFileAs('events', $tmpFilePath, $random_name);
					$path = "/uploads/events/".$random_name;

					SchoolEventPhotos::insert([
						'event_id'	=>	$request->input('event_id'),
						'photo'		=>	$path
					]);
				}
			}
		}

		return redirect($request->header('Referer'))->with('status.success', 'Photos Uploaded');
	}

	public function getDeleteSchoolEventPhoto(Request $request, $id)
	{
		SchoolEventPhotos::where('id', $id)->delete();
		return redirect($request->header('Referer'))->with('status.success', 'School Event Photo Deleted');
	}

	public function getFieldTerms(Request $request)
	{
		$term = Terms::where('type', 'field')->first();
		return view('admin.terms.field')->with('term', $term);
	}

	public function getSignUpTerms(Request $request)
	{
		$term = Terms::where('type', 'signup')->first();
		return view('admin.terms.signup')->with('term', $term);
	}

	public function getSignUpEmailTerms(Request $request)
	{
		$term = Terms::where('type', 'mail')->first();
		return view('admin.terms.mail')->with('term', $term);
	}
	
	public function postTerm(Request $request, $type)
	{
		Terms::where('type', $type)->update([
			'title'	=>	$request->input('title'),
			'terms'	=>	$request->input('description')
		]);
		
		return redirect($request->header('Referer'))->with('status.success', 'Updated');

	}

	public function getSchoolCalendarEventAttendance(Request $request, $id)
	{

		// event
		$event = CalendarSchool::where('id', $id)->first();
		// return $event;

		$data = FieldAttendance::where('event_id', $id)->get();

		foreach($data as $item)
		{
			$dd = null;
			$user = User::where('id', $item->student_id)->select('id', 'first_name', 'last_name', 'email')->first();
			if($user)
			{
				$dd = $user;
			}
			
			$item->user = $dd;
		}

		// return $data;
		return view('admin.calendar.attendance')->with('event', $event)->with('data', $data);
	}

	public function postSendMailtoUser(Request $request)
	{
		// return json_encode($request->all());

		// get user details
		$user = User::where('id', $request->input('user_id'))->select('id', 'first_name', 'last_name', 'email')->first();
		if($user)
		{
			// schedule mail
			MailSend_Direct::dispatch($user->first_name, $user->email, $request->input('subject'), $request->input('body'));

			return redirect($request->header('Referer'))->with('status.success', 'Message Scheduled.');
		}
		else
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong.');
		}
	}

	public function postSendMailtoClass(Request $request)
	{
		try
		{
			// get class users
			$class_users = StudentClass::where('class_id', $request->input('class_id'))->get();
			
			foreach ($class_users as $class_user)
			{
				// get user details
				$user = User::where('id', $class_user->student_id)->select('id', 'first_name', 'last_name', 'email')->first();
				if($user)
				{
					// schedule mail
					MailSend_Direct::dispatch($user->first_name, $user->email, $request->input('subject'), $request->input('body'));
				}
			}
			
			return redirect($request->header('Referer'))->with('status.success', 'Message Scheduled.');
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong.');
		}
	}

	public function postSendMailtoFilter(Request $request)
	{
		try
		{
			// get filter users
			$filter = $request->input('filter');

			// all
			if($filter == "All")
			{
				$users = \App\Models\User::select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.profile_pic')->orderByDesc('id')->get();
			}

			// board_members
			if($filter == "Board Member(s)")
			{
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '2')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.profile_pic')->orderByDesc('id')->get();
			}

			// principals
			if($filter == "Principal(s)")
			{
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '3')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}
			
			// teachers
			if($filter == "Teacher(s)")
			{
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '4')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}

			// students
			if($filter == "Student(s)")
			{
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '5')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}

			// members
			if($filter == "Member(s)")
			{
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '6')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}
			
			// return $users;
			
			foreach ($users as $user)
			{
				// schedule mail
				MailSend_Direct::dispatch($user->first_name, $user->email, $request->input('subject'), $request->input('body'));
			}
			
			return redirect($request->header('Referer'))->with('status.success', 'Message Scheduled.');
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something went wrong.');
		}
	}

	// pages

	public function getPages(Request $request)
	{
		$pages = Page::orderBy('id', 'asc')->get();
		return view('admin.pages.all')->with('pages', $pages);
	}

	public function postPage(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'name'		=> 'required',
				'type'		=> 'required',
			]);

			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_pages')->withErrors($isValid)->withInput();
			}

			Page::create([
				'name'	=>	$request->input('name'),
				'type'	=>	$request->input('type'),
				'show_in_top_menu'	=>	$request->input('show_in_top_menu'),
				'show_in_footer'	=>	$request->input('show_in_footer')
			]);
			
			return redirect()->route('get_admin_pages')->with('status.success', 'Page Created');
		}
		catch(\Exception $ex)
		{
			return $ex;
			return redirect()->route('get_admin_pages')->with('status.error', 'Something Went Wrong');
		}
	}

	public function getEditPage(Request $request, $id)
	{
		$page = Page::where('id', $id)->first();
		if($page)
		{
			return view('admin.pages.edit')->with('page', $page);
		}
		else
		{
			return redirect()->route('get_admin_pages')->with('status.error', 'Page Not Found');
		}
	}

	public static function arraySearch($array, $index, $value)
    {
        foreach($array as $arrayInf) {
            if($arrayInf[$index] == $value) {
                return $arrayInf;
            }
        }
        return null;
	}

	public function postEditPage(Request $request)
	{
		// return $request->all();
		$page = Page::where('id', $request->input('id'))->first();

		if($page)
		{
			if($page->type == "custom")
			{
				$page_schema = json_decode($page->page_schema, true);

				$page_schema_values = $request->input('page_schema');

				foreach($page_schema_values as $block_key => $block_value)
				{
					$old_block = $this->arraySearch($page_schema['blocks'], "name", $block_key);
					
					foreach ($block_value as $key => $value)
					{
						if($old_block["type"] == "single")
						{
							if(is_string($value))
							{
								$old_block["attributes"][$key]["value"] = $value;
							}
							else
							{
								$old_block["attributes"][$key]["values"] = $value;
							}
						}
						

						if($old_block["type"] == "collection")
						{
							// set all attributes as well
							$old_block["values"] = $block_value;
						}

						// collection
						$old_key = array_search($block_key, array_column($page_schema["blocks"], "name"));
						
						$page_schema["blocks"][$old_key] = $old_block;
					}
				}

				// return $page_schema;

				Page::where('id', $request->input('id'))->update([
					'name'	=>	$request->input('name'),
					'show_in_top_menu'	=>	$request->input('show_in_top_menu'),
					'show_in_footer'	=>	$request->input('show_in_footer'),
					'page_schema'		=>	$page_schema
				]);

				return redirect()->route('get_edit_page', ['id' => $request->input('id')])->with('status.success', 'Page Updated');
			}
			else
			{
				// cta bg file path
				$cta_bg_to_upload = $request->file('image');
				$cta_bg_path = null;

				if($cta_bg_to_upload)
				{
					// check size
					$size = $request->file('image')->getSize();
					if($size > 2000000)
					{
						// return redirect()->route('get_user_video', $id)->with('status.error', 'Max File Size should be 2MB');
						return json_encode("max cta background image file size should be 2mb");
					}

					$extension = $cta_bg_to_upload->getClientOriginalExtension();
					if($extension == "png" || $extension == "jpg" || $extension == "jpeg")
					{
						$random_name = rand().".".$request->file('image')->clientExtension();

						// Storage::disk('uploads')->putFileAs('documents', $request->file('document_path'), $random_name);
						Storage::disk('uploads')->putFileAs('images', $request->file('image'), $random_name);
						$cta_bg_path = "/uploads/images/".$random_name;
					}
					else
					{
						// return redirect()->route('get_user_video', $id)->with('status.error', 'Supported Formats: png, jpeg, jpg');
						return json_encode("supported image formats: png, jpeg or jpg");
					}
				}
				else
				{
					$cta_bg_path = $page->image;	
				}

				Page::where('id', $request->input('id'))->update([
					'name'	=>	$request->input('name'),
					'show_in_top_menu'	=>	$request->input('show_in_top_menu'),
					'show_in_footer'	=>	$request->input('show_in_footer'),
					'title'				=>	$request->input('title'),
					'summary'			=>	$request->input('summary'),
					'image'				=>	$cta_bg_path,
					'content'			=>	$request->input('content')
				]);

				return "Changes Saved";
			}
		}
		else
		{
			return "not found";
		}
	}

	public function getRemoveItem(Request $request, $pid, $bid, $aid)
	{
		// get old schema
		$page = Page::where('id', $pid)->first();
		if($page)
		{
			$page_schema = json_decode($page->page_schema, true);

			$block_key = array_search($bid, array_column($page_schema["blocks"], "name"));

			// unset($page_schema['blocks'][$block_key]['attributes'][$aid]['values'][$key]);

			// $page_schema['blocks'][$block_key]['attributes'][$aid]['values'] = array_merge($page_schema['blocks'][$block_key]['attributes'][$aid]['values']);

			$page_schema['blocks'][$block_key]['attributes'][$aid]['value'] = "";

			Page::where('id', $pid)->update([
				'page_schema'		=>	$page_schema
			]);

			return redirect()->route('get_edit_page', ['id' => $pid])->with('status.success', 'Image Removed');
		}
		else
		{
			return redirect()->route('get_edit_page', ['id' => $pid])->with('status.error', 'Page Not Found');
		}
	}

	public function getRemoveItemFromCustomPageCollection(Request $request, $pid, $bid, $aid, $key)
	{
		// get old schema
		$page = Page::where('id', $pid)->first();
		if($page)
		{
			$page_schema = json_decode($page->page_schema, true);

			$block_key = array_search($bid, array_column($page_schema["blocks"], "name"));

			if($page_schema['blocks'][$block_key]['type'] == "collection")
			{
				unset($page_schema['blocks'][$block_key]['values'][$key]);
				$page_schema['blocks'][$block_key]['values'] = array_merge($page_schema['blocks'][$block_key]['values']);
			}
			else
			{
				unset($page_schema['blocks'][$block_key]['attributes'][$aid]['values'][$key]);
				$page_schema['blocks'][$block_key]['attributes'][$aid]['values'] = array_merge($page_schema['blocks'][$block_key]['attributes'][$aid]['values']);
			}

			Page::where('id', $pid)->update([
				'page_schema'		=>	$page_schema
			]);

			return redirect()->route('get_edit_page', ['id' => $pid])->with('status.success', 'Item Removed');
		}
		else
		{
			return redirect()->route('get_edit_page', ['id' => $pid])->with('status.error', 'Page Not Found');
		}
	}

	public function postAddImage(Request $request)
	{
		$page = Page::where('id', $request->input('_page_id'))->first();
		if($page)
		{
			$page_schema = json_decode($page->page_schema, true);

			$block_key = array_search($request->input('_bid'), array_column($page_schema["blocks"], "name"));

			// cta bg file path
			$cta_bg_to_upload = $request->file('image_file');
			$cta_bg_path = null;

			if($cta_bg_to_upload)
			{
				// check size
				$size = $request->file('image_file')->getSize();
				if($size > 2000000)
				{
					return json_encode("max image file size should be 2mb");
				}

				$extension = $cta_bg_to_upload->getClientOriginalExtension();
				if($extension == "png" || $extension == "jpg" || $extension == "jpeg")
				{
					$random_name = rand().".".$request->file('image_file')->clientExtension();
					Storage::disk('uploads')->putFileAs('images', $request->file('image_file'), $random_name);
					$cta_bg_path = "/uploads/images/".$random_name;
				}
				else
				{
					return json_encode("supported image formats: png, jpeg or jpg");
				}
			}
			
			$page_schema['blocks'][$block_key]['attributes'][$request->input('_key')]['value'] = $cta_bg_path;

			// return $page_schema;

			Page::where('id', $request->input('_page_id'))->update([
				'page_schema'		=>	$page_schema
			]);

			return json_encode("done");
		}
	}

	public function postAddImageToCollection(Request $request)
	{
		// return json_encode($request->all());
		$page = Page::where('id', $request->input('_page_id'))->first();
		if($page)
		{
			$page_schema = json_decode($page->page_schema, true);

			$block_key = array_search($request->input('_bid'), array_column($page_schema["blocks"], "name"));

			if($request->filled('_fid'))
			{
				$old_array = $page_schema['blocks'][$block_key]['attributes'][$request->input('_aid')]['values'];
			}
			else
			{
				$old_array = $page_schema['blocks'][$block_key]['values'];
			}

			// cta bg file path
			$cta_bg_to_upload = $request->file('image_file');
			$cta_bg_path = null;

			if($cta_bg_to_upload)
			{
				// check size
				$size = $request->file('image_file')->getSize();
				if($size > 2000000)
				{
					return json_encode("max image file size should be 2mb");
				}

				$extension = $cta_bg_to_upload->getClientOriginalExtension();
				if($extension == "png" || $extension == "jpg" || $extension == "jpeg")
				{
					$random_name = rand().".".$request->file('image_file')->clientExtension();
					Storage::disk('uploads')->putFileAs('images', $request->file('image_file'), $random_name);
					$cta_bg_path = "/uploads/images/".$random_name;
				}
				else
				{
					return json_encode("supported image formats: png, jpeg or jpg");
				}
			}

			// check if index already exists
			if(array_key_exists($request->input('_key'), $old_array))
			{
				// $new_item = [
				// 	$request->input('_fid') => $cta_bg_path
				// ];

				$new_item = $old_array[$request->input('_key')];
				$new_item['image'] = $cta_bg_path;

				$old_array[$request->input('_key')] = $new_item;
			}
			else
			{
				if($request->filled('_fid'))
				{
					$new_item_attributes = $page_schema['blocks'][$block_key]['attributes'][$request->input('_aid')]['attributes'];
				}
				else
				{
					$new_item_attributes = $page_schema['blocks'][$block_key]['attributes'];
				}

				$new_item_array = [];

				foreach($new_item_attributes as $new_item_att_key => $new_item_att_value)
				{
					$temp = [
						$new_item_att_key => ""
					];

					array_push($new_item_array, $temp);
				}

				$flatNewItemArray = array_merge(...$new_item_array);
				$flatNewItemArray['image'] = $cta_bg_path;
				array_push($old_array, $flatNewItemArray);
			}
			
			if($request->filled('_fid'))
			{
				$page_schema['blocks'][$block_key]['attributes'][$request->input('_aid')]['values'] = $old_array;
			}
			else
			{
				$page_schema['blocks'][$block_key]['values'] = $old_array;
			}

			Page::where('id', $request->input('_page_id'))->update([
				'page_schema'		=>	$page_schema
			]);

			return json_encode("done");
		}
	}

	public function getDeletePage(Request $request, $id)
	{
		Page::where('id', $id)->delete();
		return redirect()->route('get_admin_pages')->with('status.success', 'Page Deleted');
	}

	// blog posts

	public function getPosts(Request $request)
	{
		$pages = Post::orderBy('id', 'desc')->get();
		return view('admin.posts.all')->with('pages', $pages);
	}

	public function postPost(Request $request)
	{
		try
		{
			$isValid =  Validator::make($request->all(), [
				'name'		=> 'required',
				'title'		=> 'required'
			]);

			
			if($isValid->fails()){
				$messages = $isValid->messages();
				return redirect()->route('get_admin_posts')->withErrors($isValid)->withInput();
			}

			Post::create([
				'name'	=>	$request->input('name'),
				'title'	=>	$request->input('title')
			]);
			
			return redirect()->route('get_admin_posts')->with('status.success', 'Post Created');
		}
		catch(\Exception $ex)
		{
			return $ex;
			return redirect()->route('get_admin_posts')->with('status.error', 'Something Went Wrong');
		}
	}

	public function getEditPost(Request $request, $id)
	{
		$page = Post::where('id', $id)->first();
		if($page)
		{
			return view('admin.posts.edit')->with('page', $page);
		}
		else
		{
			return redirect()->route('get_admin_posts')->with('status.error', 'Post Not Found');
		}
	}

	public function postEditPost(Request $request)
	{
		$page = Post::where('id', $request->input('id'))->first();

		if($page)
		{
			// cta bg file path
			$cta_bg_to_upload = $request->file('image');
			$cta_bg_path = null;

			if($cta_bg_to_upload)
			{
				// check size
				$size = $request->file('image')->getSize();
				if($size > 2000000)
				{
					// return redirect()->route('get_user_video', $id)->with('status.error', 'Max File Size should be 2MB');
					return json_encode("max cta background image file size should be 2mb");
				}

				$extension = $cta_bg_to_upload->getClientOriginalExtension();
				if($extension == "png" || $extension == "jpg" || $extension == "jpeg")
				{
					$random_name = rand().".".$request->file('image')->clientExtension();

					// Storage::disk('uploads')->putFileAs('documents', $request->file('document_path'), $random_name);
					Storage::disk('uploads')->putFileAs('images', $request->file('image'), $random_name);
					$cta_bg_path = "/uploads/images/".$random_name;
				}
				else
				{
					// return redirect()->route('get_user_video', $id)->with('status.error', 'Supported Formats: png, jpeg, jpg');
					return json_encode("supported image formats: png, jpeg or jpg");
				}
			}
			else
			{
				$cta_bg_path = $page->image;	
			}

			Post::where('id', $request->input('id'))->update([
				'name'				=>	$request->input('name'),
				'title'				=>	$request->input('title'),
				'summary'			=>	$request->input('summary'),
				'image'				=>	$cta_bg_path,
				'content'			=>	$request->input('content'),
				'published'			=>	$request->input('published'),
				'created_at'		=>	$request->input('created_at')
			]);

			return "Changes Saved";
		}
		else
		{
			return "not found";
		}
	}

	// messages

	public function getMessages(Request $request)
	{
		$pages = Message::orderBy('id', 'desc')->get();
		return view('admin.messages.all')->with('pages', $pages);
	}

	public function getMessage(Request $request, $id)
	{
		$page = Message::where('id', $id)->first();
		if($page)
		{
			return view('admin.messages.edit')->with('page', $page);
		}
		else
		{
			return redirect()->route('get_admin_messages')->with('status.error', 'Message Not Found');
		}
	}

}