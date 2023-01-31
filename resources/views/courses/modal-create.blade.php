<!-- Put this part before </body> tag -->
<style>
    .text-danger {
        color: red;
    }
</style>

<input type="checkbox" id="createCourse" class="modal-toggle" @if ($errors->any()) checked @endif />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Create course</h3>



        <form action="{{ route('courses.store') }}" method="post">
            @csrf

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Subject</b></span>
                </label>
                <select class="select select-bordered w-full" name="subject_id" required>
                    <option disabled selected>Choose subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Teacher</b></span>
                </label>
                <select class="select select-bordered w-full" name="teacher_id" required>
                    <option disabled selected>Choose teacher</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->lastname }}</option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Start date</b></span>
                </label>
                <input type="date" name="start_date" id="start_date" min="{{ $course_start_date }}" value="{{ $course_start_date }}"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" required />
                    @error('start_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="modal-action">
                <label for="createCourse" class="btn btn-error">Cancel </label>
                <button type="submit" class="btn bg-slate-900">Save </button>
            </div>
        </form>
    </div>
</div>
