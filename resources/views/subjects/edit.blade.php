<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <h1><b>Edit subject</b></h1>
                <form action="{{ route('subjects.update', $subject->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Name</b></span>
                        </label>
                        <input type="text" placeholder="Name" name="name" value="{{ old('name') ?? $subject->name }}"
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
                        <textarea class="textarea textarea-bordered h-24" name="description" placeholder="Description">{{ old('description') ?? $subject->description }}</textarea>
                    </div>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Price</b></span>
                        </label>
                        <input type="number" placeholder="Price" name="price" value="{{ old('price') ?? $subject->price }}" step="0.01"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                    </div>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Duration</b></span>
                        </label>
                        <input type="number" placeholder="Duration (months)" name="duration" value="{{ old('duration') ?? $subject->duration }}"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                        @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
        
                    <div class="modal-action">
                        <a href="/subjects"><button class="btn btn-error">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn bg-slate-900">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>