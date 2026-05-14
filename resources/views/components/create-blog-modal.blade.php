@props([
    'modalId',
    'action',
    'categories' => [],
    'buttonText' => 'Add new blog',
    'title' => 'Create blog',
    'buttonClass' => 'inline-flex items-center justify-center rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200',
])

<button type="button"
        onclick="document.getElementById('{{ $modalId }}').showModal()"
        class="{{ $buttonClass }} cursor-pointer transition hover:scale-105">
    {{ $buttonText }}
</button>

<dialog id="{{ $modalId }}" class="category-modal rounded-3xl border border-slate-800 bg-slate-900 p-0 text-slate-200 shadow-2xl">
    <div class="w-full max-w-2xl p-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $title }}</h3>
                <p class="mt-2 text-sm leading-6 text-slate-400">
                    Add the blog details, image, category.
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

        <form method="post"
              action="{{ $action }}"
              enctype="multipart/form-data"
              class="mt-6 space-y-5"
              data-blog-create-form
              novalidate>
            @csrf

            <div class="space-y-2">
                <label for="create-title-{{ $modalId }}" class="text-sm font-medium text-slate-300">Blog title</label>
                <input id="create-title-{{ $modalId }}"
                       type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                       placeholder="Blog title"
                       required>
                <p class="hidden text-sm font-medium text-rose-300" data-error-for="title"></p>
                @error('title')
                <p class="text-sm font-medium text-rose-300">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="create-short-desc-{{ $modalId }}" class="text-sm font-medium text-slate-300">Short description</label>
                <textarea id="create-short-desc-{{ $modalId }}"
                          name="short_desc"
                          rows="3"
                          class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                          placeholder="Short blog description"
                          required>{{ old('short_desc') }}</textarea>
                <p class="hidden text-sm font-medium text-rose-300" data-error-for="short_desc"></p>
                @error('short_desc')
                <p class="text-sm font-medium text-rose-300">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="create-body-{{ $modalId }}" class="text-sm font-medium text-slate-300">Body</label>
                <textarea id="create-body-{{ $modalId }}"
                          name="body"
                          rows="7"
                          class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                          placeholder="Write the blog content"
                          required>{{ old('body') }}</textarea>
                <p class="hidden text-sm font-medium text-rose-300" data-error-for="body"></p>
                @error('body')
                <p class="text-sm font-medium text-rose-300">{{ $message }}</p>
                @enderror
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
                    <label for="create-category-{{ $modalId }}" class="text-sm font-medium text-slate-300">Category</label>
                    <select id="create-category-{{ $modalId }}"
                            name="category_id"
                            class="w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none transition focus:border-slate-500"
                            required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="hidden text-sm font-medium text-rose-300" data-error-for="category_id"></p>
                    @error('category_id')
                    <p class="text-sm font-medium text-rose-300">{{ $message }}</p>
                    @enderror
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
                    Create blog
                </button>
            </div>
        </form>
    </div>
</dialog>

<script>
    (() => {
        const form = document.querySelector('#{{ $modalId }} [data-blog-create-form]');

        if (!form || form.dataset.validationReady === 'true') {
            return;
        }

        form.dataset.validationReady = 'true';

        const fields = {
            title: form.elements.title,
            short_desc: form.elements.short_desc,
            body: form.elements.body,
            image: form.elements.image,
            category_id: form.elements.category_id,
        };

        const setError = (name, message = '') => {
            const error = form.querySelector(`[data-error-for="${name}"]`);
            const field = fields[name];

            if (!error || !field) {
                return;
            }

            error.textContent = message;
            error.classList.toggle('hidden', !message);
            field.classList.toggle('border-rose-400', Boolean(message));
            field.classList.toggle('border-slate-700', !message);
        };

        const validateField = (name) => {
            const field = fields[name];
            const value = field?.value?.trim() ?? '';

            if (name === 'title') {
                if (!value) return 'The title field is required.';
                if (value.length > 50) return 'The title may not be greater than 50 characters.';
            }

            if (name === 'short_desc') {
                if (!value) return 'The short description field is required.';
                if (value.length > 100) return 'The short description may not be greater than 100 characters.';
            }

            if (name === 'body' && !value) {
                return 'The body field is required.';
            }

            if (name === 'category_id' && !value) {
                return 'The category field is required.';
            }

            if (name === 'image' && field.files.length > 0) {
                const image = field.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                if (!allowedTypes.includes(image.type)) {
                    return 'The image must be a JPG or PNG file.';
                }

                if (image.size > 2048 * 1024) {
                    return 'The image may not be greater than 2 MB.';
                }
            }

            return '';
        };

        Object.keys(fields).forEach((name) => {
            fields[name]?.addEventListener('input', () => setError(name, validateField(name)));
            fields[name]?.addEventListener('change', () => setError(name, validateField(name)));
        });

        form.addEventListener('submit', (event) => {
            const hasErrors = Object.keys(fields).reduce((foundError, name) => {
                const message = validateField(name);
                setError(name, message);

                return foundError || Boolean(message);
            }, false);

            if (hasErrors) {
                event.preventDefault();
                return;
            }
        });
    })();
</script>
