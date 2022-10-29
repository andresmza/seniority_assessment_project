<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'duration', 'status'];

    public static function mysubjects(){
        $teacher_id = Auth::user()->id;

        $query = "SELECT s.id, s.name, s.description, s.duration, s.price
        FROM subjects s
        LEFT JOIN courses c ON c.subject_id = s.id
        WHERE c.teacher_id = $teacher_id
        GROUP By s.id";

        return DB::select($query);

    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
