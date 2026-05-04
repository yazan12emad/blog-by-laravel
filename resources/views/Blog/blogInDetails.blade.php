<x-layout title="{{ $blog->title }} | laravel">
    <style>
        .blog-detail-image {
            min-height: 18rem;
        }

        .blog-body p + p {
            margin-top: 1rem;
        }

        .category-modal::backdrop {
            background: rgba(2, 6, 23, 0.78);
            backdrop-filter: blur(4px);
        }

        .category-modal {
            width: min(100% - 1.5rem, 42rem);
            max-height: calc(100vh - 2rem);
            margin: auto;
            padding: 0;
            background: transparent;
            border: 1px white solid;
        }

        .category-modal[open] {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <section class="space-y-8">
        <div class="rounded-3xl border border-slate-800 bg-slate-900 px-6 py-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Blog details</p>
                    <h1 class="mt-3 text-3xl font-bold leading-tight text-white sm:text-5xl">
                        {{ $blog->title }}
                    </h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300">
                        {{ $blog->short_desc ?: 'This blog post does not have a short description yet.' }}
                    </p>
                </div>

                <a href="{{ route('blogs.show') }}"
                   class="inline-flex min-h-11 items-center justify-center rounded-2xl border border-slate-700 bg-slate-950 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
                    Back to blogs
                </a>
            </div>
        </div>
            <x-status_message></x-status_message>
<x-validation-errors></x-validation-errors>
        <article class="overflow-hidden rounded-3xl border border-slate-800 bg-slate-900">
            <div class="blog-detail-image bg-slate-950">
                @if($blog->image)
                    <img src="{{ asset($blog->image) }}"
                         alt="{{ $blog->title }}"
                         class="h-full max-h-128 w-full object-cover">
                @else
                    <div class="flex min-h-72 items-center justify-center bg-slate-950 px-6 py-16 text-center">
                        <div>
                            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-800 text-slate-300">
                                <svg class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75A2.25 2.25 0 0 1 6.75 4.5h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25H6.75a2.25 2.25 0 0 1-2.25-2.25V6.75Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 8.25h7.5M8.25 12h7.5M8.25 15.75h4.5"/>
                                </svg>
                            </div>
                            <p class="mt-4 text-sm font-medium text-slate-400">No image added for this blog yet.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="grid gap-8 p-6 lg:grid-cols-[1fr_18rem] lg:p-8">
                <div>
                    <div class="flex flex-wrap items-center gap-3 text-xs uppercase tracking-[0.18em] text-slate-500">
                        <span>{{ $blog->created_at?->format('M d, Y') }}</span>
                        <span class="h-1 w-1 rounded-full bg-slate-700"></span>
                        <span>{{ $blog->category->name }}</span>
                    </div>

                    <div class="blog-body mt-6 rounded-2xl border border-slate-800 bg-slate-950 p-5 text-base leading-8 text-slate-300 sm:p-6">
                        <p>{{ $blog->body ?: 'This blog post does not have body content yet.' }}</p>
                    </div>
                </div>

                <aside class="space-y-4">
                    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-5">
                        <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Author</p>
                        <div class="mt-4 flex items-center gap-3">
                            <img src="{{ $blog->author?->profile_image_url }}"
                                 alt="{{ $blog->author?->name ?? 'Author' }}"
                                 class="h-12 w-12 rounded-full border border-slate-700 object-cover">
                            <div>
                                <p class="font-semibold text-white">{{ $blog->author?->name ?? 'Unknown author' }}</p>
                                <p class="mt-1 text-xs text-slate-500">Post writer</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-slate-800 bg-slate-950 p-5">
                        <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Category</p>
                        <p class="mt-3 rounded-full border border-slate-700 px-3 py-2 text-sm font-medium text-slate-300">
                            {{ $blog->category?->name ?? 'Uncategorized' }}
                        </p>
                    </div>

                    @can('user-blog', $blog)
                        <div class="rounded-2xl border border-slate-800 bg-slate-950 p-5">
                            <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Actions</p>
                            <div class="mt-4 grid gap-3">
                                <x-edit-blog
                                    :modal-id="'edit-blog-' . $blog->id"
                                    :action="route('blog.update', $blog->id)"
                                    :blog="$blog"
                                    :categories="$categories"
                                />

                                <x-confirm-delete
                                    :modal-id="'delete-blog-' . $blog->id"
                                    :action="route('blog.destroy', $blog->id)"
                                    :item-name="$blog->title"
                                    title="Delete blog"
                                    button-class="inline-flex min-h-11 items-center justify-center rounded-2xl border border-rose-800 bg-rose-950/30 px-5 py-2.5 text-sm font-semibold text-rose-200 transition hover:bg-rose-950/50"
                                />

                            </div>
                        </div>
                    @endcan
                </aside>
            </div>
        </article>
    </section>
</x-layout>
