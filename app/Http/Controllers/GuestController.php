<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Courses;
use App\Models\FormMembership;
use App\Models\FormRegistration;
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
		return view('guest.index');
	}

	public function getGallery()
	{
		return view('guest.gallery');
	}

	public function getAbout()
	{
		return view('guest.about');
	}

	public function getContact()
	{
		return view('guest.contact');
	}

	public function getTeam()
	{
		return view('guest.team');
	}

	public function getMission()
	{
		return view('guest.mission');
	}

	public function getEvents()
	{
		return view('guest.events');
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
}