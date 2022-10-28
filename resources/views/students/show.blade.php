<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                    <h3 class="font-bold text-center text-lg">{{ $student->name }} {{ $student->lastname }}</h3>
                </div>
                <div class="overflow-x-auto mx-6 mb-4 ml-12">

                    {{-- <p class="text-md">Teacher: {{ $course->teacher->name }} {{ $course->teacher->lastname }}</p>
                    <p class="text-md">Students: {{ $course->students->count() }}</p>
                    <p class="text-md">Duration: {{ $course->subject->duration }} months</p>
                    <p class="text-md">Start date: {{ $course->start_date }}</p>
                    <p class="text-md">End date: {{ $course->start_date }}</p> --}}

                </div>
                @if ($available_courses)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                    <label for="enrollCourse" class="btn modal-open">Enroll in a course</label>
                    
                </div>
                @endif

                <div class="overflow-x-auto mx-6 mb-4">
                    <h3 class="font-bold text-lg mb-4"> Courses enrolled</h3>
                    @foreach ($courses as $course)
                        <div class="container mt-6 py-4 px-4 bg-gray-300" style="display: flex; border: groove; border-radius: 10px;">
                            <div style="width: 50%">
                                <p class="font-bold mt-4"><u>{{ $course->name }}</u></p>
                                <p class="mt-2">Teacher: {{ $course->teacher }} </p>
                                <p class="mt-2">Monthly price: {{ $course->price }} u$s</p>
                                <p class="mt-2">Start date: {{ $course->start_date }}</p>
                                <p class="">End date: {{ $course->end_date }}</p>
                                <p class="mt-2">Final calification: {{ $course->final_calification ?? 'N/A' }}</p>
                                <button class="btn btn-info mt-4" onclick="showCreatePayment({{$course->course_user_id}}, {{json_encode($course, true)}})" @if ($course->count_payments == $course->total_payments) disabled @endif>Register payment</button>
                                <button class="btn btn-error mt-4" onclick="showUnsuscribe({{$course->course_user_id}}, {{json_encode($course, true)}})" @if ($course->count_payments == $course->total_payments) disabled @endif>Unsuscribe</button>

                            </div>
                            <div style="width: 50%">
                                <p class="font-bold">Payments
                                    {{ $course->count_payments }}/{{ $course->total_payments }}</p>

                                <table class="table table-compact mt-4">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th class="" >Payment date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($course->payments != null)
                                        @foreach ($course->payments as $key => $payment)
                                            @if ($payment)
                                            <tr>
                                                <td style="width: 25ch" >
                                                    {{ $course->amounts[$key] }} u$s
                                                </td>
                                                <td style="width: 25ch" >
                                                    {{ $payment }}
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td style="width: 25ch" >No payments were made</td>
                                                <td style="width: 25ch" ></td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        @else
                                        <tr>
                                            <td style="width: 25ch" >No payments were made</td>
                                            <td style="width: 25ch" ></td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

@include('students/modal-payment')
@include('students/modal-enroll-course')
@include('students/modal-unsuscribe')

<script>
    const _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/create-payment.js') }}"></script>
<script src="{{ asset('js/unsuscribe.js') }}"></script>
@if ($errors->any())
<script>
    toastr['error']('An error occurred while saving the data. Check again.');
</script>
@endif
