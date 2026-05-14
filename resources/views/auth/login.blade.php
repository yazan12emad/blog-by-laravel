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
                        <input id="email" type="email" name="email"
                               class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                               placeholder="user@example.com" required>
                        <x-error name="email"></x-error>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="password">Password</label>
                        <input id="password" type="password" name="password"
                               class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                               placeholder="Your password" required>
                        <div class="relative">
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 bottom-3 -translate-y-1/2 text-slate-400 hover:text-white"
                            >
                                <!-- Eye Icon -->
                                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                                     width="20" height="20" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>

                                <!-- Eye Off Icon -->
                                <svg id="eyeClosed" class="hidden"
                                     xmlns="http://www.w3.org/2000/svg"
                                     width="20" height="20" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575"/>
                                    <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                                    <path d="m2 2 20 20"/>
                                </svg>
                            </button>

                        </div>
                        <x-error name="password"></x-error>
                    </div>

                    <label class="flex items-center gap-3 text-sm text-slate-300">
                        <input class="h-4 w-4 rounded border-slate-600 bg-slate-950 text-white" type="checkbox"
                               name="remember">
                        Remember me
                    </label>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <button
                        class="inline-flex flex-1 items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                        Log In
                    </button>
                    <a href="{{ route('register') }}"
                       class="inline-flex flex-1 items-center justify-center rounded-2xl border border-slate-700 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-950">
                        Sign up
                    </a>
                </div>
            </div>
        </form>
    </section>
</x-layout>

