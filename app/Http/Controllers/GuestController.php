<?php

namespace App\Http\Controllers;

use App\Jobs\MailSend_SignUp;
use App\Models\Attendance;
use App\Models\CalendarDirector;
use App\Models\CalendarSchool;
use App\Models\Classes;
use App\Models\Courses;
use App\Models\FormMembership;
use App\Models\FormRegistration;
use App\Models\Message;
use App\Models\Page;
use App\Models\Post;
use App\Models\SchoolEventPhotos;
use App\Models\SchoolEvents;
use App\Models\Terms;
use App\Models\User;
use App\Models\User_Role;
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

class GuestController extends Controller
{
	public function getIndex()
	{
		$page = Page::where('id', 1)->first();
		$posts = Post::where('published', true)->get();
		return view('guest.index')->with('page', $page)->with('posts', $posts);
	}

	public function getGallery()
	{
		return view('guest.gallery');
	}

	public function getTerms(Request $request, $type)
	{
		if($type == "signup" || $type == "field")
		{
			$term = Terms::where('type', $type)->first();
			return view('guest.terms')->with('term', $term);
		}
		return redirect()->route('get_index');
	}

	public function getAbout()
	{
		$page = Page::where('id', 1)->first();
		return view('guest.about')->with('page', $page);
	}

	public function getContact()
	{
		$page = Page::where('id', 4)->first();
		return view('guest.contact')->with('page', $page);
	}

	public function getTeam()
	{
		$users = \App\Models\User::join('user_role', 'users.id', '=', 'user_role.user_id')
					->whereJsonContains('user_role.levels', '2')
					->select('users.id','users.first_name', 'users.last_name', 'users.email', 'users.enabled', 'users.created_by', 'users.created_at', 'users.title', 'users.profile_pic', 'users.description')
					->orderByDesc('id')
					->get();
		
		return view('guest.team')->with('users', $users);
	}

	public function getMission()
	{
		$page = Page::where('id', 2)->first();
		return view('guest.mission')->with('page', $page);
	}

	public function getDocuments()
	{
		return view('guest.documents');
	}

	public function getEvents(Request $request)
	{
		$filter = "";

		$all_events = SchoolEvents::get();
		$years = [];

		foreach ($all_events as $event)
		{
			array_push($years, date('Y', strtotime($event->date)));
		}

		$events = SchoolEvents::get();

		if($request->filled('year'))
		{
			$filter = $request->input('year');

			$events = SchoolEvents::where(DB::raw('YEAR(date)'), '=', $filter)->get();
		}

		foreach ($events as $event)
		{
			$first_image = SchoolEventPhotos::where('event_id', $event->id)->first();
			if($first_image)
			{
				$event->first_image = $first_image->photo;
			}
			else
			{
				$event->first_image = null;
			}
		}

		$years = array_unique($years);

		return view('guest.events')->with('events', $events)->with('years', $years)->with('filter', $filter);
	}

	public function getEventDetails(Request $request, $id)
	{
		$event = SchoolEvents::where('id', $id)->first();
		if($event)
		{
			$current_page = 1;

			if($request->filled('page'))
			{
				$current_page = $request->input('page');
				$skip = ($request->input('page') - 1) * 9;
			}
			else
			{
				$skip = 0;
			}

			// return $current_page ." -- ". $skip;

			$total = SchoolEventPhotos::where('event_id', $id)->count();

			$photos = SchoolEventPhotos::where('event_id', $id)->skip($skip)->take(9)->get();
			
			return view('guest.event')
				->with('event', $event)
				->with('photos', $photos)
				->with('total', $total)
				->with('current_page', $current_page);
		}
	}

	public function getForms()
	{
		return view('guest.forms');
	}

	public function getFormRegistration()
	{
		return view('guest.forms.registration');
	}

