<?php

namespace App\Http\Controllers;

use App\Models\CourseUser;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payments/index', [
            'payments' => Payment::orderBy('created_at', 'desc')->get(),
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
        $course_user = CourseUser::find($request->id);

        $payments_count = count(Payment::where('course_user_id', 1)->get());
        $total_payments = $course_user->course->subject->duration;

        if($payments_count == $total_payments){
            return response()->json(['message' => 'Error trying to process payment.'], 400);
        }

        
        $payment = Payment::create([
            'course_user_id' => $course_user->id,
            'amount' => $course_user->price,
            'created_at' => Carbon::now()->addHours(-3),
        ]);

        if ($payment) {
            return response()->json($payment, 200);
        } else {
            return response()->json(['message' => 'Error trying to process payment.'], 400);
        }       
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
