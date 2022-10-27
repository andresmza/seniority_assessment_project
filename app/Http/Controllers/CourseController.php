<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('courses/index', [
            'courses' => Course::all(),
            'subjects' => Subject::all(),
            'teachers' => User::role('teacher')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'start_date' => 'required',
        ]);

        $subject = Subject::find($request->subject_id);

        $end_date = Carbon::parse($request->start_date)->addMonths($subject->duration)->format('Y-m-d');

        Course::create([
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'start_date' => $request->start_date,
            'end_date' => $end_date,
        ]);

        return redirect()->route('courses.index')->with('info', 'Course created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {

        $students = $course->students()->get();

        foreach ($students as $student) {
            $student->payments = Course::getStudentsInfo($course->id, $student->id);
            // dd(Course::getStudentsInfo($course->id, $student->id));
        }

        // dd($students);
        return view('courses/show', [
            'course' => $course,
            'students' => $students,
            // 'subjects' => Subject::all(),
            // 'teachers' => User::role('teacher')->get(),
        ]);

        // dd($course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
