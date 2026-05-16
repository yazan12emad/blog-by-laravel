@props([
    'modalId',
    'action',
    'blog',
    'categories' => [],
    'buttonText' => 'Edit blog',
    'title' => 'Edit blog',
])

<button type="button"
        onclick="document.getElementById('{{ $modalId }}').showModal()"
        class="inline-flex cursor-pointer min-h-11 w-full items-center justify-center rounded-2xl bg-white px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
    {{ $buttonText }}
</button>

<dialog id="{{ $modalId }}" class="category-modal rounded-3xl border border-slate-800 bg-slate-900 p-0 text-slate-200 shadow-2xl">
    <div class="w-full max-w-2xl p-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $title }}</h3>
                <p class="mt-2 text-sm leading-6 text-slate-400">
                    Update the blog details, image, category, and status, then save your changes.
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

        <form method="post" action="{{ $action }}" enctype="multipart/form-data" class="mt-6 space-y-5">
            @csrf
            @method('patch')
            <input type="hidden" name="id" value="{{ $blog->id }}">

            <div class="space-y-2">
                <label for="title-{{ $blog->id }}" class="text-sm font-medium text-slate-300">Blog title</label>
                <input id="title-{{ $blog->id }}"
                       type="text"
                       name="title"
                       value="{{ $blog->title }}"
                       class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                       placeholder="Blog title"
                       required>
            </div>

            <div class="space-y-2">
                <label for="short-desc-{{ $blog->id }}" class="text-sm font-medium text-slate-300">Short description</label>
                <textarea id="short-desc-{{ $blog->id }}"
                          name="short_desc"
                          rows="3"
                          class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                          placeholder="Short blog description">{{ $blog->short_desc }}</textarea>
            </div>

            <div class="space-y-2">
                <label for="body-{{ $blog->id }}" class="text-sm font-medium text-slate-300">Body</label>
                <textarea id="body-{{ $blog->id }}"
                          name="body"
                          rows="7"
                          class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                          placeholder="Write the blog content">{{ $blog->body }}</textarea>
            </div>
            <div class="space-y-2">
                <label for="create-image-{{ $modalId }}" class="text-sm font-medium text-slate-300">Image</label>
                <input id="create-image-{{ $modalId }}"
                       type="file"
                       name="image"
                       accept="image/jpeg,image/png,image/jpg"
                       class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition file:mr-4 file:rounded-xl file:border-0 file:bg-white file:px-4 file:py-2 file:text-sm file:font-semibold file:text-slate-900 focus:border-slate-500">
                <p class="hidden text-sm font-medium text-rose-300" data-error-for="image"></p>
                @error('image')
                <p class="text-sm font-medium text-rose-300">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="space-y-2">
                    <label for="category-{{ $blog->id }}" class="text-sm font-medium text-slate-300">Category</label>
                    <select id="category-{{ $blog->id }}"
                            name="category_id"
                            class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500">
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}" @selected($blog->category_id == $category->id)>
                                {{ $category->name }}
                            </option>
                        @empty
                            <option value="{{ $blog->category_id }}">
                                {{ $blog->category?->name ?? 'Current category' }}
                            </option>
                        @endforelse
                    </select>
                </div>
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
