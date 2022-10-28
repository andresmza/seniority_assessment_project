<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Settings;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
// use Cmixin\EnhancedPeriod;

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
        $max_coincidences = Settings::find(1)->max_courses_per_teacher_per_week;

        $start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = Carbon::parse($start_date)->addMonths($subject->duration)->format('Y-m-d');
        $start_week = Carbon::parse($start_date)->startOfWeek();
        $end_week = Carbon::parse($end_date)->endOfWeek();

        $teacher_courses = Course::where('teacher_id', $request->teacher_id)->get();

        $weeks[0] = $start_week;
        $n = 0;
        $available_date = true;

        //Compare all weeks of courses with the incoming course
        do {
            $aux = new Carbon($weeks[$n]);

            $n++;
            $coincidences = 0;
            $weeks[$n] = $aux->addWeeks(1);

            foreach ($teacher_courses as $course) {

                $course_start_week = Carbon::parse($course->start_date)->startOfWeek();
                $course_end_week = Carbon::parse($course->end_date)->endOfWeek();

                if (CarbonPeriod::create(Carbon::parse($weeks[$n - 1])->format('Y-m-d'), Carbon::parse($weeks[$n])->format('Y-m-d'))->overlapsWith($course_start_week, $course_end_week)) {
                    $coincidences++;
                }
            }

            if ($coincidences >= $max_coincidences) {
                $available_date = false;
            }
        } while ($weeks[$n] < $end_week);

        // dd($available_date, Carbon::parse($weeks[$n - 1])->format('Y-m-d'), Carbon::parse($weeks[$n])->format('Y-m-d'), $course_start_week, $course_end_week);


        if ($available_date) {
            Course::create([
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
                'start_date' => $request->start_date,
                'end_date' => $end_date,
            ]);

            return redirect()->route('courses.index')->with('info', 'Course created successfully.');
        } else {
            return redirect()->route('courses.index')->with('error', 'Date not allowed. Choose another.');
        }
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
        $course->delete();
        return response()->json([], 200);
    }

    public function enroll(Request $request)
    {
        $course = Course::find($request->course_id);

        if (count(User::studentsDetails($request->student_id)) >= Settings::find(1)->max_courses_per_student) {
            return redirect()->route('students.show', $request->student_id)->withErrors(['You have reached the maximum course limit']);
        }

        CourseUser::create([
            'course_id' => $request->course_id,
            'user_id' => $request->student_id,
            'price' => $course->subject->price,
        ]);

        return redirect()->route('students.show', $request->student_id)->withInfo('Course enrolled successfully.');
    }

    public function unsuscribe($id)
    {

        $course_user = CourseUser::find($id);
        $course_user->delete();

        return redirect()->route('courses.index')->withInfo('Course unsuscribe successfully.');
    }
}
