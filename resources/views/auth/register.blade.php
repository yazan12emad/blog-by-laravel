<x-layout title="register | laravel">

    <form method="post" action="/register">
        @csrf
        <main class="flex items-center justify-center min-h-screen bg-base-500">
            <fieldset class="fieldset bg-base-300 border-base-300 rounded-box w-xs border p-6 mx-auto">
                <legend class="fieldset-legend text-lg font-bold">Sign Up </legend>

                <label class="label mt-2" for="name">User name </label>
                <input type="name" name="name" class="input w-full" placeholder="User name " required/>
                <x-error name="name"></x-error>
                <label class="label mt-2" for="Email">Email</label>
                <input type="email" name="email" class="input w-full" placeholder="user email" required/>
                <x-error name="email"></x-error>
                <label class="label mt-2">Password</label>
                <input type="password" name="password" class="input w-full" placeholder="Password" required/>
                <x-error name="password"></x-error>
                <label class="label mt-2">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input w-full" placeholder="Confirm Password" required/>
                <button class="btn btn-neutral mt-4 w-full">Register</button>
                <x-error name="generalError"></x-error>
            </fieldset>
        </main>
    </form>
</x-layout>
