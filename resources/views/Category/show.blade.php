<x-layout title="Categories | laravel">
    <style>
        .category-card {
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .category-card:hover {
            transform: translateY(-4px);
            border-color: rgba(148, 163, 184, 0.65);
        }

        .category-description {
            min-height: 4.5rem;
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
                    <p class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-400">Categories</p>
                    <h1 class="mt-3 text-3xl font-bold text-white sm:text-4xl">Browse content by topic</h1>
                    <p class="mt-3 text-sm leading-7 text-slate-300">
                        A simple category view with clear names, short descriptions, and actions based on the current user role.
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-800 bg-slate-950 px-5 py-4">
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Total categories</p>
                    <p class="mt-2 text-3xl font-bold text-white">{{ $Categories->total() }}</p>
                </div>
            </div>
        </div>
        <x-status_message></x-status_message>
        @can('view-admin')
            <div class="flex flex-col gap-4 rounded-3xl border border-slate-800 bg-slate-900 px-5 py-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-base font-semibold text-white">Admin tools</p>
                    <p class="mt-1 text-sm text-slate-400">Manage categories from the same view without changing the page flow.</p>
                </div>

                <x-create-category-modal
                    modal-id="create-category"
                    :action="route('category.store')"
                    button-text="Add new category"
                />
            </div>
        @endcan
        <x-error name="name"> </x-error>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
            @forelse($Categories as $category)
                <article class="category-card rounded-3xl border border-slate-800 bg-slate-900 p-6">
                    <div class="flex items-center justify-between gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-800 text-slate-200">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h3.343a2.25 2.25 0 0 1 1.591.659l1.157 1.157a2.25 2.25 0 0 0 1.591.659H18A2.25 2.25 0 0 1 20.25 10v6A2.25 2.25 0 0 1 18 18.25H6A2.25 2.25 0 0 1 3.75 16V7.5Z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h2 class="text-2xl font-semibold text-white">{{ $category->name }}</h2>
                        <p class="category-description mt-3 text-sm leading-7 text-slate-400">
                            {{ $category->description ?: 'This category does not have a description yet.' }}
                        </p>
                    </div>



                        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <a href="{{ route('blog.by.category', ['category'=> $category->id]) }}"
                               class="inline-flex min-h-12 w-full items-center justify-center rounded-2xl bg-white px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                                View
                            </a>
                            @can('view-admin')
                            <x-edit-category-modal
                                :modal-id="'edit-category-' . $category->id"
                                :action="route('category.update', $category->id)"
                                :category-id="$category->id"
                                :name="$category->name"
                                :description="$category->description"
                                :buttonText="'Edit'"
                            />
                            <x-confirm-delete
                                :modal-id="'delete-category-' . $category->id"
                                :action="route('category.destroy', $category->id)"
                                :item-name="$category->name"
                            />
                        </div>

                    @endcan
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-700 bg-slate-900 px-6 py-14 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-800 text-slate-300">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5A2.25 2.25 0 0 1 6 5.25h3.343a2.25 2.25 0 0 1 1.591.659l1.157 1.157a2.25 2.25 0 0 0 1.591.659H18A2.25 2.25 0 0 1 20.25 10v6A2.25 2.25 0 0 1 18 18.25H6A2.25 2.25 0 0 1 3.75 16V7.5Z"/>
                        </svg>
                    </div>
                    <h3 class="mt-5 text-2xl font-semibold text-white">No categories found</h3>
                    <p class="mx-auto mt-3 max-w-xl text-sm leading-7 text-slate-400">
                        Categories will appear here once they are created.
                    </p>

                    @can('view-admin')
                        <x-create-category-modal
                            modal-id="create-first-category"
                            :action="route('category.store')"
                            button-text="Create first category"
                            button-class="mt-8 inline-flex items-center justify-center rounded-2xl bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200"
                        />
                    @endcan
                    </div>
            @endforelse
    </section>
    <div class="mt-8 flex justify-center rounded-2xl border border-slate-800 bg-slate-900 px-5 py-5" >
        {{ $Categories->links() }}
    </div>
</x-layout>
