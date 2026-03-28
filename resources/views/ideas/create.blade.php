<x-layout title="Ideas | laravel ">


    <div class="flex flex-col items-center m-10">
        <p class="font-bold text-2xl"> This is our form </p>

        <form id="form" method="post" action="/ideas" class="w-full max-w-xl ">
            @csrf{{-- to create a input field (random token ) --}}
            <div class="col-span-full">
                <label for="about" class="block text-2xl font-bold text-black m-2">About</label>
                <div class="mt-2">
                <textarea id="description" name="description" rows="3" class="block w-full  max-w-xl rounded-md bg-gray-500
                  px-3 py-1.5 text-base text-white font-bold outline-1 -outline-offset-1
                 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2
                 focus:outline-indigo-500 " placeholder="Your ideas" ></textarea>
                </div>
            </div>
            {{-- error message            --}}
            <x-error name="description"> </x-error>


            <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 mt-5 text-sm font-semibold
             text-white focus-visible:outline-2 focus-visible:outline-offset-2
              focus-visible:outline-indigo-500 cursor-pointer  transition hover:scale-112">Add to ideas
            </button>

        </form>

    </div>

{{--    <script>--}}
{{--        const form = document.getElementById('form');--}}
{{--        const textarea = document.getElementById('description');--}}

{{--        form.addEventListener('submit', function(event) {--}}
{{--            event.preventDefault();--}}

{{--            let textareaValue = textarea.value;--}}

{{--            if (textareaValue.trim() === "") {--}}
{{--                alert('enter idea');--}}
{{--                return; // stop submission--}}
{{--            }--}}

{{--            form.submit(); // submit if valid--}}
{{--        });--}}


{{--    </script>--}}

</x-layout>
