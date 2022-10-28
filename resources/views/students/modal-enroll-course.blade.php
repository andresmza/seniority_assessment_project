<!-- Put this part before </body> tag -->
<input type="checkbox" id="enrollCourse" class="modal-toggle" @if ($errors->any()) checked @endif />
<div class="modal">
    <div class="modal-box w-11/12 max-w-2xl">
        <h3 class="font-bold text-lg">Select course</h3>



        <form action="{{ route('courses.enroll') }}" method="post">
            @csrf

            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Subject</th>
                        <th>Teachjer</th>
                        <th>Start date</th>
                        <th>End Date</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($available_courses)
                        @foreach ($available_courses as $course)
                            <tr>
                                <td><input type="radio" name="course_id" value="{{ $course->id }}" class="radio" />
                                </td>
                                <td>{{ $course->subject }}</td>
                                <td>{{ $course->name }} {{ $course->lastname }}</td>
                                <td>{{ $course->start_date }}</td>
                                <td>{{ $course->end_date }}</td>
                                <td>{{ $course->price }} u$s</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>

            <div class="modal-action">
                <label for="enrollCourse" class="btn btn-error">Cancel </label>
                <button type="submit" class="btn bg-slate-900">Enroll </button>
            </div>
        </form>
    </div>
</div>
