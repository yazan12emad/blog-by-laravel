<x-layout title="Email Verification | Laravel">
    <section class="flex min-h-[70vh] items-center justify-center">
        <div class="w-full max-w-xl rounded-3xl border border-slate-800 bg-slate-900 p-6 shadow-2xl sm:p-8">
            <div class="flex h-14 w-14 items-center justify-center rounded-2xl border border-emerald-800 bg-emerald-950/50 text-emerald-300">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="28"
                     height="28"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/>
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                </svg>
            </div>

            <div class="mt-6">
                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Verify email</p>
                <h1 class="mt-3 text-3xl font-bold text-white">Check your inbox</h1>
                <p class="mt-3 text-sm leading-6 text-slate-400">
                    We sent a verification link to your email address. Open the email and click the verification link to activate your account.
                </p>
            </div>

            <x-status_message></x-status_message>

            <div class="mt-8 rounded-2xl border border-slate-800 bg-slate-950 p-5">
                <p class="text-sm leading-6 text-slate-300">
                    Did not receive the email? Send a fresh verification link.
                </p>

                <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
                    @csrf
                    <button type="submit"
                            class="inline-flex w-full items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                        Resend verification email
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-layout>
