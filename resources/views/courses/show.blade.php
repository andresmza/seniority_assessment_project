<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                    <h3 class="font-bold text-center text-lg">{{ $course->subject->name }}</h3>
                </div>
                <div class="overflow-x-auto mx-6 mb-4 ml-12">

                    <p class="text-md">Teacher: {{ $course->teacher->name }} {{ $course->teacher->lastname }}</p>
                    <p class="text-md">Students: {{ $course->students->count() }}</p>
                    <p class="text-md">Duration: {{ $course->subject->duration }} months</p>
                    <p class="text-md">Start date: {{ $course->start_date }}</p>
                    <p class="text-md">End date: {{ $course->end_date }}</p>

                </div>

                <div class="overflow-x-auto mx-6 mb-4">
                    <h3 class="font-bold text-lg mb-4"> Students </h3>
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th>Final calification</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($students) != 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td><a href="/students/{{ $student->id }}"
                                                style="color: #4a4ae2;">{{ $student->name }}
                                                {{ $student->lastname }}</a></td>
                                        <td>{{ $student->dni }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            @if (Auth::user()->hasRole('admin'))
                                                {{ $student->final_calification }}
                                            @endif
                                            @if (Auth::user()->hasRole('teacher'))
                                                <form action="/students/calification" method="POST">
                                                    @csrf
                                                    {{-- @method('PUT') --}}
                                                    <input type="number" max="100" min="-100"
                                                        name="final_calification"
                                                        value="{{ $student->final_calification }}" style="width: 10ch;"
                                                        required>
                                                    <input type="hidden" name="course_user_id"
                                                        value="{{ $student->course_user_id }}">
                                                    <input type="hidden" name="course_id"
                                                        value="{{ $student->course_id }}">
                                                    <button type="submit" class="btn bg-slate-900">Save </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No students</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>

                <div class="overflow-x-auto mx-6 mb-4">
                    <h3 class="font-bold text-lg mb-4"> Payments </h3>
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Amount</th>
                                <th>Payment date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($payments))
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td><a href="/students/{{ $student->id }}"
                                                style="color: #4a4ae2;">{{ $payment->name }}
                                                {{ $payment->lastname }}</a></td>
                                        <td>{{ $payment->amount }} u$s</td>
                                        <td>{{ $payment->payment_date }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>No payments were made</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>


@if (session('info'))
    <script>
        toastr['success']('{{ session('info') }}');
    </script>
@endif
