@props([
    'blog',
])

<div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
    <p class="text-xs uppercase tracking-[0.22em] text-slate-500 mb-4">Leave a comment</p>

    @auth
        <form method="POST" action="{{ route('blog.add.comments', $blog) }}" class="flex flex-col gap-3">
            @csrf
            <label>
    <textarea
        name="comment_body"
        rows="3"
        maxlength="2500"
        placeholder="Share your thoughts on this post…"
        class="w-full rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-300 placeholder-slate-600 focus:outline-none focus:border-slate-700 resize-none"
    ></textarea>
            </label>
            <div class="flex items-center justify-between">
                <span class="text-xs text-white">Max 255 characters</span>
                <button type="submit"
                        class="inline-flex min-h-10 items-center justify-center gap-2 rounded-2xl bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-900 transition hover:bg-white">
                    Post comment
                </button>
            </div>
        </form>
    @else
        <div
            class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-950 px-4 py-3 text-sm text-slate-400">
            <a href="{{ route('LogIn') }}" class="font-semibold text-slate-200 underline underline-offset-2">Log in</a>
            to leave a comment.
        </div>
    @endauth
</div>

{{-- Comments List --}}
<div class="rounded-2xl border border-slate-800 bg-slate-900 overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-800">
        <p class="text-xs uppercase tracking-[0.22em] text-slate-500">Comments</p>
        <span class="rounded-full bg-slate-800 px-2.5 py-0.5 text-xs font-semibold text-slate-400">
            {{ $blog->comments_count ?? $blog->comments->count() }}
        </span>
    </div>

    @forelse($blog->comments as $comment)
        <div class="flex gap-3 px-6 py-4 border-b border-slate-800 last:border-b-0 hover:bg-slate-950/40 transition">
            <img src="{{ $comment->user?->profile_image_url }}"
                 alt="{{ $comment->user?->name }}"
                 class="h-9 w-9 rounded-full border border-slate-700 object-cover shrink-0">
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    <span class="text-sm font-semibold text-slate-100">{{ $comment->user?->name }}</span>
                    @if($comment->user_id === $blog->author_id)
                        <span
                            class="rounded-full border border-sky-800/40 bg-sky-950/30 px-2 py-0.5 text-[10px] font-bold uppercase tracking-widest text-sky-300">Author</span>
                    @endif
                    <span class="text-xs text-slate-600">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm text-slate-300 leading-relaxed">{{ $comment->comment_body }}</p>

                @can('deleteComment', $comment)
                    <form method="POST" action="{{ route('blog.delete.comments', [$blog->id , $comment->id]) }}" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 rounded-full border border-rose-900/40 bg-transparent
                                 px-3 py-1 text-[12px] font-bold uppercase tracking-wider text-rose-800 transition cursor-pointer
                                 hover:bg-rose-950/30 hover:text-rose-400 hover:border-rose-700/50">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.2">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14H6L5 6"/>
                                <path d="M9 6V4h6v2"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    @empty
        <div class="flex flex-col items-center py-10 text-center">
            <div class="mb-3 flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-800 text-slate-500">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
            </div>
            <p class="text-sm text-slate-500">No comments yet. Be the first!</p>
        </div>
    @endforelse
</div>
