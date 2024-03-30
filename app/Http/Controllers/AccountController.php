<?php

namespace App\Http\Controllers;

use App\Jobs\SaveEmbedding;
use App\Libraries\CaptionsData;
use IsotopeKit\AuthAPI\Models\User;
use IsotopeKit\AuthAPI\Models\User_Role;


use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

use Mail;

use IsotopeKit\Utility;

use Config;

use Illuminate\Support\Facades\Cookie;
use App\Models\VideoSite;
use App\Models\VideoPage;
use App\Models\Video;
use App\Models\VideoReactions;
use App\Models\Domain;
use App\Models\VidChapterProject;
use Google\Service\StreetViewPublish\Level;
use IsotopeKit\AuthAPI\Models\Levels;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
	public function getIndex()
	{
		return view('index');
	}

	public function getGallery()
	{
		return view('gallery');
	}

	public function getAbout()
	{
		return view('about');
	}

	public function getContact()
	{
		return view('contact');
	}

	public function getTeam()
	{
		return view('team');
	}

	public function getMission()
	{
		return view('mission');
	}

	public function getEvents()
	{
		return view('events');
	}

	public function getForms()
	{
		return view('forms');
	}
}
