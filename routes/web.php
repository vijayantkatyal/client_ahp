<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemberController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;

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

Route::get('/', [GuestController::class, 'getIndex'])->name('get_index');
Route::get('/about', [GuestController::class, 'getAbout'])->name('get_about');
Route::get('/contact', [GuestController::class, 'getContact'])->name('get_contact');
Route::get('/events', [GuestController::class, 'getEvents'])->name('get_events');
Route::get('/event/{id}', [GuestController::class, 'getEventDetails'])->name('get_event_details');

Route::get('/forms', [GuestController::class, 'getForms'])->name('get_forms');
Route::get('/calendar', [GuestController::class, 'getCalendar'])->name('get_calendar');
Route::get('/calendar/school', [GuestController::class, 'getCalendarSchool'])->name('get_calendar_school');
Route::get('/calendar/director-duty', [GuestController::class, 'getCalendarDirectorDuty'])->name('get_calendar_director_duty');

Route::get('/form/registration', [GuestController::class, 'getFormRegistration'])->name('get_form_registration');
Route::post('/form/registration', [GuestController::class, 'postFormRegistration'])->name('post_form_registration');

Route::get('/form/membership', [GuestController::class, 'getFormMembership'])->name('get_form_membership');
Route::post('/form/membership', [GuestController::class, 'postFormMembership'])->name('post_form_membership');

Route::get('/mission', [GuestController::class, 'getMission'])->name('get_mission');

Route::get('/team', [GuestController::class, 'getTeam'])->name('get_team');
Route::get('/gallery', [GuestController::class, 'getGallery'])->name('get_gallery');

Route::post('/logout', [AdminController::class, 'postLogout'])->name('post_logout_route');
Route::get('/dashboard', [AccountController::class, 'getIndex'])->name('get_dashboard_index');

Route::group(
	[
		'prefix'		=>	'/',
		'middleware'	=>	['guest']
	],
	function () {
		Route::get('/login', [AccountController::class, 'getLogin'])->name('get_admin_login_route');
        Route::post('/login', [AccountController::class, 'postLogin'])->name('post_login_route');
        
        Route::get('/register', [AccountController::class, 'getRegister'])->name('get_admin_register_route');
		Route::post('/register', [AccountController::class, 'postRegister'])->name('post_register_route');

		Route::get('/reset', [AccountController::class, 'getReset'])->name('get_admin_reset_route');

		Route::get('/verify', [AccountController::class, 'getVerify'])->name('get_admin_verify_route');
		Route::post('/verify', [AccountController::class, 'postVerify'])->name('post_admin_verify_route');
    }
);

