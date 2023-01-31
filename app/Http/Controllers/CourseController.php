<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        if (Auth::user()->hasRole('admin')) {
            return view('courses/index', [
                'courses' => Course::all(),
                'subjects' => Subject::all(),
                'teachers' => User::role('teacher')->get(),
                'course_start_date' => Carbon::now()->startOfMonth()->addMonth()->format('Y-m-d'),
            ]);
        }
        if (Auth::user()->hasRole('teacher')) {
            $teacher_id = Auth::user()->id;

            return view('courses/my-courses', [
                'courses' => Course::where('teacher_id', $teacher_id)->get(),
                'subjects' => Subject::all(),
                'teachers' => array(User::find($teacher_id)),
                'course_start_date' => Carbon::now()->startOfMonth()->addMonth()->format('Y-m-d'),
            ]);
        }
        if (Auth::user()->hasRole('student')) {
            $student_id = Auth::user()->id;

            $courses = Course::getEnrolledCourses($student_id);
            foreach ($courses as $key => $course) {
                $course->amounts = explode(',', $course->amounts);
                $course->expiration_dates = explode(',', $course->expiration_dates);
                $course->payment_dates = explode(',', $course->payment_dates);
            }
            $available_courses = Course::availableCourses($student_id);
            $pending_payments = Payment::getMyPendingPayments($student_id)[0]->pending;
// dd($courses);
            return view('courses/my-enrolled-courses', [
                'student' => Auth::user(),
                'courses' => $courses,
                'available_courses' => $available_courses,
                'pending_payments' => $pending_payments,
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
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('courses.index');
        }

        $course_start_date = Carbon::now()->startOfMonth()->addMonth()->addDay(-1)->format('Y-m-d');

        $validated = $request->validate([
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'start_date' => 'required|after:'. $course_start_date,
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

                $start_week_compare = Carbon::parse($weeks[$n - 1])->format('Y-m-d H:i:s');
                $end_week_compare = Carbon::parse($weeks[$n])->addSeconds(-1)->format('Y-m-d H:i:s');

                // echo $course->id . '   ' . $course_start_week .' - '. $course_end_week .' | '. $start_week_compare .' | '. $end_week_compare . ' ' . CarbonPeriod::create($start_week_compare, $end_week_compare)->overlapsWith($course_start_week, $course_end_week) .'<br>';

                if (CarbonPeriod::create($start_week_compare, $end_week_compare)->overlapsWith($course_start_week, $course_end_week)) {
                    $coincidences++;
                }
            }

            // echo '<br>';

            if ($coincidences >= $max_coincidences) {
                $available_date = false;
            }
        } while ($weeks[$n] < $end_week);

        // dd($available_date, Carbon::parse($weeks[$n - 1])->format('Y-m-d'), Carbon::parse($weeks[$n])->format('Y-m-d'), $course_start_week, $course_end_week, $request->all());
        // $subject = Subject::find()->first();
        // $teacher = User::find()->first();

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

        if (Auth::user()->hasRole('student')) {
            return redirect()->route('courses.index');
        }

        $payments = Payment::getPaymentsByCourse($course->id);
        $students = User::getStudentsByCourse($course->id);
        // dd($students);
        if (Auth::user()->hasRole('admin')) {
            return view('courses/show', [
                'course' => $course,
                'students' => $students,
                'payments' => $payments,
            ]);
        }
        if (Auth::user()->hasRole('teacher')) {

            $students = User::getStudentsByCourse($course->id);
            $payments = Payment::getPaymentsByCourse($course->id);

            return view('courses/show', [
                'course' => $course,
                'students' => $students,
                'payments' => $payments,
                // 'teachers' => User::role('teacher')->get(),
            ]);
        }

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
        if (Auth::user()->hasRole('student')) {
            return redirect()->route('courses.index');
        }

        $course->delete();
        return response()->json([], 200);
    }

    public function enroll(Request $request)
    {

        if (Auth::user()->hasRole('teacher')) {
            return redirect()->route('courses.index');
        }

        $course = Course::find($request->course_id);
        $max_courses_per_student = Settings::find(1)->max_courses_per_student;

        $overlapping_courses = Course::getOverlappingCourses($request->student_id, $course)[0]->count;

        if ($overlapping_courses >= $max_courses_per_student) {
            return redirect()->route('students.show', $request->student_id)->with('error','You have reached the maximum course limit for this period');
        }

        $course_user = CourseUser::create([
            'course_id' => $request->course_id,
            'user_id' => $request->student_id,
            'price' => $course->subject->price,
        ]);
        $expiration_date = Carbon::parse($course->start_date)->startOfMonth()->addDays(9);

        for ($i = 0; $i < $course->subject->duration; $i++) {

            Payment::create([
                'course_user_id' => $course_user->id,
                'amount' => $course_user->price,
                'expiration_date' => $expiration_date,
            ]);

            $expiration_date->addMonth();
        }

        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('students.show', $request->student_id)->withInfo('Course enrolled successfully.');
        }

        if (Auth::user()->hasRole('student')) {
            return redirect()->route('courses.index', $request->student_id)->withInfo('Course enrolled successfully.');
        }
    }

    public function unsuscribe($id)
    {
        // if (!Auth::user()->hasRole('admin')) {
        //     return redirect()->route('courses.index');
        // }

        $course_user = CourseUser::where('id', $id)->withTrashed();

        $payments = Payment::where('course_user_id', $id)->where('payment_date', null)->delete();

        $course_user = $course_user->delete();

        return response()->json($course_user, 200);
        // return redirect()->route('courses.index')->withInfo('Course unsuscribe successfully.');
    }

    public function setCalification(Request $request)
    {
        if (!Auth::user()->hasRole('teacher')) {
            return redirect()->route('courses.index');
        }

        if($request->final_calification < 0 || $request->final_calification > 10){
            return redirect()->route('courses.index');
        }

        $validated = $request->validate([
            'final_calification' => 'min:0|max:10',
        ]);        

        $course_user = CourseUser::where('id', $request->course_user_id)->first();
        $course_user->final_calification = intval($request->final_calification);
        $course_user->save();

        return redirect()->route('courses.show', $request->course_id)->withInfo('Final calification updated successfully.');
    }
}
