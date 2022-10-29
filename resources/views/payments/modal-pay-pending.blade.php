<!-- Put this part before </body> tag -->
<input type="checkbox" id="pay-pending" class="modal-toggle" @if ($errors->any()) checked @endif />
<div class="modal">
    <div class="modal-box w-11/12 max-w-2xl">
        <h3 class="font-bold text-lg mb-6">Pay pending</h3>


        <form action="{{ route('payments.pay-pending') }}" method="post">
            @csrf

            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th>Teacher</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($pending_payments)
                        @foreach ($pending_payments as $item)
                            <tr>
                                <td>{{ $item->name }} {{ $item->lastname }}</td>
                                <td>{{ $item->amount }} u$s</td>
                            </tr>
                            <input type="hidden" name="payments_id[]" value="{{ $item->ids }}">
                        @endforeach
                    @endif

                </tbody>
            </table>


            <div class="modal-action">
                <label for="pay-pending" class="btn btn-error">Cancel </label>
                <button type="submit" class="btn bg-slate-900">Pay </button>
            </div>
        </form>
    </div>
</div>
