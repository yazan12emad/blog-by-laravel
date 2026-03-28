<x-layout title="Ideas | laravel ">


    <div class="flex flex-col items-center m-10">

        <div class="p-2.5 border-blue-600 border-2 rounded-2xl font-bold text-black"> The idea is {{ $idea->description }} </div>

            <a class="rounded-[10px] bg-green-400 px-3 py-2 mr-3 mt-5 text-sm font-semibold
             text-white focus-visible:outline-2 focus-visible:outline-offset-2
              focus-visible:outline-indigo-500 cursor-pointer  transition hover:scale-112 " href="/ideas/{{$idea->id}}/edit">Update</a>

    </div>

</x-layout>
