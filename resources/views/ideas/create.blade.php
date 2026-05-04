<x-layout title="Ideas | laravel ">
    <section class="mx-auto max-w-2xl rounded-3xl border border-slate-800 bg-slate-900 p-6">
        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-400">Ideas</p>
        <h1 class="mt-2 text-2xl font-bold text-white">Add a new idea</h1>

        <form id="form" method="post" action="/ideas" class="mt-6 space-y-4">
            @csrf

            <div class="space-y-2">
                <label for="description" class="text-sm font-medium text-slate-300">Description</label>
                <textarea id="description" name="description" rows="5" class="block w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500" placeholder="Write your idea here"></textarea>
            </div>

            <x-error name="description"></x-error>

            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                Add idea
            </button>
        </form>
    </section>
</x-layout>
