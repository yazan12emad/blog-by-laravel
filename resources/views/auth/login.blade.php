<x-layout title="log In | laravel">
    <section class="flex min-h-[70vh] items-center justify-center">
        <form method="post" action="/logIn" class="w-full max-w-md">
            @csrf

            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-white">Log in</h1>
                <p class="mt-2 text-sm text-slate-400">Access your account with a simple dark form.</p>

                <div class="mt-6 space-y-5">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="email">Email</label>
                        <input id="email" type="email" name="email" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="user@example.com" required>
                        <x-error name="email"></x-error>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="password">Password</label>
                        <input id="password" type="password" name="password" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="Your password" required>
                        <x-error name="password"></x-error>
                    </div>

                    <label class="flex items-center gap-3 text-sm text-slate-300">
                        <input class="h-4 w-4 rounded border-slate-600 bg-slate-950 text-white" type="checkbox" name="remember">
                        Remember me
                    </label>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <button class="inline-flex flex-1 items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                        Log In
                    </button>
                    <a href="{{ route('register') }}" class="inline-flex flex-1 items-center justify-center rounded-2xl border border-slate-700 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-950">
                        Sign up
                    </a>
                </div>
            </div>
        </form>
    </section>
</x-layout>
