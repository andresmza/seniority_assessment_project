{{-- <!-- Put this part before </body> tag -->
<input type="checkbox" id="editSubject" class="modal-toggle" @if ($errors->any()) checked @endif />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Edit subject</h3>



        <form action="{{ route('subjects.update', 0) }}" method="post" id="editSubjectForm">
            @method('PUT')
            @csrf
            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Name</b></span>
                </label>
                <input type="text" placeholder="Name" name="name" id="editName"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Description</b></span>
                </label>
                <textarea class="textarea textarea-bordered h-24" name="description" placeholder="Description" id="editDescription"></textarea>
            </div>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Price</b></span>
                </label>
                <input type="number" placeholder="Price" name="price" id="editPrice" step="0.01"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
            </div>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Duration</b></span>
                </label>
                <input type="number" placeholder="Duration (months)" name="duration" id="editDuration"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                @error('duration')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="modal-action">
                <button class="btn btn-error" id="closeEditSubject">Cancel </button>
                <button type="submit" class="btn bg-slate-900">Save </button>
            </div>
        </form>
    </div>
</div> --}}