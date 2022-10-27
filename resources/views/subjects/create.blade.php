<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
                <form action="{{ route('subjects.store') }}" method="post">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text"><b>Name</b></span>
                        </label>
                        <input type="text" placeholder="Type here" name="name" class="input input-bordered w-full"
                            style="border-radius: 8px; border-color: #bdbdbd;" />
                        <label class="label">
                        </label>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Description</span>
                            {{-- <span class="label-text-alt">Alt label</span> --}}
                        </label>
                        <textarea class="textarea textarea-bordered h-24" name="description" placeholder="Description"></textarea>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Monthly price</span>
                        </label>
                        <input type="number" placeholder="Price" name="price" class="input input-bordered w-full"
                            style="border-radius: 8px; border-color: #bdbdbd;" />
                        <label class="label">
                        </label>
                    </div>

                    <div class="form-control">

                        <label class="label">
                            <span class="label-text">Teacher</span>
                        </label>
                        <select class="select select-bordered w-full">
                            <option disabled selected>Choose teacher</option>
                            <option>Han Solo</option>
                            <option>Greedo</option>
                        </select>
                    </div>

                        <a href="{{route('subjects.index')}}"><button class="btn bg-red-500">Cancel</button></a>
                        <button type="submit" class="btn bg-slate-900">Save </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

