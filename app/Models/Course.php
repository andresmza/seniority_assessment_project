<?php

namespace App\Models;

use App\Models\CourseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    //uno a muchos inversa
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(){
        return $this->hasMany(CourseUser::class);
    }

    public function payments_received(){
        return $this->hasManyThrough(Payment::class, CourseUser::class, 'course_id', 'course_user_id');
    }


    
    // //muchos a muchos
    // public function students()
    // {
    //     return $this->belongsToMany(User::class)->withPivot('final_calification')->withTimestamps();
    // }
}







