<?php

namespace App\Http\Controllers;

use App\Jobs\SaveEmbedding;
use App\Libraries\CaptionsData;
use App\Models\Classes;
use App\Models\Courses;
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
use App\Models\User as ModelsUser;
use App\Models\VidChapterProject;
use Google\Service\StreetViewPublish\Level;
use IsotopeKit\AuthAPI\Models\Levels;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
	public function getCourses()
	{
        $courses = Courses::get();
		return view('admin.courses.all')->with('courses', $courses);
	}

    public function postCourse(Request $request)
    {
        Courses::create([
            'name'  =>  $request->input('name'),
            'added_on'  =>  time()
        ]);

        return redirect($request->header('Referer'))->with('status.success', 'Course Created');
    }

    // classes

    public function getClasses()
	{
        $classes = Classes::get();
        $courses = Courses::get();

        foreach ($classes as $class)
        {
            $course_name = "";

            $get_course = Courses::where('id', $class->course_id)->first();
            if($get_course)
            {
                $course_name = $get_course->name;
            }

            $class->course_name = $course_name;
        }
		
        return view('admin.classes.all')
            ->with('classes', $classes)
            ->with('courses', $courses);
	}

    public function postClass(Request $request)
    {
        Classes::create([
            'name'          =>  $request->input('name'),
            'start_date'    =>  $request->input('start_date'),
            'end_date'      =>  $request->input('end_date'),
            'course_id'     =>  $request->input('course_id'),
            'added_on'      =>  time(),

            'assigned_member_id'    =>  $request->input('assigned_member_id')
        ]);

        return redirect($request->header('Referer'))->with('status.success', 'Class Created');
    }

    public function getEditClass(Request $request, $id)
    {
        $class = Classes::where('id', $id)->first();
        if($class)
        {
            $courses = Courses::get();

            $course_name = "";

            $get_course = Courses::where('id', $class->course_id)->first();
            if($get_course)
            {
                $course_name = $get_course->name;
            }

            $class->course_name = $course_name;
            
            return view('admin.classes.edit')
                ->with('class', $class)
                ->with('courses', $courses);
        }
        else
        {
            return "not found";
        }
    }

    public function postEditClass(Request $request)
    {
        try
        {
            Classes::where('id', $request->input('class_id'))->update([
                'name'  =>  $request->input('name'),
                'start_date'    =>  $request->input('start_date'),
                'end_date'      =>  $request->input('end_date'),
                'course_id'     =>  $request->input('course_id'),

                'assigned_member_id'    =>  $request->input('assigned_member_id')

            ]);

            return redirect($request->header('Referer'))->with('status.success', 'Class Updated');
        }
        catch(\Exception $ex)
        {
            return redirect($request->header('Referer'))->with('status.error', 'Something went wrong');
        }

    }

    public function getManageClass(Request $request, $id)
    {
        // get class info
        $class = Classes::where('id', $id)->first();
        if($class)
        {
            // get all students
            $students = User::where('class_id', $id)->get();

            return view('admin.classes.manage')->with('class', $class)->with('students', $students);
        }
        else
        {
            return "not found";
        }

        // add new student
        // remove student
        // view student report
    }

    public function getClassesByCourseId(Request $request)
    {
        return Classes::where('course_id', $request->get('id'))->get();
    }

    public function postAddClassToUser(Request $request)
    {
        ModelsUser::where('id', $request->input('user_id'))->update([
            'course_id' =>  $request->input('course_id'),
            'class_id'  =>  $request->input('class_id')
        ]);
        return redirect($request->header('Referer'))->with('status.success', 'Class Info Updated');
    }
}