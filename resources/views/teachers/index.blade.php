<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-4">
                    <label for="create-teacher" class="btn modal-open">Create teacher</label>
                </div>
                <div class="overflow-x-auto mx-6 mb-4">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            {{-- @foreach ($posts as $post)

                            @endforeach --}}
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-gray-500" onclick="showModal(3)">SHOW</label>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-green-500" onclick="showModal(3)">EDIT</label>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-red-500" onclick="showModal(3)">DELETE</label>
                                </td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-gray-500" onclick="showModal(3)">SHOW</label>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-green-500" onclick="showModal(3)">EDIT</label>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-red-500" onclick="showModal(3)">DELETE</label>
                                </td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-gray-500" onclick="showModal(3)">SHOW</label>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-green-500" onclick="showModal(3)">EDIT</label>
                                    <label for="my-modal" data-teacher-id="3" class="btn modal-button bg-red-500" onclick="showModal(3)">DELETE</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Congratulations random Internet user!</h3>
        <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!
        </p>
        <div class="modal-action">
            <label for="my-modal" class="btn">Yay!</label>
        </div>
    </div>
</div>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="create-teacher" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Create teacher</h3>

        {{-- <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" /> --}}

        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">What is your name?</span>
                <span class="label-text-alt">Alt label</span>
            </label>
            <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
            <label class="label">
                <span class="label-text-alt">Alt label</span>
                <span class="label-text-alt">Alt label</span>
            </label>

            <select class="select select-bordered w-full max-w-xs">
                <option disabled selected>Choose subject</option>
                <option>Han Solo</option>
                <option>Greedo</option>
            </select>

        </div>

        <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!
        </p>
        <div class="modal-action">
            <label for="create-teacher" class="btn">Yay!</label>
        </div>
    </div>
</div>

<script>
    $(function() {

    })

    function showModal(teacherId) {
        console.log('Teacher -> :' + teacherId)

    }
</script>