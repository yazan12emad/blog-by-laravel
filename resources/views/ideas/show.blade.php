<x-layout title="Ideas | laravel ">
    <section class="mx-auto max-w-2xl rounded-3xl border border-slate-800 bg-slate-900 p-6">
        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-400">Idea</p>
        <div class="mt-4 rounded-2xl border border-slate-800 bg-slate-950 p-5 text-base font-medium leading-7 text-slate-200">
            {{ $idea->description }}
        </div>

        <a class="mt-6 inline-flex items-center justify-center rounded-2xl
        bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200" href="/ideas/{{ $idea->id }}/edit">
            Update
        </a>
    </section>
</x-layout>
