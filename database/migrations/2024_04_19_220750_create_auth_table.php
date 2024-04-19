<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 15);
            $table->string('last_name', 15);
            $table->string('email', 30)->unique();
            $table->string('password', 100);
            $table->string('timezone', 20)->default('Asia/Kolkata');
            $table->string('language', 10)->default('en');
            $table->string('created_by', 20)->default('direct');
            $table->boolean('enabled')->default(false);
            $table->string('email_token', 20)->nullable();
            $table->string('reset_token', 20)->nullable();
            $table->longText('team_access')->nullable();

            $table->string('total_users', 3)->nullable();
            $table->timestamp('trial_ends_at')->nullable();

            // branding
            $table->boolean('remove_branding')->default(false)->nullable();
            $table->boolean('custom_branding')->default(false)->nullable();

			// team
			$table->boolean('enable_team')->default(false)->nullable();
			$table->string('team_members', 5)->nullable();

			// custom domains
			$table->boolean('enable_custom_domains')->default(false)->nullable();
			$table->string('custom_domains', 5)->nullable();

            $table->longText('custom_properties')->nullable();

            $table->string('code_used_one')->nullable();
			$table->string('code_used_two')->nullable();
			$table->string('code_used_three')->nullable();
			$table->string('code_used_four')->nullable();
			$table->string('code_used_five')->nullable();

            $table->timestamps();
        });

		// user roles
		Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 10);
            $table->string('levels', 50)->default('["1"]');
            $table->timestamps();
        });

		// levels / plans
		Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('price', 5)->nullable();
			$table->boolean('enabled')->default(true);
			$table->string('valid_time', 5)->nullable()->default("31");

			// branding
            $table->boolean('remove_branding')->default(false)->nullable();
            $table->boolean('custom_branding')->default(false)->nullable();

			// team
			$table->boolean('enable_team')->default(false)->nullable();
			$table->string('team_members', 5)->nullable();

			// custom domains
			$table->boolean('enable_custom_domains')->default(false)->nullable();
			$table->string('custom_domains', 5)->nullable();

			// agency
			$table->boolean('enable_agency')->default(false)->nullable();
			$table->string('agency_members', 5)->nullable();

			// agency team
			$table->boolean('agency_enable_team')->default(false)->nullable();
			$table->string('agency_team_members', 5)->nullable();

			// agency custom domains
			$table->boolean('agency_enable_custom_domains')->default(false)->nullable();
			$table->string('agency_custom_domains', 5)->nullable();

            $table->longText('custom_properties')->nullable();
			$table->longText('agency_custom_properties')->nullable();

            // add columns based on features here
			// user
			// client

            $table->timestamps();
        });

		// agency / whitelabel
		Schema::create('site_settings', function ($table) {
            $table->increments('id');
			$table->string('agency_id', 5)->nullable();
            $table->string('name', 20);
            $table->string('language', 5)->default('en');
            $table->string('theme', 10)->default('blue');
            $table->string('unique_name', 20)->nullable();
            $table->string('support_url', 50)->nullable();
            $table->longText('page_description')->nullable();
            $table->string('external_url', 50)->nullable();
			$table->string('support_email', 50)->nullable();
			$table->boolean('show_training_url')->default(false)->nullable();
			$table->string('training_url', 50)->nullable();

            $table->string('encryption', 10)->nullable();
            $table->string('host', 20)->nullable();
            $table->string('port', 5)->nullable();
            $table->string('username', 20)->nullable();
            $table->string('password', 20)->nullable();
            $table->string('from_address', 50)->nullable();
            $table->string('from_name', 20)->nullable();
            
			$table->string('favicon', 50)->nullable();
			$table->string('logo', 50)->nullable();

			$table->boolean('show_plan_info')->nullable()->default(true);
            $table->string('password', 200)->nullable()->change();

            $table->boolean('checked')->default(false)->nullable();
			$table->boolean('has_error')->default(false)->nullable();
			$table->boolean('is_secured')->default(false)->nullable();

            // colors
			$table->string('navbar_link_color')->default('#6c757d')->nullable();
			$table->string('navbar_active_color')->default('#727cf5')->nullable();
			
			$table->string('primary_btn_bg_color')->default('#727cf5')->nullable();
			$table->string('primary_btn_txt_color')->default('#fff')->nullable();
			
			$table->string('bg_color')->default('#fafbfe')->nullable();
			$table->string('progress_bar_color')->default('#d72630')->nullable();

			// login
			$table->longText('login_custom_css')->nullable();
			$table->longText('login_custom_js')->nullable();

			$table->text('login_custom_header')->nullable();
			$table->text('login_custom_footer')->nullable();

			// user
			$table->longText('user_custom_css')->nullable();
			$table->longText('user_custom_js')->nullable();

			$table->text('user_custom_header')->nullable();
			$table->text('user_custom_footer')->nullable();

			$table->string('login_logo_bg_color')->default('#727cf5')->nullable();
			$table->string('logo_bg_image')->nullable();

			$table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
		Schema::dropIfExists('user_role');
		Schema::dropIfExists('levels');
		Schema::dropIfExists('site_settings');
    }
}