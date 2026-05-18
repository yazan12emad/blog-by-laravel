<x-layout title="log In | laravel">
    <section class="flex min-h-[70vh] items-center justify-center">
        <form method="post" action="{{route('submit.forgot-password.form')}}" class="w-full max-w-md">
            @csrf

            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-white">Reset Password</h1>
                <p class="mt-2 text-sm text-slate-400">Enter your email to receive a password reset link.</p>

                <div class="mt-6 space-y-5">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-slate-300" for="email">Email</label>
                        <input id="email" type="email" name="email"
                               class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                               placeholder="user@example.com" required>
                        <x-error name="email"></x-error>
                    </div>
                </div>
                <x-status_message></x-status_message>
                <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                    <button
                        class="inline-flex flex-1 items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                        Send reset link
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
