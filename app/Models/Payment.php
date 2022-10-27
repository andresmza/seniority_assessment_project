<?php

namespace App\Models;

use App\Models\CourseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function course_user()
    {
        return $this->belongsTo(CourseUser::class, 'course_user_id');
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, CourseUser::class, 'id', 'id', 'course_user_id', 'user_id');
    }

    public function course()
    {
        return $this->hasOneThrough(Course::class, CourseUser::class, 'id', 'id', 'course_user_id', 'course_id');
    }
}
