<x-layout title="Ideas | laravel ">


    <div class="flex flex-col items-center m-10">
        <p class="font-bold text-2xl"> This is our form </p>

        <form method="POST" action="/ideas/{{$idea->id}}" class="w-full max-w-xl ">
            @csrf{{-- to create a input field (random token ) --}}
            {{-- to create a input field (random token for edit ) --}}
            @method('PATCH')

            <div class="col-span-full">
                <label for="about" class="block text-2xl font-bold text-black m-2">Edit your idea </label>
                <div class="mt-2">
                <textarea id="about" name="description" rows="3" class="block w-full  max-w-xl rounded-md bg-gray-500
                  px-3 py-1.5 text-base text-white font-bold outline-1 -outline-offset-1
                 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2
                 focus:outline-indigo-500 " placeholder="Your ideas" >{{ $idea->description }}</textarea>
                </div>
            </div>
            <x-error name="description"></x-error>
            <button type="submit" class="rounded-[10px] bg-indigo-500 px-3 py-2 mr-3 mt-5 text-sm font-semibold
             text-white focus-visible:outline-2 focus-visible:outline-offset-2
              focus-visible:outline-indigo-500 cursor-pointer  transition hover:scale-112">Update
            </button>

            <button type="submit" form="delete-form" class="rounded-md bg-red-500 px-3 py-2 mt-5 text-sm font-semibold
             text-white focus-visible:outline-2 focus-visible:outline-offset-2
              focus-visible:outline-indigo-500 cursor-pointer  transition hover:scale-112">Delete
            </button>

        </form>


        <form id="delete-form" method="post" action="/ideas/{{$idea->id}}" >
            @csrf{{-- to create a input field (random token ) --}}
            {{-- to create a input field (random token for edit ) --}}
            @method('DELETE')
        </form>

    </div>

</x-layout>