	public function postFormRegistration(Request $request)
	{
		try
		{
            // validate
            $isValid =  Validator::make($request->all(), [
                'email'	=>	'required|string|email|min:5|max:50|unique:users'
            ]);
            
            if($isValid->fails()){
				return redirect($request->header('Referer'))->with('status.error', 'Email Already in use');
            }
            else{

				// create new user
				$random_text_generator = new \IsotopeKit\Utility\RandomTextGenerator();
				$random_token = $random_text_generator->get_random_value_in_string(20);

				// create account
				$user = User::create([
					'first_name'    =>  $request->input('first_name'),
					'last_name'     =>  $request->input('last_name'),
					'email'         =>  $request->input('email'),
					'password'      =>  bcrypt($random_token),
					'email_token'   =>  $random_token,
					'enabled'       =>  true
				]);

				// send signup email
                MailSend_SignUp::dispatch($user->id);

				// save role
				$save_role = User_Role::create([
					'user_id'	=>	$user->id,
					'levels'    => '["1"]', // by default user with 'basic' plan
				]);

				FormRegistration::insert([
					'user_id'		=>	$user->id,
					'created_at'	=>	time(),

					'first_name'	=>	$request->input('first_name'),
					'last_name'		=>	$request->input('last_name'),
					'date_of_birth'	=>	$request->input('date_of_birth'),
					
					'tel_no'	=>	$request->input('tel_no'),
					'email'	=>	$request->input('email'),
					'address'	=>	$request->input('address'),
					'city'	=>	$request->input('city'),
					'postal_code'	=>	$request->input('postal_code'),
					'father_name'	=>	$request->input('father_name'),
					'mother_name'	=>	$request->input('mother_name'),
					'know_hindi'	=>	$request->input('know_hindi'),
					'hindi_speak'	=>	$request->input('hindi_speak'),
					'hindi_read'	=>	$request->input('hindi_read'),
					'hindi_write'	=>	$request->input('hindi_write'),
					'student_before'	=>	$request->input('student_before'),
					'student_before_year'	=>	$request->input('student_before_year'),
					'student_before_level'	=>	$request->input('student_before_level'),
					'family_language'	=>	$request->input('family_language'),
					'why_need_to_learn'	=>	$request->input('why_need_to_learn'),
					'membership_for'	=>	$request->input('membership_for'),
					'fee_paid'	=>	$request->input('fee_paid'),
					'fee_paid_ref_id'	=>	$request->input('fee_paid_ref_id')
				]);

				return redirect($request->header('Referer'))->with('status.success', 'Form Submitted');
			}
		}
		catch(\Exception $ex)
		{
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	public function getFormMembership()
	{
		return view('guest.forms.membership');
	}

	public function postFormMembership(Request $request)
	{
		try
		{
            // validate
            $isValid =  Validator::make($request->all(), [
                'email'	=>	'required|string|email|min:5|max:50|unique:users'
            ]);
            
            if($isValid->fails()){
				return redirect($request->header('Referer'))->with('status.error', 'Email Already in use');
            }
            else{

				// create new user
				$random_text_generator = new \IsotopeKit\Utility\RandomTextGenerator();
				$random_token = $random_text_generator->get_random_value_in_string(20);

				// create account
				$user = User::create([
					'first_name'    =>  $request->input('first_name'),
					'last_name'     =>  $request->input('last_name'),
					'email'         =>  $request->input('email'),
					'password'      =>  bcrypt($random_token),
					'email_token'   =>  $random_token,
					'enabled'       =>  true
				]);

				// send signup email
                MailSend_SignUp::dispatch($user->id);

				// save role
				$save_role = User_Role::create([
					'user_id'	=>	$user->id,
					'levels'    => '["1"]', // by default user with 'basic' plan
				]);

				FormMembership::insert([
					'user_id'		=>	$user->id,
					'created_at'	=>	time(),

					'name'			=>	$request->input('first_name')." ".$request->input('last_name'),
					'spouse_name'	=>	$request->input('spouse_name'),
					'mailing_address'	=>	$request->input('address'),

					'tel_no'	=>	$request->input('tel_no'),
					'email'	=>	$request->input('email'),

					'volunteer_program'	=>	$request->input('volunteer_program'),
					'volunteer_school'	=>	$request->input('volunteer_school'),
					'volunteer_office'	=>	$request->input('volunteer_office'),
					'volunteer_library'	=>	$request->input('volunteer_library'),
					'introduced_by'		=>	$request->input('introduced_by'),
					'introduced_by_name'	=>	$request->input('introduced_by_name'),
					'approved_by'		=>	$request->input('approved_by'),
					'approved_by_name'	=>	$request->input('approved_by_name'),
					
					'membership_for'	=>	$request->input('membership_for'),
					'fee_paid'	=>	$request->input('fee_paid'),
					'fee_paid_ref_id'	=>	$request->input('fee_paid_ref_id')
				]);

				return redirect($request->header('Referer'))->with('status.success', 'Form Submitted');
			}
		}
		catch(\Exception $ex)
		{
			// return $ex;
			return redirect($request->header('Referer'))->with('status.error', 'Something Went Wrong');
		}
	}

	public function getCalendar(Request $request)
	{
		return view('guest.calendar.index');
	}

	public function getCalendarSchool(Request $request)
	{
		$events = CalendarSchool::orderBy('date', 'asc')->get();
		return view('guest.calendar.school')->with('events', $events);
	}

	public function getCalendarDirectorDuty()
	{
		$events = CalendarDirector::orderBy('date', 'asc')->get();
		return view('guest.calendar.director')->with('events', $events);
	}

	public function getPage($name)
	{
		$page = Page::where('name', $name)->first();

		if($page->type == "general")
		{
			return view('guest.page')->with('page', $page);
		}

		if($page->type == "service")
		{
			return view('guest.service')->with('page', $page);
		}
	}

	public function getBlog()
	{
		$posts = Post::where('published', true)->get();
		return view('guest.blog')->with('posts', $posts);
	}

	public function getPost($name)
	{
		$post = Post::where('published', true)->where('name', $name)->first();
		return view('guest.post')->with('post', $post);
	}

	public function postContact(Request $request)
	{
		Message::create([
			'message'	=>	$request->input('message'),
			'name'		=>	$request->input('name'),
			'email'		=>	$request->input('email'),
			'phone'		=>	$request->input('phone'),
			'created_at' => time()
		]);

		// send email
		

		return redirect()->route('get_contact')->with('status.success', 'Message Received, will get back to you soon.');
	}
}