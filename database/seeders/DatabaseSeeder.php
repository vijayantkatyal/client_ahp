<?php

namespace Database\Seeders;

use App\Models\Levels;
use App\Models\Site;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::insert([
			"first_name"	=> "Super",
			"last_name" 	=> "Admin",
			"email"			=> "admin@gmail.com",
			"enabled"		=> true,
			'password'		=> bcrypt('password'),
		]);

		User_Role::insert([
			'user_id'	=>	'1',
			'levels'	=>	'["0"]'
		]);

		Site::insert([
			'language'	=>	'en',
			'theme'		=>	'blue',
			'name'		=>	'IsotopeKit',
			'agency_id'	=>	'1'
		]);

		Levels::insert([
			'name'			=>	'core',
			'valid_time'	=>	'365',
			'enabled'		=> 	false
		]);
    }
}
