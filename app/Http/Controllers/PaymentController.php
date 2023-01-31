<?php

namespace App\Http\Controllers;

use App\Models\CourseUser;
use App\Models\Payment;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        if (Auth::user()->hasRole('admin')) {
            $payments = Payment::getAllStudentPayments();
            $pending_payments = Payment::getPendingPayments();
            $percentage = Settings::find(1)->first()->percentage_by_subject;

            foreach ($pending_payments as $payment) {
                $payment_array = explode(',', $payment->amount);
                $amount = array_sum($payment_array) * $percentage / 100;
                $payment->amount = bcdiv($amount, 1, 2);
            }

            return view('payments/index', [
                // 'payments' => Payment::orderBy('created_at', 'desc')->get(),
                'student_payments' => $payments,
                'pending_payments' => $pending_payments,
            ]);
        }

        if (Auth::user()->hasRole('teacher')) {
            $percentage = Settings::find(1)->first()->percentage_by_subject;
            $student_payments = Payment::getStudentPayments();
            $teacher_payments = Payment::getTeacherPayments();
            $pending_balance = Payment::getPendingBalance()[0]->pending;
            $pending_balance = bcdiv($pending_balance * $percentage / 100, 1, 2);

            return view('payments/index', [
                'student_payments' => $student_payments,
                'teacher_payments' => $teacher_payments,
                'pending_balance' => $pending_balance,
            ]);
        }

        if (Auth::user()->hasRole('student')) {
            return redirect()->route('courses.index');
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

        $course_user = CourseUser::find($request->id);

        $payment = Payment::where('course_user_id', $course_user->id)->where('payment_date', null)->orderBy('id', 'asc')->first();


        if ($payment) {
            $payment->payment_date = Carbon::now()->format('Y-m-d H:i:s');
            $payment->save();
            return response()->json($payment, 200);
        } else {
            return response()->json(['message' => 'Error trying to process payment.'], 400);
        }
    }

    public function payPending(Request $request)
    {
        if (Auth::user()->hasRole('student')) {
            return redirect()->route('admins.index');
        }

        // dd($request);
        $percentage = Settings::find(1)->first()->percentage_by_subject;
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $payment_ids = [];
        foreach ($request->payments_id as $items) {
            $payment_ids = array_merge($payment_ids, explode(',', $items));
        }

        $payments = Payment::getPayment($payment_ids);

        foreach ($payments as $payment) {
            $amount = 0;
            $payment_array = explode(',', $payment->amount);
            $amount = array_sum($payment_array) * $percentage / 100;
            $amount = bcdiv($amount, 1, 2);

            Payment::pay($payment->payment_ids, $payment->course_id);

            Payment::payTeacher($payment->course_id, $amount, $payment->teacher_id);
        }

        return redirect()->route('payments.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
