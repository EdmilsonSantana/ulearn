<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseRating;
use App\Models\InstructionLevel;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
use SiteHelpers;
use Crypt;
use App\Library\VideoHelpers;
use URL;
use App\Models\CourseVideos;
use App\Models\CourseFiles;
use Session;


class CourseFileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Course();
    }

    public function courseFileServe($course_slug, $file_name) {
        $course = $this->model->where('course_slug', $course_slug)->first();

        $file_path = 'course/' . $course->id . '/' . $file_name;

        if (!Storage::exists($file_path)){
            abort('404'); 
        } 
       
        return response()->file(storage_path('app'.DIRECTORY_SEPARATOR.($file_path)));
   
    }
}
