<style>
    .text-danger {
        color: red;
    }
</style>
<x-app-layout>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <h1><b>Settings</b></h1>
                <form action="{{ route('settings.update', $settings->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Max courses per student</b></span>
                        </label>
                        <input type="number" placeholder="Max courses per student" name="max_courses_per_student"
                            value="{{ old('max_courses_per_student') ?? $settings->max_courses_per_student }}"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                    </div>
                    @error('max_courses_per_student')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Max courses per teacher per week</b></span>
                        </label>
                        <input type="number" placeholder="Max courses per teacher per week"
                            name="max_courses_per_teacher_per_week"
                            value="{{ old('max_courses_per_teacher_per_week') ?? $settings->max_courses_per_teacher_per_week }}"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                    </div>
                    @error('max_courses_per_teacher_per_week')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Percentage by subject</b></span>
                        </label>
                        <input type="number" placeholder="Percentage by subject" name="percentage_by_subject"
                            value="{{ old('percentage_by_subject') ?? $settings->percentage_by_subject }}"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                        @error('percentage_by_subject')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn bg-slate-900">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


@if (session('info'))
    <script>
        toastr['success']('{{session('info')}}');
    </script>
@endif

@if ($errors->any())
<script>
    toastr['error']('An error occurred while saving the data. Check again.');
</script>
@endif