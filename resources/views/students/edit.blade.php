<style>
    .text-danger {
        color: red;
    }
</style>
<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <h1><b>Edit student</b></h1>
                <form action="{{ route('students.update', $student->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Name</b></span>
                        </label>
                        <input type="text" placeholder="Name" name="name" value="{{ old('name') ?? $student->name }}"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                    </div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Lastname</b></span>
                        </label>
                        <input type="text" placeholder="Lastname" name="lastname" value="{{ old('lastname') ?? $student->lastname }}"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                    </div>
                    @error('lastname')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>DNI</b></span>
                        </label>
                        <input type="number" placeholder="DNI" name="dni" value="{{ old('dni') ?? $student->dni }}" step="0.01"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                    </div>
                    @error('dni')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
        
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Email</b></span>
                        </label>
                        <input type="text" placeholder="Email" name="email" value="{{ old('email') ?? $student->email }}"
                            class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
        
                    <div class="modal-action">
                        <a href="/students"><button class="btn btn-error">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn bg-slate-900">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>