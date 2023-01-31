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
                    <label for="createCourse" class="btn modal-open">Create course</label>
                    
                </div>


                <div class="overflow-x-auto mx-6 mb-4">
                    <table class="table w-full"> 
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Students</th>
                                <th>Duration</th>
                                <th>From</th>
                                <th>To</th>
                                <th class="w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->subject->name }}</td>
                                    <td>{{ $course->teacher->name }} {{ $course->teacher->lastname }}</td>
                                    <td>{{ $course->students->count() }} students</td>
                                    <td>{{ $course->subject->duration }} months</td>
                                    <td>{{ $course->start_date }}</td>
                                    <td>{{ $course->end_date }}</td>
                                    <td>
                                        <a href="/courses/{{ $course->id }}"><button class="btn btn-outline btn-info">
                                            <x-icon name="eye" />
                                        </button></a>
                                        <button class="btn btn-outline btn-error"
                                        onclick="showRemoveCourse({{ json_encode($course, true) }})">
                                        <x-icon name="trash" />
                                    </button>
                                    </td>
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
<input type="checkbox" id="showCourse" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="showFullName"></h3>
        <p class="py-4" id="showDNI"></p>
        <p class="py-4" id="showEmail"></p>
        <div class="modal-action">
            <label id="closeShowCourse" class="btn">Close</label>
        </div>
    </div>
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="showRemoveCourse" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="removeTitle"></h3>
        <p class="py-4" id="removeDescription"></p>
        <div class="modal-action">
            <label id="closeRemoveCourse" class="btn">Close</label>
            <button class="btn btn-error" id="removeButton">Remove </button>
        </div>
    </div>
</div>


@include('courses/modal-create')




@if (session('info'))
    <script>
        toastr['success']('{{session('info')}}');
    </script>
@endif



@if ($message = Session::get('error'))
<script>
    toastr['error']('{{ $message }}');
</script>
@endif


<script>
    const _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/course.js') }}"></script>