// super admin
// 0
Route::group(
	[
		'prefix'		=>	'admin',
		'middleware'	=>	['admin']
	],
    function () {

        Route::get('/', [AdminController::class, 'index'])->name('get_admin_index');
		Route::post('/logout', [AdminController::class, 'postLogout'])->name('post_admin_logout_route');

		// users
		Route::get('/users', [AdminController::class, 'getUsers'])->name('get_admin_users_index');

		// users/create (post)
		Route::post('/users/add', [AdminController::class, 'postAddUser'])->name('post_admin_users_add');

		// edit user
		Route::get('/users/edit/{id}', [AdminController::class, 'getEditUser'])->name('get_admin_users_edit');

		// edit user (post)
		Route::post('/users/edit/{id}', [AdminController::class, 'postEditUser'])->name('post_admin_users_edit');

		// profile pic
		Route::post('/users/edit-pic', [AdminController::class, 'postEditUserPic'])->name('post_admin_users_edit_pic');

		// profile pic
		Route::post('/users/edit-hourly-rate', [AdminController::class, 'postEditUserHourlyRate'])->name('post_admin_users_edit_hourly_rate');

		// change user password (post)
		Route::post('/users/change-password/{id}', [AdminController::class, 'postChangeUserPassword'])->name('post_admin_users_password');

		// change bonus (post)
		Route::post('/users/change-bonus/{id}', [AdminController::class, 'postChangeUserBonus'])->name('post_admin_users_bonus');

		// access user
		Route::post('/users/access/{id}', [AdminController::class, 'postAccessUser'])->name('post_admin_users_access');

		// user status (post)
		Route::post('/users/change_status/{id}', [AdminController::class, 'postChangeUserStatus'])->name('post_admin_users_edit_status');
		// user delete
		Route::post('/users/delete/{id}', [AdminController::class, 'postDeleteUser'])->name('post_admin_users_delete');

		// reset user
		Route::post('/users/reset/{id}', [AdminController::class, 'postResetUser'])->name('post_admin_users_reset');

		// delete users
		Route::post('/users/delete-multiple', [AdminController::class, 'postDeleteMultipleUser'])->name('post_admin_users_delete_multiple');

		// disable users
		Route::post('/users/disable-multiple', [AdminController::class, 'postDisableMultipleUser'])->name('post_admin_users_disable_multiple');

		Route::post('/users/plan-multiple', [AdminController::class, 'postPlanMultipleUser'])->name('post_admin_users_plan_multiple');

		// admin settings
		Route::get('/settings', [AdminController::class, 'getSettings'])->name('get_admin_settings');

		// admin settings general (post)
		Route::post('/settings-general', [AdminController::class, 'postSettingsGeneral'])->name('post_admin_settings_general');

		// admin settings email (post)
		Route::post('/settings-email', [AdminController::class, 'postSettingsEmail'])->name('post_admin_settings_email');

		// admin settings domain (post)
		Route::post('/settings-domain', [AdminController::class, 'postSettingsDomain'])->name('post_admin_settings_domain');

		// admin settings password (post)
		Route::post('/settings-password', [AdminController::class, 'postSettingsPassword'])->name('post_admin_settings_password');
        
        // courses
        
        Route::get('/courses', [AdminController::class, 'getCourses'])->name('get_admin_courses_all');
        Route::post('/course', [AdminController::class, 'postCourse'])->name('post_admin_course');
		// edit
		Route::get('/course/edit/{id}', [AdminController::class, 'getEditCourse'])->name('get_admin_course_edit');
		Route::post('/course/edit/{id}', [AdminController::class, 'postEditCourse'])->name('post_admin_course_edit');
		// delete
		Route::post('/courses/delete-multiple', [AdminController::class, 'postDeleteMultipleCourses'])->name('post_admin_courses_delete_multiple');

        // classes
        // add
        Route::get('/classes', [AdminController::class, 'getClasses'])->name('get_admin_classes_all');
        Route::post('/class', [AdminController::class, 'postClass'])->name('post_admin_class');
		Route::post('/classes/delete-multiple', [AdminController::class, 'postDeleteMultipleClass'])->name('post_admin_classes_delete_multiple');
		Route::post('/users/class-multiple', [AdminController::class, 'postClassMultipleUser'])->name('post_admin_users_class_multiple');
        Route::get('/classes-by-course-id', [AdminController::class, 'getClassesByCourseId'])->name('get_classes_by_course_id');
        // edit
        Route::get('/class/edit/{id}', [AdminController::class, 'getEditClass'])->name('get_admin_class_edit');
        Route::post('/class/edit', [AdminController::class, 'postEditClass'])->name('post_admin_class_edit');
        // manage
        Route::get('/class/manage/{id}', [AdminController::class, 'getManageClass'])->name('get_admin_class_manage');
        Route::post('/add-class-to-user', [AdminController::class, 'postAddClassToUser'])->name('post_class_to_course');
		Route::get('/remove-class-from-user/{id}', [AdminController::class, 'getRemoveClassFromUser'])->name('get_remove_class_from_user');
        Route::get('/class/attendance/{id}', [AdminController::class, 'getAttendanceClass'])->name('get_admin_class_attendance');
		Route::get('/class/staff-attendance/{id}', [AdminController::class, 'getStaffAttendanceClass'])->name('get_admin_staff_class_attendance');

		// resources
		Route::get('/class/resources/{id}', [AdminController::class, 'getResourcesClass'])->name('get_admin_class_resources');
		Route::post('/add-class-resource-photos', [AdminController::class, 'postAddClassResourcePhotos'])->name('post_add_class_resource_photos');
		Route::post('/add-class-resource-videos', [AdminController::class, 'postAddClassResourceVideos'])->name('post_add_class_resource_videos');
		Route::post('/add-class-resource-docs', [AdminController::class, 'postAddClassResourceDocs'])->name('post_add_class_resource_docs');
		Route::post('/add-class-resource-note', [AdminController::class, 'postAddClassResourceNote'])->name('post_add_class_resource_note');
		Route::get('/class-resource/note/{id}', [AdminController::class, 'getResourcesClassNote'])->name('get_admin_class_note');
		Route::get('/class-resource-delete/{id}', [AdminController::class, 'getResourcesDelete'])->name('get_admin_class_resource_delete');

		// assignments
		Route::get('/class/assignments/{id}', [AdminController::class, 'getAssignmentsClass'])->name('get_admin_class_assignments');
		Route::post('/add-class-assignment-file', [AdminController::class, 'postAddClassAssignmentFile'])->name('post_add_class_assignment_file');
		Route::post('/add-class-assignment-note', [AdminController::class, 'postAddClassAssignmentNote'])->name('post_add_class_assignment_note');
		Route::get('/class-assignment/note/{id}', [AdminController::class, 'getAssignmentClassNote'])->name('get_admin_class_assignment_note');
		Route::get('/class-assignment-delete/{id}', [AdminController::class, 'getAssignmentDelete'])->name('get_admin_class_assignment_delete');

		Route::post('/assign-class-assignment', [AdminController::class, 'postAssignClassAssignment'])->name('post_assign_class_assignment');

		// submissions
		Route::get('/class/assignment-submissions/{id}', [AdminController::class, 'getAssignmentSubmissions'])->name('get_admin_assignments_submissions');
		Route::get('/class/assignment-submission-detail/{id}', [AdminController::class, 'getAssignmentSubmissionDetail'])->name('get_admin_assignment_submission_detail');
		Route::post('/class/assignment-message', [AdminController::class, 'postAssignmentMessage'])->name('post_admin_assignment_message');
		
		Route::post('/class/assignment-accept', [AdminController::class, 'postAssignmentAccept'])->name('post_admin_assignment_accept');

        // attendance
        // get
        Route::get('/g-attendance', [AdminController::class, 'getAttendanceSingle'])->name('get_amin_class_attendance_single');
        // post
        Route::post('/g-attendance', [AdminController::class, 'postAttendanceSingle'])->name('post_amin_class_attendance_single');

		Route::post('/g-attendance-hours', [AdminController::class, 'postAttendanceSingleHours'])->name('post_amin_class_attendance_single_hours');

		// report single
		Route::get('/report/pdf/{uid}/{cid}', [AdminController::class, 'getReportPDFDownload'])->name('get_admin_download_report_pdf_student');
		Route::get('/report/excel/{uid}/{cid}', [AdminController::class, 'getReportExcelDownload'])->name('get_admin_download_report_excel_student');

		// report multiple
		Route::get('/report/mpdf{cid}', [AdminController::class, 'getReportPDFMDownload'])->name('get_admin_download_report_pdf_m_student');
		Route::get('/report/mexcel/{cid}', [AdminController::class, 'getReportExcelMDownload'])->name('get_admin_download_report_excel_m_student');

		// reg forms
		Route::get('/forms/registration', [AdminController::class, 'getFormsRegistration'])->name('get_admin_forms_registration');
		Route::get('/forms/reg/{id}/detail', [AdminController::class, 'getFormsRegistrationDetail'])->name('get_admin_forms_registration_detail');
		Route::post('/forms/reg', [AdminController::class, 'postFormsRegistrationDetail'])->name('post_admin_forms_registration_detail');

		// mem forms
		Route::get('/forms/membership', [AdminController::class, 'getFormsMembership'])->name('get_admin_forms_membership');
		Route::get('/forms/mem/{id}/detail', [AdminController::class, 'getFormsMembershipDetail'])->name('get_admin_forms_membership_detail');
		// Route::post('/forms/mem', [AdminController::class, 'postFormsMembershipDetail'])->name('post_admin_forms_membership_detail');

		// terms
		Route::get('/terms/field', [AdminController::class, 'getFieldTerms'])->name('get_admin_field_terms');
		Route::get('/terms/signup', [AdminController::class, 'getSignUpTerms'])->name('get_admin_signup_terms');

		Route::post('/terms/{type}', [AdminController::class, 'postTerm'])->name('post_admin_terms');

		// calendar
		Route::get('/calendar/school', [AdminController::class, 'getSchoolCalendar'])->name('get_admin_school_calendar');
		Route::post('/calendar/school-event', [AdminController::class, 'postSchoolCalendarEvent'])->name('post_admin_school_calendar_event');
		Route::get('/calendar/edit/school-event/{id}', [AdminController::class, 'getEditSchoolCalendarEvent'])->name('get_admin_school_calendar_event_edit');
		Route::post('/calendar/edit-school-event', [AdminController::class, 'postEditSchoolCalendarEvent'])->name('post_admin_school_calendar_event_edit');
		Route::post('/calendar/delete-school-event/{id}', [AdminController::class, 'postDeleteSchoolCalendarEvent'])->name('post_admin_school_calendar_event_delete');
		
		Route::get('/calendar/director', [AdminController::class, 'getDirectorCalendar'])->name('get_admin_director_calendar');
		Route::post('/calendar/director-event', [AdminController::class, 'postDirectorCalendarEvent'])->name('post_admin_director_calendar_event');
		Route::get('/calendar/edit/director-event/{id}', [AdminController::class, 'getEditDirectorCalendarEvent'])->name('get_admin_director_calendar_event_edit');
		Route::post('/calendar/edit-director-event', [AdminController::class, 'postEditDirectorCalendarEvent'])->name('post_admin_director_calendar_event_edit');
		Route::post('/calendar/delete-director-event/{id}', [AdminController::class, 'postDeleteDirectorCalendarEvent'])->name('post_admin_director_calendar_event_delete');
		
		Route::get('/events', [AdminController::class, 'getSchoolEvents'])->name('get_admin_school_events');
		Route::post('/school-event', [AdminController::class, 'postSchoolEvent'])->name('post_admin_school_event');
		Route::get('/edit-school-event/{id}', [AdminController::class, 'getEditSchoolEvent'])->name('get_admin_school_event_edit');
		Route::post('/edit-school-event', [AdminController::class, 'postEditSchoolEvent'])->name('post_admin_school_event_edit');
		Route::post('/delete-school-event/{id}', [AdminController::class, 'postDeleteSchoolEvent'])->name('post_admin_school_event_delete');

		Route::post('/add-school-event-photos', [AdminController::class, 'postEditSchoolEventPhotos'])->name('post_admin_school_event_photos');
		Route::get('/delete-school-event-photo/{id}', [AdminController::class, 'getDeleteSchoolEventPhoto'])->name('get_admin_school_event_photo_delete');

    }
);

