<?php

namespace App\Jobs;

use Config;
use App\Alerts;
use App\Models\Site;
use App\Models\Terms;
use App\Models\User;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Mail;

use Illuminate\Support\Facades\DB;

class MailSend_SignUp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $user_id;

    public function __construct($user_id)
    {
		$this->user_id = $user_id;
	}

	public function handle()
	{
		Log::channel('mail')->info("started mail task");

        $user = User::where('id', $this->user_id)->first();
        if($user)
        {

            Log::channel('mail')->info("send mail to: " . $user->email);

            $get_site_settings = DB::table('site_settings')->where('id', '1')->first();
            if($get_site_settings != null)
            {
                $site_settings = $get_site_settings;
            }

            Config::set('mail.encryption',$site_settings->encryption);
            Config::set('mail.host', $site_settings->host);
            Config::set('mail.port', $site_settings->port);
            Config::set('mail.username', $site_settings->username);
            Config::set('mail.password', $site_settings->password);
            Config::set('mail.from',  ['address' => $site_settings->from_address , 'name' => $site_settings->from_name]);
            
            $signup = Terms::where('type', 'signup')->first();

            if($signup)
            {
                $data = [
                    'email' =>  $user->email,
                    'name'  =>  $user->first_name,
                    'body'  =>  $signup->terms
                ];

                $emails_to = array(
                    'email' =>  $user->email,
                    'name'  =>  $user->first_name,
                    'subject'	=>	$signup->title
                );

                Mail::send('emails.signup', $data, function($message) use ($emails_to)
                {
                    $message->to($emails_to['email'], $emails_to['name'])->subject($emails_to['subject']);
                });
            }
        }
		
	}

	public function failed($exception)
    {
        Log::channel('mail')->info($exception);
    }

}