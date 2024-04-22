<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use IsotopeKit\AuthAPI\Http\Controllers\AuthController as auth_api_auth_controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/  

Route::get('/', [AccountController::class, 'getIndex'])->name('get_index');
Route::get('/about', [AccountController::class, 'getAbout'])->name('get_about');
Route::get('/contact', [AccountController::class, 'getContact'])->name('get_contact');
Route::get('/events', [AccountController::class, 'getEvents'])->name('get_events');
Route::get('/forms', [AccountController::class, 'getForms'])->name('get_forms');

Route::get('/mission', [AccountController::class, 'getMission'])->name('get_mission');

Route::get('/team', [AccountController::class, 'getTeam'])->name('get_team');
Route::get('/gallery', [AccountController::class, 'getGallery'])->name('get_gallery');

Route::group(
	[
		'prefix'		=>	config('isotopekit_admin.route_prefix'),
		'middleware'	=>	['guest']
	],
	function () {
		Route::get('/login', [AccountController::class, 'getLogin'])->name('get_login_route');
    }
);

Route::group(
	[
		'prefix'		=>	config('isotopekit_admin.route_admin'),
		'middleware'	=>	['admin']
	],
    function () {
        
        // courses
        
        Route::get('/courses', [AdminController::class, 'getCourses'])->name('get_admin_courses_all');
        Route::post('/course', [AdminController::class, 'postCourse'])->name('post_admin_course');

        // classes
        // add
        Route::get('/classes', [AdminController::class, 'getClasses'])->name('get_admin_classes_all');
        Route::post('/class', [AdminController::class, 'postClass'])->name('post_admin_class');
        Route::get('/classes-by-course-id', [AdminController::class, 'getClassesByCourseId'])->name('get_classes_by_course_id');
        // edit
        Route::get('/class/edit/{id}', [AdminController::class, 'getEditClass'])->name('get_admin_class_edit');
        Route::post('/class/edit', [AdminController::class, 'postEditClass'])->name('post_admin_class_edit');
        // manage
        Route::get('/class/manage/{id}', [AdminController::class, 'getManageClass'])->name('get_admin_class_manage');
        Route::post('/add-class-to-user', [AdminController::class, 'postAddClassToUser'])->name('post_class_to_course');
        Route::get('/class/attendance/{id}', [AdminController::class, 'getAttendanceClass'])->name('get_admin_class_attendance');

        // attendance
        // get
        Route::get('/g-attendance', [AdminController::class, 'getAttendanceSingle'])->name('get_amin_class_attendance_single');
        // post
        Route::post('/g-attendance', [AdminController::class, 'postAttendanceSingle'])->name('post_amin_class_attendance_single');
    }
);

Route::group(
	[
		'prefix'		=>	'user',
		'middleware'	=>	['user']
	],
	function () {
        Route::get('/', [UserController::class, 'getIndex'])->name('get_user_index_s');
        Route::get('/overview', [UserController::class, 'getIndex'])->name('get_user_index');

        Route::post('/logout', [auth_api_auth_controller::class, 'postLogout'])->name('post_logout_route');

		Route::post('/settings-general', [UserController::class, 'postSettingsGeneral'])->name('post_user_settings_general');
		Route::post('/settings-password', [UserController::class, 'postSettingsPassword'])->name('post_user_settings_password');
    }
);