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
                    <label for="createSubject" class="btn modal-open">Create subject</label>
                    
                </div>
                <div class="overflow-x-auto mx-6 mb-4">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Price</th>
                                <th class="w-20">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($subjects as $subject)
                                <tr>

                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->duration }} months</td>
                                    <td>{{ $subject->price }} u$s</td>
                                    <td>
                                        <button class="btn btn-outline btn-info"
                                            onclick="showSubject({{ $subject->id }})">
                                            <x-icon name="eye" />
                                        </button>
                                        <a href="/subjects/{{ $subject->id }}/edit"><button class="btn btn-outline btn-success">
                                            <x-icon name="pencil-square" />
                                        </button></a>
                                        <button class="btn btn-outline btn-error"
                                            onclick="showRemoveSubject({{ json_encode($subject, true) }})">
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
<input type="checkbox" id="showSubject" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="showTitle"></h3>
        <p class="py-4" id="showDescription"></p>
        <p class="py-4" id="showDuration"></p>
        <p class="py-4" id="showPrice"></p>
        <div class="modal-action">
            <label id="closeShowSubject" class="btn">Close</label>
        </div>
    </div>
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="showRemoveSubject" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg" id="removeTitle"></h3>
        <p class="py-4" id="removeDescription"></p>
        <div class="modal-action">
            <label id="closeRemoveSubject" class="btn">Close</label>
            <button class="btn btn-error" id="removeButton">Remove </button>
        </div>
    </div>
</div>

@include('subjects/modal-create')
@include('subjects/modal-edit')

<script>
    const _token = "{{ csrf_token() }}";
</script>

<script src="{{ asset('js/subject.js') }}"></script>
