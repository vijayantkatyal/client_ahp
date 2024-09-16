<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

	public $remember_token = false;

	protected $fillable = [
		'email', 'password', 'first_name', 'last_name', 'email_token', 'enabled', 'created_by', 'phone'
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function isAdmin()
	{
		$data = User_Role::where('user_id', $this->id)->first();

		if ($data) {
			// TODO get from levels table
			$level = '0';

			if (in_array($level, json_decode($data->levels))) {
				return true;
			}
		}

		return false;
	}

	public function isUser()
	{
		$data = User_Role::where('user_id', $this->id)->first();

		if ($data) {
			// TODO get from levels table
			$level = '1';

			if (in_array($level, json_decode($data->levels))) {
				// get level details
				return true;
			}
		}

		return false;
	}

	public function isTeamOnly()
    {
        $data = User_Role::where('user_id', $this->id)->first();

        if ($data) {
            // TODO get from levels table
            $level = '101';

            if (in_array($level, json_decode($data->levels))) {
                return true;
            }
        }

        return false;
    }

	public function isStudent()
	{
		$data = User_Role::where('user_id', $this->id)->first();

		if ($data) {
			// TODO get from levels table
			$level = '5';

			if (in_array($level, json_decode($data->levels))) {
				// check if agency
				// $user_level_id = json_decode($data->levels)[1];
				// get level details
				if ($this->created_by == "direct") {
					return true;
				}
			}
		}

		return false;
	}

	public function isMember()
	{
		$data = User_Role::where('user_id', $this->id)->first();

		if ($data) {
			// TODO get from levels table
			$level = '6';

			if (in_array($level, json_decode($data->levels))) {
				// check if agency
				// $user_level_id = json_decode($data->levels)[1];
				// get level details
				if ($this->created_by == "direct") {
					return true;
				}
			}
		}

		return false;
	}

	// staff

	public function isBoardMember()
	{
		$data = User_Role::where('user_id', $this->id)->first();

		if ($data) {
			// TODO get from levels table
			$level = '2';

			if (in_array($level, json_decode($data->levels))) {
				return true;
			}
		}

		return false;
	}

	public function isPrincipal()
	{
		$data = User_Role::where('user_id', $this->id)->first();

		if ($data) {
			// TODO get from levels table
			$level = '3';

			if (in_array($level, json_decode($data->levels))) {
				return true;
			}
		}

		return false;
	}

	public function isTeacher()
	{
		$data = User_Role::where('user_id', $this->id)->first();

		if ($data) {
			// TODO get from levels table
			$level = '4';

			if (in_array($level, json_decode($data->levels))) {
				return true;
			}
		}

		return false;
	}

	public function isAgency()
	{
		$user_levels = User_Role::where('user_id', $this->id)->first();

		if ($user_levels) {
			if (array_key_exists('1', json_decode($user_levels->levels))) {
				// get user level
				$user_level_id = json_decode($user_levels->levels)[1];

				// get level details
				$level_details = Levels::where('id', $user_level_id)->first();

				if ($level_details) {
					if ($level_details->enable_agency) {
						// echo $level_details->id ."--". $this->created_by;
						// if($level_details->id === $this->created_by)
						if ($this->created_by != "direct") {
							return false;
						}

						return true;
					}
				}
			}
		}

		return false;
	}

	public function levelInfo()
	{
		$data = User_Role::where('user_id', $this->id)->first();
        if($data)
        {
            if(array_key_exists(1, json_decode($data->levels)))
            {
                $user_level_id = json_decode($data->levels)[1];

				$level_info = Levels::where('id', $user_level_id)->first();
                if($level_info)
                {
					return $level_info;
				}
			}
		}
	}
}
