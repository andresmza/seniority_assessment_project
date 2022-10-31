<?php

namespace App\Models;

use App\Models\CourseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];


    public static function getStudentsInfo($course, $user)
    {

        $query = "SELECT p.created_at, p.amount FROM courses c
            INNER JOIN course_users cu ON c.id = cu.course_id
            INNER JOIN users u ON u.id = cu.user_id
            INNER JOIN payments p ON p.course_user_id = cu.id
            WHERE cu.course_id = $course
            AND cu.user_id = $user
            AND cu.deleted_at IS NULL";

        return DB::select($query);
    }

    public static function availableCourses($student)
    {
        $now = now()->addWeeks(-1)->format('Y-m-d');

        $query = "SELECT c.id, s.name as subject, u.name, u.lastname, c.start_date, c.end_date, cu.user_id, s.price FROM courses c
        LEFT JOIN course_users cu ON c.id = cu.course_id
        LEFT JOIN subjects s ON s.id = c.subject_id
        LEFT JOIN users u ON u.id = c.teacher_id
        WHERE c.id NOT IN (SELECT cu.course_id FROM course_users cu WHERE cu.user_id = $student AND cu.deleted_at IS NULL)
        AND c.deleted_at IS NULL
        AND c.start_date > '$now'
        GROUP BY c.id";

        return DB::select($query);
    }

    public static function getEnrolledCourses($studentId)
    {

        $query = "SELECT c.*, cu.*, s.name, 
        CONCAT(u.name, ' ', u.lastname) as teacher,
        GROUP_CONCAT(p.amount) AS amounts,
        GROUP_CONCAT(p.expiration_date) AS expiration_dates,
        GROUP_CONCAT(IFNULL(p.payment_date, 0)) AS payment_dates
        FROM courses c
        LEFT JOIN course_users cu ON cu.course_id = c.id
        LEFT JOIN payments p ON p.course_user_id = cu.id
        LEFT JOIN subjects s ON s.id = c.subject_id
        LEFT JOIN users u ON u.id = c.teacher_id
        WHERE cu.user_id = $studentId
        AND c.deleted_at IS NULL
        AND cu.deleted_at IS NULL
        AND p.teacher_id IS NULL
        GROUP BY c.id DESC
        ";

        return DB::select($query);
    }
    
    public static function getOverlappingCourses($user_id, $course)
    {
        $query = "SELECT count(*) as count FROM courses c
        LEFT JOIN course_users cu ON cu.course_id = c.id
        LEFT JOIN users u ON u.id = cu.user_id
        WHERE cu.user_id = $user_id
        AND cu.deleted_at IS NULL
        AND c.deleted_at IS NULL
        AND (
            ('$course->start_date' <= c.start_date AND '$course->end_date' >= c.end_date) 
            OR ('$course->start_date' >= c.start_date AND '$course->start_date' <= c.end_date)
            OR ('$course->end_date' >= c.start_date AND '$course->end_date' <= c.end_date)
        )
        ";

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
