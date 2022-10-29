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
                    <label for="createTeacher" class="btn modal-open">Create teacher</label>

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

                            @foreach ($teachers as $teacher)
                                <tr>

                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->lastname }}</td>
                                    <td>{{ $teacher->dni }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>
                                        <button class="btn btn-outline btn-info"
                                            onclick="showTeacher({{ $teacher->id }})">
                                            <x-icon name="eye" />
                                        </button>
                                        <a href="/teachers/{{ $teacher->id }}/edit"><button
                                                class="btn btn-outline btn-success">
                                                <x-icon name="pencil-square" />
                                            </button></a>
                                        <button class="btn btn-outline btn-error"
                                            onclick="showRemoveTeacher({{ json_encode($teacher, true) }})">
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
<input type="checkbox" id="showTeacher" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="showFullName"></h3>
        <p class="py-4" id="showDNI"></p>
        <p class="py-4" id="showEmail"></p>
        <div class="modal-action">
            <label id="closeShowTeacher" class="btn">Close</label>
        </div>
    </div>
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="showRemoveTeacher" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="removeTitle"></h3>
        <p class="py-4" id="removeDescription"></p>
        <div class="modal-action">
            <label id="closeRemoveTeacher" class="btn">Close</label>
            <button class="btn btn-error" id="removeButton">Remove </button>
        </div>
    </div>
</div>

@include('teachers/modal-create')

<script>
    const _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/teacher.js') }}"></script>
