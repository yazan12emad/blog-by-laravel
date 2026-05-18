<x-layout title="log In | laravel">
    <section class="flex min-h-[70vh] items-center justify-center">

        <form method="post" action="{{route('submit.reset-password.form')}}" class="w-full max-w-md">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-white">Reset Password</h1>
                <p class="mt-2 text-sm text-slate-400">Enter your reset code.</p>

                <div class="mt-6 space-y-5">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="token">Reset code</label>
                        <input id="token" type="text" name="token" maxlength="6"
                               class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                               placeholder="123456" required>
                        <x-error name="token"></x-error>
                    </div>
                </div>
                <x-status_message></x-status_message>

                <div class="mt-6 space-y-5">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="password">Password</label>
                        <input id="password" type="password" name="password" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="Password" required>
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

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="password_confirmation">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="Confirm password" required>
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <button
                        class="inline-flex flex-1 items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                        Change password
                    </button>
                    <a href="{{ route('LogIn') }}"
                       class="inline-flex flex-1 items-center justify-center rounded-2xl border border-slate-700 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-950">
                        Back to log In
                    </a>
                </div>
            </div>
        </form>
    </section>
</x-layout>