// board member
// 2

// principal
// 3

// teacher
// 4

// Route::group(
// 	[
// 		'prefix'		=>	'staff',
// 		'middleware'	=>	['staff']
// 	],
// 	function () {
// 		Route::get('/', [StaffController::class, 'index'])->name('get_staff_index');

// 		// agency settings
// 		Route::get('/settings', [StaffController::class, 'getSettings'])->name('get_staff_settings');

// 		// agency settings general (post)
// 		Route::post('/settings-general', [StaffController::class, 'postSettingsGeneral'])->name('post_staff_settings_general');

// 		// agency settings password (post)
// 		Route::post('/settings-password', [StaffController::class, 'postSettingsPassword'])->name('post_staff_settings_password');
// 	}
// );

// user
// 1
Route::group(
	[
		'prefix'		=>	'/',
		'middleware'	=>	['user']
	],
	function () {
		Route::get('/user', [UserController::class, 'getIndex'])->name('get_student_index');
		Route::post('/settings-general', [StudentController::class, 'postSettingsGeneral'])->name('post_user_settings_general');
		Route::post('/settings-password', [StudentController::class, 'postSettingsPassword'])->name('post_user_settings_password');
    }
);

// student
// 5
Route::group(
	[
		'prefix'		=>	'student',
		'middleware'	=>	['student']
	],
	function () {
        Route::get('/', [StudentController::class, 'getIndex'])->name('get_user_index');
		Route::get('/assignment/{id}', [StudentController::class, 'getAssignment'])->name('get_user_assignment');

		Route::post('/assignment-file', [StudentController::class, 'postAssignmentFile'])->name('post_assignment_file');
		Route::post('/assignment-note', [StudentController::class, 'postAssignmentNote'])->name('post_assignment_note');

		Route::post('/assignment-message', [StudentController::class, 'postAssignmentMessage'])->name('post_assignment_message');
    }
);

// general member
// 6
Route::group(
	[
		'prefix'		=>	'member',
		'middleware'	=>	['member']
	],
	function () {
        Route::get('/', [MemberController::class, 'getIndex'])->name('get_member_index_s');
    }
);