<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = ['max_courses_per_student', 'max_courses_per_teacher_per_week', 'percentage_by_subject'];
}
