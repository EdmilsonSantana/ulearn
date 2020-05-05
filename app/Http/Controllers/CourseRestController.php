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


class CourseRestController extends Controller
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

    public function getCategories()
    {
        return response()->json(Category::where('is_active', 1)->limit(7)->get());
    }

    public function getCoursesByCategory($category_id)
    {
        $courses = DB::table('courses')
            ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
            ->selectRaw('AVG(course_ratings.rating) AS average_rating')
            ->leftJoin('course_ratings', 'course_ratings.course_id', '=', 'courses.id')
            ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
            ->join('categories', 'categories.id', '=', 'courses.category_id')
            ->where('courses.is_active', 1)
            ->where('courses.category_id', '=', $category_id)
            ->groupBy('courses.id')
            ->limit(3)
            ->get();

        $courses = $courses->map(function ($course) {
            if (Storage::disk('public')->exists($course->thumb_image)) {
                $course->thumb_image = Storage::disk('public')->url($course->thumb_image);
            }
            return $course;
        });

        $preferences = [
            "default_thumb" => asset('backend/assets/images/course_detail_thumb.jpg'),
            "default_currency" => config('config.default_currency')
        ];

        return response()->json(["data" => $courses, "preferences" => $preferences]);
    }
}
