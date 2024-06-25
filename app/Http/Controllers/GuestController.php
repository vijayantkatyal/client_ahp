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
}