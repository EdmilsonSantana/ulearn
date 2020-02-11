<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CourseRating extends Model
{
    protected $table = 'course_ratings';
    protected $guarded = array();

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


    public static function get_course_rating($course_id, $user_id)
    {
        return  CourseRating::where('course_id', $course_id)->where('user_id', $user_id)->first();
    }
}
