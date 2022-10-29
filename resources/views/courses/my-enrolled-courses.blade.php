<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                    <h3 class="font-bold text-center text-lg">{{ $student->name }} {{ $student->lastname }}</h3>
                </div>

                <div class="overflow-x-auto mx-6 mb-4 ml-12">
                    <h3 class="font-bold text-lg">Pending payment current month: {{ $pending_payments ?? 0 }} u$s</h3>
                </div>
                @if ($available_courses)
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                        <label for="enrollCourse" class="btn modal-open">Enroll in a course</label>

                    </div>
                @endif

                <div class="overflow-x-auto mx-6 mb-4">
                    <h3 class="font-bold text-lg mb-4"> Courses enrolled</h3>
                    @foreach ($courses as $course)
                        <div class="container mt-6 py-4 px-4 bg-gray-300"
                            style="display: flex; border: groove; border-radius: 10px;">
                            <div style="width: 50%">
                                <p class="font-bold mt-4"><u>{{ $course->name }}</u></p>
                                <p class="mt-2">Teacher: {{ $course->teacher }}</p>
                                <p class="mt-2">Monthly price: {{ $course->price }} u$s</p>
                                <p class="mt-2">Start date: {{ $course->start_date }}</p>
                                <p class="">End date: {{ $course->end_date }}</p>
                                <p class="mt-2">Final calification: {{ $course->final_calification ?? 'N/A' }}</p>

                            </div>
                            <div style="width: 50%">
                                <p class="font-bold text-center">Payments

                                <table class="table table-compact mt-4">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Expiration date</th>
                                            <th>Payment date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($course->amounts != null)
                                            @foreach ($course->amounts as $key => $payment)
                                                @if ($payment)
                                                    <tr>
                                                        <td style="width: 25ch">
                                                            {{ $course->amounts[$key] }} u$s
                                                        </td>
                                                        <td style="width: 25ch;">
                                                            {{ $course->expiration_dates[$key] }}
                                                        </td>
                                                        <td style="width: 25ch">
                                                            {{ $course->payment_dates[$key] == 0 ? 'Not paid' : $course->payment_dates[$key] }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td style="width: 25ch">No payments were made</td>
                                                        <td style="width: 25ch"></td>
                                                        <td style="width: 25ch"></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr>
                                                <td style="width: 25ch">No payments were made</td>
                                                <td style="width: 25ch"></td>
                                                <td style="width: 25ch"></td>
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

@include('students/modal-enroll-course')

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
