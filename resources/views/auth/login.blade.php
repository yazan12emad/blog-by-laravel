<x-layout title="log In | laravel">

    <div class="flex justify-center items-center min-h-screen pt-[-100px] ">
        <form method="post" action="/logIn">
            @csrf
            <main class=" w-full max-w-md">
                <fieldset class="fieldset bg-base-300 border-base-300 rounded-box w-xs border p-6 mx-auto">
                    <legend class="fieldset-legend text-lg  ">Login</legend>

                    <label class="label mt-2" for="Email">Email</label>
                    <input type="email" name="email" class="input w-full" placeholder="User@gmail.com" required/>
                    <x-error name="email"></x-error>

                    <label class="label mt-2">Password</label>
                    <input type="password" name="password" class="input w-full" placeholder="12345678" required/>
                    <x-error name="password"></x-error>

                    <div class=" mt-3 flex justify-between items-center">
                        <label class="flex items-center gap-2 text-sm">
                            <input class="checkbox  rounded-full text-blue-500  " type="checkbox" name="remember">
                            <div class=" text-lg font-bold "> Remember Me</div>
                        </label>
                    </div>
                    <div class="inline-flex gap-4 justify-between items-center w-full">
                        <button class="btn btn-neutral mt-4 rounded-full w-25 hover:scale-112 transition-transform duration-500
                           active:scale-100  ">
                            <a href="{{ route('register') }}"
                           class="text-lg  ">
                            Sign up
                        </a>
                    </button>
                        <button class="btn btn-neutral mt-4 rounded-full w-25 hover:scale-112 transition-transform duration-500
                           active:scale-100  ">
                        <spam class="text-lg"> Log In </spam>
                        </button>
                    </div>
                </fieldset>
            </main>
        </form>
    </div>

</x-layout>
