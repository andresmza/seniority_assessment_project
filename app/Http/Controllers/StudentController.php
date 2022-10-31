<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            return view('students/index', [
                'students' => User::role('student')->get(),
            ]);
        }
        
        if(Auth::user()->hasRole('teacher')){
            $teacher_id = Auth::user()->id;
            $myStudents = User::getMyStudents();
            // dd(User::role('teacher')->join('courses', 'courses.teacher_id', '=', 'users.id')->get());

            return view('students/my-students', [
                'students' => $myStudents,
            ]);
        }

        if(Auth::user()->hasRole('student')){
            return view('students/show', [
                'students' => User::role('student')->get(),
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'dni' => 'required|regex:/^[1-9](\d{6,7})$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:255|min:6',
            'confirm_password' => 'required|max:255|min:6|same:password',
        ]);

        $student = User::create([
            'name' => $request->name ,
            'lastname' => $request->lastname ,
            'dni' => $request->dni ,
            'email' => $request->email ,
            'password' => bcrypt($request->password) ,
        ]);

        $student->assignRole('Student');

        return view('students/index', [
            'students' => User::role('student')->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        $available_courses = null;

        $courses = User::studentsDetails($student->id);
// dd($courses);
        foreach ($courses as $key => $course) {
            if($course->payments != null){
                $course->payments = explode(',', $course->payments);
                $course->amounts = explode(',', $course->amounts);
                $course->expiration_date = explode(',', $course->expiration_date);
                $course->payment_date = explode(',', $course->payment_date);
                $course->count_payments = count($course->payment_date);
            }else{
                $course->count_payments = 0;
            }
        }

            $available_courses = Course::availableCourses($student->id);

        return view('students/show', [
            'student' => $student,
            'courses' => $courses,
            'available_courses' => $available_courses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        if($student->hasRole('student')) {
            return view('students.edit', compact('student'));
        } else {
            return view('students/index', [
                'students' => User::role('student')->get(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $student)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'dni' => 'required|regex:/^[1-9](\d{6,7})$/',
            'email' => 'required|email|unique:users,email,' . $student->id,
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('info', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        $student->delete();

        if ($student) {
            return response()->json($student, 200);
        } else {
            return response()->json(['message' => 'No student found.'], 400);
        }
    }

    public function info(User $student)
    {
        if ($student) {
            return response()->json($student, 200);
        } else {
            return response()->json(['message' => 'No student found.'], 400);
        }
    }

}
