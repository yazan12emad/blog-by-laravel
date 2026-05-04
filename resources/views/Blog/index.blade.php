<x-layout title="Blogs | laravel">
    <style>
        .blog-card {
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            border-color: rgba(148, 163, 184, 0.65);
        }

        .blog-title {
            min-height: 4rem;
        }

        .blog-description {
            min-height: 5.25rem;
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
                <div class="max-w-2xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Blogs</p>
                    <h1 class="mt-3 text-3xl font-bold text-white sm:text-4xl">Latest blog posts</h1>
                    <p class="mt-3 text-sm leading-7 text-slate-300">
                        Read short posts, browse new ideas, and find content from different categories in one clean view.
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-800 bg-slate-950 px-5 py-4">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Total posts</p>
                    <p class="mt-2 text-3xl font-bold text-white">{{ $blogs->total() }}</p>
                </div>
            </div>
        </div>
        <x-status_message></x-status_message>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse($blogs as $blog)
                <article class="blog-card overflow-hidden rounded-3xl border border-slate-800 bg-slate-900">
                    <div class="relative h-48 bg-slate-950">
                        @if($blog->image)
                            <img src="{{ asset($blog->image) }}"
                                 alt="{{ $blog->title }}"
                                 class="h-full w-full object-cover">
                        @else
                            <div class="flex h-full w-full items-center justify-center bg-slate-950">
                                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-800 text-slate-300">
                                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75A2.25 2.25 0 0 1 6.75 4.5h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25H6.75a2.25 2.25 0 0 1-2.25-2.25V6.75Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 8.25h7.5M8.25 12h7.5M8.25 15.75h4.5"/>
                                    </svg>
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4 text-xs uppercase tracking-[0.18em] text-slate-500">
                            <span>Author: {{ $blog->author->name }}</span>
                            <span>{{ $blog->created_at?->format('M d, Y') }}</span>
                        </div>

                        <h2 class="blog-title mt-4 text-2xl font-semibold leading-8 text-white">
                            {{ $blog->title }}
                        </h2>

                        <p class="blog-description mt-3 text-sm leading-7 text-slate-400">
                            {{ $blog->short_desc ?: 'This blog post does not have a short description yet.' }}
                        </p>

                        <div class="mt-6 flex flex-col gap-4 border-t border-slate-800 pt-5 sm:flex-row sm:items-center sm:justify-between">
                            <span class="rounded-full border border-slate-700 px-3 py-1 text-xs font-medium text-slate-300">
                                {{ $blog->category->name }}
                            </span>

                            <div class="grid grid-cols-1 gap-3 sm:flex sm:items-center">
                                <a href="{{ route('blog.show.details', $blog->id) }}"
                                   class="inline-flex min-h-11 items-center justify-center cursor-pointer rounded-2xl bg-white px-5 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                                    Read post
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-700 bg-slate-900 px-6 py-14 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-800 text-slate-300">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75A2.25 2.25 0 0 1 6.75 4.5h10.5a2.25 2.25 0 0 1 2.25 2.25v10.5a2.25 2.25 0 0 1-2.25 2.25H6.75a2.25 2.25 0 0 1-2.25-2.25V6.75Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 8.25h7.5M8.25 12h7.5M8.25 15.75h4.5"/>
                        </svg>
                    </div>
                    <h3 class="mt-5 text-2xl font-semibold text-white">No blogs found</h3>
                    <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-slate-400">
                        Blog posts will appear here once they are created.
                    </p>
                </div>
            @endforelse
        </div>

        <div class="flex justify-center rounded-2xl border border-slate-800 bg-slate-900 px-5 py-5">
            {{ $blogs->links() }}
        </div>
    </section>
</x-layout>
