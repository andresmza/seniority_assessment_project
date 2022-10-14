<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Course extends Model
{
    use HasFactory;

    //uno a muchos inversa
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    //muchos a muchos
    public function students()
    {
        return $this->belongsToMany(User::class)->withPivot('final_calification')->withTimestamps();
    }
}







