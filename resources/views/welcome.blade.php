<x-layout title="Home " >

    <h1 class="text-3xl font-bold pt-5"> welcome to our website my name is {{ $name }}</h1>

    @forelse($tasks as $task)
        <li> {{ $task }} </li>

    @empty
        <p>No tasks </p>
    @endforelse

</x-layout>
