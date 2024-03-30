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
}
