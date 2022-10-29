<?php

namespace App\Models;

use App\Models\CourseUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public static function getStudentPayments()
    {
        $teacher_id = Auth::user()->id;

        $query = "SELECT CONCAT(u.name, ' ', u.lastname) AS student_name, c.id course_id, s.name AS subject_name, p.amount, p.payment_date, c.deleted_at AS course_deleted_at, p.acredited
        FROM users u
        LEFT JOIN course_users cu ON cu.user_id = u.id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN subjects s ON s.id = c.subject_id
        LEFT JOIN payments p ON p.course_user_id = cu.id
        WHERE p.amount IS NOT NULL
        AND c.teacher_id = $teacher_id
        AND p.payment_date IS NOT NULL
        AND p.teacher_id IS NULL
        ORDER BY p.created_at DESC";

        return DB::select($query);
    }

    public static function getTeacherPayments()
    {
        $teacher_id = Auth::user()->id;

        $query = "SELECT cu.id, cu.deleted_at AS cu_deleted_at, c.deleted_at AS c_deleted_at, s.name, p.amount, p.payment_date FROM payments p
        LEFT JOIN course_users cu ON cu.id = p.course_user_id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN subjects s ON s.id = c.subject_id
        WHERE p.teacher_id = $teacher_id
        ORDER BY p.payment_date DESC";

        return DB::select($query);
    }

    public static function getAllStudentPayments()
    {
        $query = "SELECT CONCAT(u.name, ' ', u.lastname) AS student_name, c.id course_id, s.name AS subject_name, p.amount, p.payment_date, c.deleted_at AS course_deleted_at, p.acredited
        FROM users u
        LEFT JOIN course_users cu ON cu.user_id = u.id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN subjects s ON s.id = c.subject_id
        LEFT JOIN payments p ON p.course_user_id = cu.id
        WHERE p.payment_date IS NOT NULL
        AND p.teacher_id IS NULL
        ORDER BY p.payment_date DESC";

        return DB::select($query);
    }

    public static function getMyPayments()
    {
        $teacher_id = Auth::user()->id;

        $query = "SELECT CONCAT(u.name, ' ', u.lastname) AS student_name, c.id course_id, s.name AS subject_name, p.amount, p.created_at, c.deleted_at AS course_deleted_at
        FROM users u
        LEFT JOIN course_users cu ON cu.user_id = u.id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN subjects s ON s.id = c.subject_id
        LEFT JOIN payments p ON p.course_user_id = cu.id
        WHERE p.amount IS NOT NULL
        AND p.teacher_id IS NULL
        ORDER BY p.created_at DESC";

        return DB::select($query);
    }

    public static function getPaymentsByCourse($course_id)
    {
        $teacher_id = Auth::user()->id;

        $query = "SELECT  u.name, u.lastname, p.payment_date, p.amount, p.acredited FROM payments p
        LEFT JOIN course_users cu ON cu.id = p.course_user_id
        LEFT JOIN users u ON u.id = cu.user_id
        WHERE p.payment_date IS NOT NULL
        AND cu.course_id = $course_id
        AND p.payment_date IS NOT NULL
        AND p.teacher_id IS NULL
        ORDER BY p.payment_date DESC";

        return DB::select($query);
    }

    public static function getPendingPayments()
    {

        $query = "SELECT u.name, u.lastname,
        GROUP_CONCAT(p.id) as ids,
        GROUP_CONCAT(p.amount) as amount
        FROM payments p
        LEFT JOIN course_users cu ON cu.id = p.course_user_id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN users u ON c.teacher_id = u.id
        WHERE p.payment_date IS NOT NULL
        AND p.teacher_id IS NULL
        AND acredited = 0
        GROUP BY u.id";

        return DB::select($query);
    }

    public static function getMyPendingPayments($student_id)
    {
        $firstday = Carbon::now()->firstOfMonth();
        $lastday = Carbon::now()->lastOfMonth();

        $query = "SELECT SUM(p.amount) as pending
        FROM payments p
        LEFT JOIN course_users cu ON cu.id = p.course_user_id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN users u ON u.id = c.teacher_id
        WHERE cu.user_id = $student_id
        AND p.teacher_id IS NULL
        AND p.payment_date IS NULL
        AND p.expiration_date >= '$firstday'
        AND p.expiration_date <= '$lastday'
        ";

        return DB::select($query);
    }

    public static function getPendingBalance()
    {
        $teacher_id = Auth::user()->id;

        $query = "SELECT SUM(p.amount) as pending
        FROM payments p
        LEFT JOIN course_users cu ON cu.id = p.course_user_id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN users u ON u.id = c.teacher_id
        WHERE u.id = $teacher_id
        AND p.teacher_id IS NULL
        AND p.payment_date IS NOT NULL
        AND p.acredited = 0";

        return DB::select($query);
    }

    public static function getPayment($payment_ids)
    {
        $ids = implode(',', $payment_ids);
        $query = "SELECT
        cu.id as course_id, c.teacher_id,
        GROUP_CONCAT(p.id) as payment_ids,
        GROUP_CONCAT(p.amount) as amount
        FROM payments p
        LEFT JOIN course_users cu ON cu.id = p.course_user_id
        LEFT JOIN courses c ON c.id = cu.course_id
        WHERE p.id IN($ids)
        AND p.payment_date IS NOT NULL
        AND p.teacher_id IS NULL
        GROUP BY c.id";

        return DB::select($query);
    }


    public static function pay($ids)
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $query = "UPDATE payments SET payment_date = '$date', acredited = 1  
        WHERE id IN($ids)
        AND teacher_id IS NULL
        AND payment_date IS NOT NULL";
        // dd($query);
        return DB::select($query);
    }

    public static function payTeacher($course_id, $amount, $teacher_id)
    {
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $query = "INSERT INTO payments (course_user_id, amount, teacher_id, payment_date, acredited) 
        VALUES ($course_id, $amount, $teacher_id, '$date', 1)";

        return DB::select($query);
    }

    public function course_user()
    {
        return $this->belongsTo(CourseUser::class, 'course_user_id')->withTrashed();
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, CourseUser::class, 'id', 'id', 'course_user_id', 'user_id');
    }

    public function course()
    {
        return $this->hasOneThrough(Course::class, CourseUser::class, 'id', 'id', 'course_user_id', 'course_id')->withTrashed();
    }
}
