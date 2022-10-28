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
                    <table class="table w-full"> 
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                {{-- <th class="w-20">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($payments as $payment)
                            {{-- {{dd($payment->course)}} --}}
                                <tr>
                                    <td>{{ $payment->user->name }} {{ $payment->user->lastname }}</td>
                                    @if ($payment->course->deleted_at == null)
                                    <td><a href="/courses/{{$payment->course->id}}" style="color: #4a4ae2;">{{ $payment->course->subject->name }}</a></td>
                                    @else
                                    <td>{{ $payment->course->subject->name }}</td>
                                    @endif
                                    <td>{{ $payment->amount }} u$s</td>
                                    <td>{{ $payment->created_at }}</td>
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

{{-- @include('payments/modal-create') --}}

{{-- @include('payments/modal-edit') --}}

<script>
    const _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/payment.js') }}"></script>
