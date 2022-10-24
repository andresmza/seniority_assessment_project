<?php

namespace App\Models;

use App\Models\CourseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    // public function payments(){
    //     return $this->hasManyThrough(Course::class, User::class, )
    // }

    public function course_user(){
        return $this->belongsTo(CourseUser::class, 'course_user_id');
    }
}
