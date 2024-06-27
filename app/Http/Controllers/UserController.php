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

class UserController extends Controller
{
	use DispatchesJobs;

	public function getIndex(Request $request)
	{
		return view('member.index');
	}
}
