<?php

namespace App\Models;

use App\Models\CourseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];


    public static function getStudentsInfo($course, $user){

        $query = "SELECT p.created_at, p.amount FROM courses c
            INNER JOIN course_users cu ON c.id = cu.course_id
            INNER JOIN users u ON u.id = cu.user_id
            INNER JOIN payments p ON p.course_user_id = cu.id
            WHERE cu.course_id = $course
            AND cu.user_id = $user";

        return DB::select($query);
    }

    public static function availableCourses($student){
        $query = "SELECT c.id, s.name as subject, u.name, u.lastname, c.start_date, c.end_date, cu.user_id, s.price FROM courses c
        LEFT JOIN course_users cu ON c.id = cu.course_id
        LEFT JOIN subjects s ON s.id = c.subject_id
        LEFT JOIN users u ON u.id = c.teacher_id
        WHERE (cu.user_id != $student
        OR cu.user_id IS NULL)
        AND c.deleted_at IS NULL
        GROUP BY c.id";

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
