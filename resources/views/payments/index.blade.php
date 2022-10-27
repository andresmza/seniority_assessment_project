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
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                    <label for="createPayment" class="btn modal-open">Create payment</label>
                    
                </div>
                <div class="overflow-x-auto mx-6 mb-4">
                    <table class="table w-full"> 
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Subject</th>
                                <th>Amount</th>
                                <th>Date</th>
                                {{-- <th class="w-20">Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->user->name }} {{ $payment->user->lastname }}</td>
                                    <td>{{ $payment->course->subject->name }}</td>
                                    <td>{{ $payment->amount }} u$s</td>
                                    <td>{{ $payment->created_at }}</td>
                                    {{-- <td>
                                        <button class="btn btn-outline btn-info"
                                            onclick="showPayment({{ $payment->id }})">
                                            <x-icon name="eye" />
                                        </button>
                                        <a href="/payments/{{ $payment->id }}/edit"><button class="btn btn-outline btn-success">
                                            <x-icon name="pencil-square" />
                                        </button></a>
                                        <button class="btn btn-outline btn-error"
                                            onclick="showRemovePayment({{ json_encode($payment, true) }})">
                                            <x-icon name="trash" />
                                        </button>
                                    </td> --}}
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
