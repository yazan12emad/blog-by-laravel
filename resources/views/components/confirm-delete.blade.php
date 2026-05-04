@props([
    'modalId',
    'action',
    'itemName' => 'this item',
    'title' => 'Delete category',
    'message' => null,
    'buttonText' => 'Delete',
    'confirmText' => 'Yes, delete',
    'buttonClass' => 'inline-flex min-h-12 w-full items-center justify-center rounded-2xl border border-rose-800 bg-rose-950/30 px-4 py-3 text-sm font-semibold text-rose-200 transition hover:bg-rose-950/50',
])

<button type="button"
        onclick="document.getElementById('{{ $modalId }}').showModal()"
        class="{{ $buttonClass }}">
    {{ $buttonText }}
</button>

<dialog id="{{ $modalId }}" class="category-modal rounded-3xl border border-slate-800 bg-slate-900 p-0 text-slate-200 shadow-2xl">
    <div class="w-full max-w-md p-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h3 class="text-xl font-semibold text-white">{{ $title }}</h3>
                <p class="mt-2 text-sm leading-6 text-slate-400">
                    {{ $message ?: "Are you sure you want to delete {$itemName}? This action cannot be undone." }}
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

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:justify-end">
            <form method="dialog" class="sm:w-auto">
                <button type="submit"
                        class="inline-flex min-h-12 w-full items-center justify-center rounded-2xl border border-slate-700 bg-slate-950 px-5 py-3 text-sm font-semibold text-slate-200 transition hover:bg-slate-800">
                    Cancel
                </button>
            </form>

            <form method="post" action="{{ $action }}" class="sm:w-auto">
                @csrf
                @method('delete')
                <button type="submit"
                        class="inline-flex min-h-12 w-full items-center justify-center rounded-2xl bg-rose-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-rose-500">
                    {{ $confirmText }}
                </button>
            </form>
        </div>
    </div>
</dialog>
