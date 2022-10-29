<style>
    .text-green {
        color: green;
    }

    .text-danger {
        color: red;
    }
</style>

<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="overflow-x-auto my-6 mx-6 mb-4">
                    @if (Auth::user()->hasRole('admin'))
                        <div class="max-w-7xl flex justify-end  sm:px-6 lg:px-8 my-4">
                            <label for="pay-pending" class="btn modal-open">Pay pending</label>
                        </div>
                    @endif

                    @if (Auth::user()->hasRole('teacher'))
                        <h3 class="font-bold text-lg">Pending balance: {{ $pending_balance }} u$s</h3>


                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                            <h3 class="font-bold text-lg">Payment history</h3>
                        </div>

                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Amount</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($teacher_payments as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->amount }}</td>
                                        <td>{{ $data->payment_date }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    @endif


                    <div class="max-w-7xl mx-auto sm:px-6 lg:pp-8 my-4">
                        <h3 class="font-bold text-lg">Student Payment history</h3>
                    </div>
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($student_payments as $data)
                                <tr>
                                    <td>{{ $data->student_name }}</td>
                                    @if ($data->course_deleted_at == null)
                                        <td><a href="/courses/{{ $data->course_id }}"
                                                style="color: #4a4ae2;">{{ $data->subject_name }}</a></td>
                                    @else
                                        <td>{{ $data->subject_name }}</td>
                                    @endif
                                    <td>{{ $data->amount }} u$s</td>
                                    <td>{{ $data->payment_date }}</td>
                                    <td>{{ $data->acredited ? 'Paid' : 'Not paid' }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Put this part before </body> tag -->
<input type="checkbox" id="showPayment" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="showFullName"></h3>
        <p class="py-4" id="showDNI"></p>
        <p class="py-4" id="showEmail"></p>
        <div class="modal-action">
            <label id="closeShowPayment" class="btn">Close</label>
        </div>
    </div>
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="showRemovePayment" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="removeTitle"></h3>
        <p class="py-4" id="removeDescription"></p>
        <div class="modal-action">
            <label id="closeRemovePayment" class="btn">Close</label>
            <button class="btn btn-error" id="removeButton">Remove </button>
        </div>
    </div>
</div>

@if (Auth::user()->hasRole('admin'))
    @include('payments/modal-pay-pending')
@endif

<script>
    const _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/payment.js') }}"></script>
