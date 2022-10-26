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
                    <label for="createAdmin" class="btn modal-open">Create admin</label>
                    
                </div>
                <div class="overflow-x-auto mx-6 mb-4">
                    <table class="table w-full"> 
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Lastname</th>
                                <th>DNI</th>
                                <th>Email</th>
                                <th class="w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($admins as $admin)
                                <tr>

                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->lastname }}</td>
                                    <td>{{ $admin->dni }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <button class="btn btn-outline btn-info"
                                            onclick="showAdmin({{ $admin->id }})">
                                            <x-icon name="eye" />
                                        </button>
                                        <a href="/admins/{{ $admin->id }}/edit"><button class="btn btn-outline btn-success">
                                            <x-icon name="pencil-square" />
                                        </button></a>
                                        <button class="btn btn-outline btn-error"
                                            onclick="showRemoveAdmin({{ json_encode($admin, true) }})">
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
<input type="checkbox" id="showAdmin" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="showFullName"></h3>
        <p class="py-4" id="showDNI"></p>
        <p class="py-4" id="showEmail"></p>
        <div class="modal-action">
            <label id="closeShowAdmin" class="btn">Close</label>
        </div>
    </div>
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="showRemoveAdmin" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="removeTitle"></h3>
        <p class="py-4" id="removeDescription"></p>
        <div class="modal-action">
            <label id="closeRemoveAdmin" class="btn">Close</label>
            <button class="btn btn-error" id="removeButton">Remove </button>
        </div>
    </div>
</div>

@include('admins/modal-create')
{{-- @include('admins/modal-edit') --}}

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

<script>
    const _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/admins.js') }}"></script>
