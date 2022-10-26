<!-- Put this part before </body> tag -->
<input type="checkbox" id="createStudent" class="modal-toggle" @if ($errors->any()) checked @endif />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Create student</h3>



        <form action="{{ route('students.store') }}" method="post">
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
                    <span class="label-text"><b>Lastname</b></span>
                </label>
                <input type="text" placeholder="Lastname" name="lastname" value="{{ old('lastname') }}"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
            </div>
            @error('lastname')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>DNI</b></span>
                </label>
                <input type="number" placeholder="DNI" name="dni" value="{{ old('dni') }}" step="0.01"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
            </div>
            @error('dni')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Email</b></span>
                </label>
                <input type="text" placeholder="Email" name="email" value="{{ old('email') }}"
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Password</b></span>
                </label>
                <input type="password" placeholder="Password" name="password" value=""
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-control">
                <label class="label">
                    <span class="label-text"><b>Confirm password</b></span>
                </label>
                <input type="password" placeholder="Confirm password" name="confirm_password" value=""
                    class="input input-bordered w-full" style="border-radius: 8px; border-color: #bdbdbd;" />
                @error('confirm_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="modal-action">
                <label for="createStudent" class="btn btn-error">Cancel </label>
                <button type="submit" class="btn bg-slate-900">Save </button>
            </div>
        </form>
    </div>
</div>