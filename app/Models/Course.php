<?php

namespace App\Models;

use App\Models\CourseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function getStudentsInfo($course, $user){

        $query = "SELECT p.created_at, p.amount FROM courses c
            INNER JOIN course_users cu ON c.id = cu.course_id
            INNER JOIN users u ON u.id = cu.user_id
            INNER JOIN payments p ON p.course_user_id = cu.id
            WHERE cu.course_id = $course
            AND cu.user_id = $user";
// dd($query);
        return DB::select($query);
    }






    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->hasManyThrough(User::class, CourseUser::class, 'course_id', 'id', null, 'user_id');
    }

    public function payments_received()
    {
        return $this->hasManyThrough(Payment::class, CourseUser::class, 'course_id', 'course_user_id');
    }
}
