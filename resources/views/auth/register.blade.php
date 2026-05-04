<x-layout title="register | laravel">
    <section class="flex min-h-[70vh] items-center justify-center">
        <form method="post" action="/register" class="w-full max-w-md">
            @csrf

            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-white">Create account</h1>
                <p class="mt-2 text-sm text-slate-400">A simpler sign-up form with a darker look.</p>

                <div class="mt-6 space-y-5">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="name">User name</label>
                        <input id="name" type="text" name="name" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="Your name" required>
                        <x-error name="name"></x-error>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="email">Email</label>
                        <input id="email" type="email" name="email" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="user@example.com" required>
                        <x-error name="email"></x-error>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="password">Password</label>
                        <input id="password" type="password" name="password" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="Password" required>
                        <x-error name="password"></x-error>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="password_confirmation">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="Confirm password" required>
                    </div>
                </div>

                <button class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                    Register
                </button>

                <x-error name="generalError"></x-error>
            </div>
        </form>
    </section>
</x-layout>
