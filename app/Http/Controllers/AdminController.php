<?php

namespace App\Http\Controllers;

use App\Jobs\SaveEmbedding;
use App\Libraries\CaptionsData;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Courses;
use App\Models\CustomProperties;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

use Mail;

use Config;

use Illuminate\Support\Facades\Cookie;
use App\Models\VideoSite;
use App\Models\VideoPage;
use App\Models\Video;
use App\Models\VideoReactions;
use App\Models\Domain;
use App\Models\Levels;
use App\Models\Site;
use App\Models\User as ModelsUser;
use App\Models\VidChapterProject;
use Google\Service\StreetViewPublish\Level;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // dashboard
	public function index(Request $request)
	{
		return redirect()->route('get_admin_users_index');
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
		$users = \App\Models\User::whereNotIn('id', $admin_accounts)->select('id','first_name', 'last_name', 'email', 'enabled', 'created_at', 'created_by')->orderByDesc('id')->get();

		$filter = "All";

		if($request->filter)
		{
			// board_members
			if($request->filter == "board_members")
			{
				$filter = "Board Member(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '2')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}

			// principals
			if($request->filter == "principals")
			{
				$filter = "Principal(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '3')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}
			
			// teachers
			if($request->filter == "teachers")
			{
				$filter = "Teacher(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '4')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}

			// students
			if($request->filter == "students")
			{
				$filter = "Student(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '5')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
			}

			// members
			if($request->filter == "members")
			{
				$filter = "Member(s)";
				$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')->whereJsonContains('user_role.levels', '6')->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at')->orderByDesc('id')->get();
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
		}

		return view('admin.users.index')
				->with('filter', $filter)	
				->with('plans', $plans)
				->with('users', $users);
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
				
				Mail::send('emails.welcome', $data, function($message) use ($emails_to)
				{
					$message->to($emails_to['email'], $emails_to['name'])->subject($emails_to['subject']);
				});
			}

			return redirect()->route('get_admin_users_index')->with('status.success', 'User Created.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_index')->with('status.error', 'Something went wrong, try again later');

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
						}
					}
				}
			}
			
			$custom_properties = CustomProperties::get();

			$courses = Courses::get();
			$classes = Classes::where('course_id', $user->course_id)->get();

			return view('admin.users.edit')
				->with('user', $user)->with('plans', $plans)
				->with('plan_id', $plan_id)
				->with('custom_properties', $custom_properties)
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
				return redirect()->route('get_admin_users_index')->with('status.error', 'Something Went Wrong');
			}

			\App\Models\User::where('id', $id)->update([
				'enabled'	=>	$request->input('enabled')
			]);

			if($request->input('enabled') == true)
			{
				return redirect()->route('get_admin_users_index')->with('status.success', 'User now Active.');
			}
			else
			{
				return redirect()->route('get_admin_users_index')->with('status.error', 'User now Inactive.');
			}

		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_index')->with('status.error', 'Something Went Wrong');
		}
	}

	// delete user (post)
	public function postDeleteUser(Request $request, $id)
	{
		try
		{
			\App\Models\User::where('id', $id)->delete();
			return redirect()->route('get_admin_users_index')->with('status.success', 'User Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_index')->with('status.error', 'Something Went Wrong');
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
			
			return redirect()->route('get_admin_users_index')->with('status.success', 'Users Deleted.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_index')->with('status.error', 'Something Went Wrong');
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
			
			return redirect()->route('get_admin_users_index')->with('status.success', 'Users Plan Updated.');
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_index')->with('status.error', 'Something Went Wrong');
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
				return redirect()->route('get_admin_users_index')->with('status.error', 'User Not Found.');
			}
		}
		catch(\Exception $ex)
		{
			return redirect()->route('get_admin_users_index')->with('status.error', 'Something went wrong, try again later');
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
				'training_url'		=>	$request->input('training_url')
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
            $students = \App\Models\User::where('class_id', $id)->get();

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
        ModelsUser::where('id', $request->input('user_id'))->update([
            'course_id' =>  $request->input('course_id'),
            'class_id'  =>  $request->input('class_id')
        ]);
        return redirect($request->header('Referer'))->with('status.success', 'Class Info Updated');
    }

    public function getAttendanceClass(Request $request, $id)
    {
        $class = Classes::where('id', $id)->first();
        if($class)
        {
            // all attendance

            $today = time();
            $wday = date('w', $today);   
            $datemon = date('m-d-Y', $today - ($wday - 1)*86400);
            $datetue = date('m-d-Y', $today - ($wday - 2)*86400);
            $datewed = date('m-d-Y', $today - ($wday - 3)*86400);
            $datethu = date('m-d-Y', $today - ($wday - 4)*86400);
            $datefri = date('m-d-Y', $today - ($wday - 5)*86400);

            $days = [];

            // mon
            $monday = [
                "day"   =>  "Monday",
                "date"  =>  $datemon
            ];
            array_push($days, $monday);

            // tue
            $tuesday = [
                "day"   =>  "Tuesday",
                "date"  =>  $datetue
            ];
            array_push($days, $tuesday);

            // wed
            $wednesday = [
                "day"   =>  "Wednesday",
                "date"  =>  $datewed
            ];
            array_push($days, $wednesday);

            // thursday
            $thursday = [
                "day"   =>  "Thursday",
                "date"  =>  $datethu
            ];
            array_push($days, $thursday);

            // friday
            $friday = [
                "day"   =>  "Friday",
                "date"  =>  $datefri
            ];
            array_push($days, $friday);

            // return $days;

            // get all students
            $students = \App\Models\User::where('class_id', $id)->get();
            if(sizeof($students) > 0)
            {
                return view('admin.classes.attendance')->with('class', $class)->with('students', $students)->with('days', $days);
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
        Attendance::create([
            'user_id'   =>  $request->input('user_id'),
            'class_id'  =>  $request->input('class_id'),
            'date'      =>  $request->input('date_id'),
            'present'   =>  (boolean) json_decode($request->input('present')),
        ]);

        return "done";
    }
}