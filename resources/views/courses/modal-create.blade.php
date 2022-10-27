<!-- Put this part before </body> tag -->
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
            </div>
            
            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Start date</b></span>
                </label>
                <input type="date" name="start_date" id="start_date" min="2022-10-26" class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" required/>
            </div>

            {{-- <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>End date</b></span>
                </label>
                <input type="date" name="end_date" id="end_date" value="" class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" disabled/>
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Duration</b></span>
                </label>
                <input type="number" placeholder="Duration" name="duration" value=""
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" disabled/>
            </div> --}}

            <div class="modal-action">
                <label for="createCourse" class="btn btn-error">Cancel </label>
                <button type="submit" class="btn bg-slate-900">Save </button>
            </div>
        </form>
    </div>
</div>
