<?php

namespace App\Http\Controllers;

use App\Jobs\MailSend_SignUp;
use App\Models\Levels;
use App\Models\User;
use App\Models\User_Role;
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
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
	public function getLogin()
    {
        return view('account.login');
    }

    public function postLogin(Request $request)
    {
		// return $request->all();
		$login_url = "/login";

        try{
            // validate
            $isValid =  Validator::make($request->all(), [
                'email'         => 'required|string|email|min:5|max:50',
                'password'      => 'required|string|min:6|max:20'
            ]);

            if($isValid->fails()){
                return redirect($login_url)->withErrors($isValid)->withInput();
            }
            else{
                
                if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'enabled' => true], true)) {
                // if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], true)) {
				
                    if(Auth::user()->isAdmin() === true || Auth::user()->isTeacher() == true || Auth::user()->isPrincipal() == true || Auth::user()->isBoardMember() == true)
                    {
                        return redirect()->intended('/admin');
                    }
                    if(Auth::user()->isTeamOnly() === true)
                    {
                        return redirect()->intended('/team');
                    }
                    if(Auth::user()->isAgency() == true)
                    {
                        return redirect()->intended('/agency');
                    }
                    if(Auth::user()->isStudent() == true)
                    {
                        return redirect()->intended('/student');
                    }

                    // if(Auth::user()->isTeacher() == true || Auth::user()->isPrincipal() == true || Auth::user()->isBoardMember() == true)
                    // {
                    //     return redirect()->intended('/staff');
                    // }

                    if(Auth::user()->isMember() == true)
                    {
                        return redirect()->intended('/member');
                    }
                    else {
                        return redirect()->intended('/user');
                    }
                }
                else{
                    $messages = [
                        'general'	=>	'invalid username or password'
                    ];
					return redirect($login_url)->withErrors($messages)->withInput();
                }

            }
        }
        catch(\Exception $ex)
        {
            return $ex;
            return redirect($login_url)->with('status.error', 'Something went wrong, try again later');
        }
    }

    public function getIndex(Request $request)
    {
        if(Auth::check())
        {
            if(Auth::user()->isAdmin() === true || Auth::user()->isTeacher() == true || Auth::user()->isPrincipal() == true || Auth::user()->isBoardMember() == true)
            {
                return redirect()->intended('/admin');
            }
            if(Auth::user()->isTeamOnly() === true)
            {
                return redirect()->intended('/team');
            }
            if(Auth::user()->isAgency() == true)
            {
                return redirect()->intended('/agency');
            }
            if(Auth::user()->isStudent() == true)
            {
                return redirect()->intended('/student');
            }
            
            // if(Auth::user()->isTeacher() == true || Auth::user()->isPrincipal() == true || Auth::user()->isBoardMember() == true)
            // {
            //     return redirect()->intended('/staff');
            // }
            
            if(Auth::user()->isMember() == true)
            {
                return redirect()->intended('/member');
            }
            else {
                return redirect()->intended('/user');
            }
        }
        else
        {
            return redirect()->intended('/');
        }
    }

    public function getRegister()
    {
        $levels = Levels::where('id','!=',1)->get();
        return view('account.register')->with('plans', $levels);
    }

    public function postRegister(Request $request)
    {
        try{
            // validate
            $isValid =  Validator::make($request->all(), [
                'first_name'    =>  'required|string|min:3|max:10',
                'last_name'     =>  'required|string|min:3|max:10',
                'email'         =>  'required|string|email|min:5|max:50|unique:users',
                'password'      =>  'required|string|min:6|max:20',
                'plan_id'       =>  'required'
            ]);
            
            if($isValid->fails()){
                $messages = $isValid->messages();
                return redirect()->route('get_register_route')->withErrors($isValid)->withInput();
            }
            else{

				$random_text_generator = new \IsotopeKit\Utility\RandomTextGenerator();
				$random_token = $random_text_generator->get_random_value_in_string(20);

                // create account
                $user = User::create([
                    'first_name'    =>  $request->input('first_name'),
                    'last_name'     =>  $request->input('last_name'),
                    'email'         =>  $request->input('email'),
                    'password'      =>  bcrypt($request->input('password')),
                    'email_token'   =>  $random_token,
                    'enabled'       =>  true,
                    'phone'         =>  $request->input('phone')
                ]);

                $plan_id = json_encode($request->input('plan_id'));
                // save role
                $save_role = User_Role::create([
                    'user_id'	=>	$user->id,
                    'levels'    => '["1",'.$plan_id.']', // by default user with 'basic' plan
                ]);

                // send email
                // if($user)
                // {
                //     $data = [
                //         'email' =>  $request->input('email'),
                //         'name'  =>  $request->input('first_name'),
                //         'code'  =>  $random_token
                //     ];

                //     $emails_to = array(
                //         'email' => $request->input('email'),
                //         'name' => $request->input('first_name')
                //     );
                    
                //     Mail::send('emails.welcome', $data, function($message) use ($emails_to)
                //     {
                //         $message->to($emails_to['email'], $emails_to['name'])->subject('Welcome To AHP');
                //     });
                // }

                // send signup email
                MailSend_SignUp::dispatch($user->id);

                $user = User::where('email', $request->input('email'))->first();
                if($user)
                {
                    Auth::loginUsingId($user->id);
                }

                // redirect to login page with message
                return redirect()->route('get_admin_login_route')->with('status.success', 'Account Created, Please check email to activate account');
            }
        }
        catch(\Exception $ex)
        {
            // log error to database
            return $ex;
            return redirect('/register')->with('status.error', 'Something went wrong, try again later');
        }
    }

    public function getReset(Request $request)
	{
		return view('account.reset');
	}

    public function getVerify(Request $request)
    {
        $email = "";
        $code = "";

        if($request->filled('email'))
        {
            $email = $request->input('email');    
        }

        if($request->filled('code'))
        {
            $code = $request->input('code');
        }

        return view('account.verify')->with('email', $email)->with('code', $code);
    }

    public function postVerify(Request $request)
    {
        try{
            // validate
            $isValid =  Validator::make($request->all(), [
                'email' =>  'required|string|email|min:5|max:50',
                'code'  =>  'required'
            ]);
            
            if($isValid->fails()){
                $messages = $isValid->messages();
                return redirect()->route('get_admin_verify_route')->withErrors($isValid)->withInput();
            }
            else
            {
                $user = User::where('email', $request->input('email'))->first();
                if($user)
                {
                    if($user->email_token == $request->input('code'))
                    {
                        // verify
                        User::where('email', $request->input('email'))->update([
                            'enabled'   =>  true
                        ]);

                        return redirect($request->header('Referer'))
                            ->with('status.success', 'Email Verified & Account Enabled');
                    }
                    else
                    {
                        return redirect($request->header('Referer'))
                            ->with('email', $request->input('email'))
                            ->with('code', $request->input('code'))
                            ->with('status.error', 'Not Valid');
                    }
                }
            }
        }
        catch(\Exception $ex)
        {
            return redirect($request->header('Referer'))
                            ->with('email', $request->input('email'))
                            ->with('code', $request->input('code'))
                            ->with('status.error', 'Not Valid');
        }
    }
}
