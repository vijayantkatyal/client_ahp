<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->longText('appointment_url')->nullable();
            $table->string('phone')->nullable();
            $table->longText('address')->nullable();
            $table->longText('maps_link')->nullable();

            $table->boolean('hide_top_alert_bar')->default(false)->nullable();
            $table->longText('custom_top_alert_bar_text')->nullable();

            $table->string('working_hours_mon_thu')->nullable();
            $table->string('working_hours_friday')->nullable();
            $table->string('working_hours_sat_sun')->nullable();

            $table->string('social_link_facebook')->nullable();
            $table->string('social_link_instagram')->nullable();
            $table->string('social_link_linkedin')->nullable();
            $table->string('social_link_twitter')->nullable();

            $table->longText('analytics_code')->nullable();

            $table->longText('custom_style')->nullable();
            $table->longText('custom_script')->nullable();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // general / service / custom
            $table->boolean('show_in_top_menu')->default(false)->nullable();
            $table->boolean('show_in_footer')->default(false)->nullable();

            $table->longText('title')->nullable();
            $table->string('summary')->nullable();
            $table->string('image')->nullable();
            $table->longText('content')->nullable();
            $table->longText('page_schema')->nullable();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('title');
            $table->string('image')->nullable();
            $table->string('summary')->nullable();
            $table->longText('content')->nullable();
            
            $table->boolean('published')->default(false)->nullable();
            $table->string('created_at')->nullable();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->longText('message');
            $table->string('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('appointment_url');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('maps_link');

            $table->dropColumn('hide_top_alert_bar');
            $table->dropColumn('custom_top_alert_bar_text');

            $table->dropColumn('working_hours_mon_thu');
            $table->dropColumn('working_hours_friday');
            $table->dropColumn('working_hours_sat_sun');

            $table->dropColumn('social_link_facebook');
            $table->dropColumn('social_link_instagram');
            $table->dropColumn('social_link_linkedin');
            $table->dropColumn('social_link_twitter');


            $table->dropColumn('analytics_code');

            $table->dropColumn('custom_style');
            $table->dropColumn('custom_script');
        });

        Schema::dropIfExists('pages');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('messages');
    }
}
