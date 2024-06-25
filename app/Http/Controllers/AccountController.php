<?php

namespace App\Http\Controllers;

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
				
                    if(Auth::user()->isAdmin() === true)
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
}
