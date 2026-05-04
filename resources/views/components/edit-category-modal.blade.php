@props([
    'modalId',
    'action',
    'categoryId',
    'name' => '',
    'description' => '',
    'buttonText' => '',
    'title' => 'Edit category',
])

<button type="button"
        onclick="document.getElementById('{{ $modalId }}').showModal()"
        class="inline-flex min-h-12 w-full items-center justify-center rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
    {{ $buttonText }}
</button>

<dialog id="{{ $modalId }}" class="category-modal rounded-3xl border border-slate-800 bg-slate-900 p-0 text-slate-200 shadow-2xl">
    <div class="w-full max-w-2xl p-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $title }}</h3>
                <p class="mt-2 text-sm leading-6 text-slate-400">
                    Update the category name and description, then save your changes.
                </p>
            </div>

            <form method="dialog">
                <button type="submit"
                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-700 bg-slate-950 text-slate-300 transition hover:bg-slate-800">
                    <span class="sr-only">Close</span>
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18"/>
                    </svg>
                </button>
            </form>
        </div>

        <form method="post" action="{{ $action }}" class="mt-6 space-y-5">
            @csrf
            @method('patch')

            <input type="hidden" name="id" value="{{ $categoryId }}">

            <div class="space-y-2">
                <label for="name-{{ $categoryId }}" class="text-sm font-medium text-slate-300">Category name</label>
                <input id="name-{{ $categoryId }}"
                       type="text"
                       name="name"
                       value="{{ $name }}"
                       class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                       placeholder="Category name"
                       required>
            </div>

            <div class="space-y-2">
                <label for="description-{{ $categoryId }}" class="text-sm font-medium text-slate-300">Description</label>
                <textarea id="description-{{ $categoryId }}"
                          name="description"
                          rows="5"
                          class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                          placeholder="Category description">{{ $description }}</textarea>
            </div>

            <div class="flex flex-col gap-3 border-t border-slate-800 pt-5 sm:flex-row sm:justify-end">
                <button type="button"
                        onclick="document.getElementById('{{ $modalId }}').close()"
                        class="inline-flex min-h-12 w-full items-center justify-center rounded-2xl border border-slate-700 bg-slate-950 px-5 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
                    Cancel
                </button>

                <button type="submit"
                        class="inline-flex min-h-12 w-full items-center justify-center rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200 sm:w-auto">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</dialog>
