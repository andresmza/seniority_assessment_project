<?php

namespace App\Models;

use App\Models\CourseUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    // use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'lastname',
        'dni',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function studentsDetails($studentId){
        $query = "SELECT u.name, CONCAT(t.name, ' ', t.lastname) as teacher ,s.name, c.start_date, c.end_date, cu.final_calification, cu.price, cu.id as course_user_id,
        s.duration as total_payments,
        GROUP_CONCAT(p.amount) as amounts,
        GROUP_CONCAT(p.created_at) as payments, p.created_at FROM users u
        LEFT JOIN course_users cu ON cu.user_id = u.id
        LEFT JOIN courses c ON c.id = cu.course_id
        LEFT JOIN users t ON t.id = c.teacher_id
        LEFT JOIN subjects s ON s.id = c.subject_id
        LEFT JOIN payments p ON p.course_user_id = cu.id
        WHERE cu.user_id = $studentId
        AND c.deleted_at IS NULL
        GROUP BY c.id";

        return DB::select($query);
    }



    public function courses_dictated(){
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function courses()
    {
        return $this->hasManyThrough(Course::class, CourseUser::class, 'user_id', 'id', null, 'course_id');
    }


    public function payments_made(){
        return $this->hasManyThrough(Payment::class, CourseUser::class, 'user_id', 'course_user_id');
    }

}
