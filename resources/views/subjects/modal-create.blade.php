<!-- Put this part before </body> tag -->
<input type="checkbox" id="create-subject" class="modal-toggle" @if ($errors->any()) checked @endif />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Create subject</h3>



        <form action="{{ route('subjects.store') }}" method="post">
            @csrf
            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Name</b></span>
                </label>
                <input type="text" placeholder="Name" name="name" value="{{ old('name') }}"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Description</b></span>
                    {{-- <span class="label-text-alt">Alt label</span> --}}
                </label>
                <textarea class="textarea textarea-bordered h-24" name="description" placeholder="Description">{{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Price</b></span>
                </label>
                <input type="number" placeholder="Price" name="price" value="{{ old('price') }}" step="0.01"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
            </div>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Duration</b></span>
                </label>
                <input type="number" placeholder="Duration (months)" name="duration" value="{{ old('duration') }}"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                @error('duration')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="modal-action">
                <label for="create-subject" class="btn btn-error">Cancel </label>
                <button type="submit" class="btn bg-slate-900">Save </button>
            </div>
        </form>
    </div>
</div>