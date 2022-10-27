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
                    <p class="text-md">End date: {{ $course->start_date }}</p>

                </div>

                <div class="overflow-x-auto mx-6 mb-4">
                    <h3 class="font-bold text-lg mb-4"> Payments </h3>
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Amount</th>
                                <th>Datetime</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($students->count() != 0)
                                @foreach ($students as $student)
                                    @if ($student->payments)
                                        @foreach ($student->payments as $payment)
                                            <tr>
                                                <td><a href="/students/{{ $student->id }}" style="color: #4a4ae2;">{{ $student->name }} {{ $student->lastname }}</a></td>
                                                <td>{{ $payment->amount }} u$s</td>
                                                <td>{{ $payment->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td><a href="/students/{{ $student->id }}" style="color: #4a4ae2;">{{ $student->name }} {{ $student->lastname }}</a></td>

                                            <td>No payments were made</td>
                                            <td></td>
                                        </tr>
                                    @endif
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
