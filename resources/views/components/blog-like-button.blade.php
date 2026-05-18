@props([
    'blog',
    'liked' => false,
    'likesCount' => 0,
    'action' => null,
])

@php
    $isLiked = filter_var($liked, FILTER_VALIDATE_BOOLEAN);
    $count = (int) $likesCount;
    $action ??= route('blog.toggle.like', $blog);
@endphp

{{--@once--}}
{{--    @push('styles')--}}
{{--        <style>--}}
{{--            .blog-like-button {--}}
{{--                position: relative;--}}
{{--                isolation: isolate;--}}
{{--            }--}}

{{--            .blog-like-button .like-icon {--}}
{{--                transform-origin: center;--}}
{{--                transition: fill 0.18s ease, stroke 0.18s ease, transform 0.18s ease;--}}
{{--            }--}}

{{--            .blog-like-button .like-ring {--}}
{{--                position: absolute;--}}
{{--                inset: -0.35rem;--}}
{{--                z-index: -1;--}}
{{--                border-radius: 9999px;--}}
{{--                opacity: 0;--}}
{{--                transform: scale(0.76);--}}
{{--                transition: opacity 0.18s ease, transform 0.18s ease;--}}
{{--            }--}}

{{--            .blog-like-button:not(.is-liked):hover .like-icon {--}}
{{--                transform: rotate(-8deg) scale(1.12);--}}
{{--                stroke: #fb7185;--}}
{{--            }--}}

{{--            .blog-like-button:not(.is-liked):active .like-icon {--}}
{{--                transform: rotate(-8deg) scale(0.92);--}}
{{--            }--}}

{{--            .blog-like-button.is-liked {--}}
{{--                border-color: rgba(251, 113, 133, 0.55);--}}
{{--                background: rgba(136, 19, 55, 0.18);--}}
{{--                color: #fecdd3;--}}
{{--            }--}}

{{--            .blog-like-button.is-liked .like-icon {--}}
{{--                fill: #f43f5e;--}}
{{--                stroke: #fb7185;--}}
{{--                animation: liked-heartbeat 1.8s ease-in-out infinite;--}}
{{--            }--}}

{{--            .blog-like-button.is-liked .like-ring {--}}
{{--                opacity: 1;--}}
{{--                transform: scale(1);--}}
{{--                background: radial-gradient(circle, rgba(251, 113, 133, 0.28), transparent 68%);--}}
{{--                animation: liked-glow 1.8s ease-in-out infinite;--}}
{{--            }--}}

{{--            .blog-like-form.is-submitting .like-icon {--}}
{{--                animation: like-pop 0.38s ease-out both;--}}
{{--            }--}}

{{--            /*--}}
{{--            /*@keyframes liked-heartbeat {--}}
{{--            /*    0%, 100% { transform: scale(1); }--}}
{{--            /*    45% { transform: scale(1.08); }--}}
{{--            /*}--}}

{{--            /*@keyframes liked-glow {--}}
{{--            /*    0%, 100% { opacity: 0.52; transform: scale(0.96); }--}}
{{--            /*    50% { opacity: 1; transform: scale(1.08); }--}}
{{--            /*}--}}
{{--            /*@keyframes like-pop {--}}
{{--            /*    0% { transform: scale(1); }--}}
{{--            /*    45% { transform: scale(1.24) rotate(-8deg); }--}}
{{--            /*    100% { transform: scale(1); }--}}
{{--            /*}--}}
{{--            */--}}

{{--        </style>--}}
{{--    @endpush--}}
{{--@endonce--}}


<style>
    .is-liked{
        background-color: #061465;
    }
    .like-icon-color{
transition: fill 0.18s ease, stroke 0.18s ease, transform 0.18s ease;
        fill: #f43f5e;
        stroke: #fb7185;
}

</style>

@auth
    <form method="POST"
          action="{{ $action }}"
          class="blog-like-form"
          onsubmit="this.classList.add('is-submitting')">
        @csrf
        <button type="submit"
                class="blog-like-button cursor-pointer {{ $isLiked ? 'is-liked' : '' }}
                 inline-flex min-h-11 items-center justify-center gap-2 rounded-2xl border
                 border-slate-700 bg-slate-950 px-4 py-2.5 text-sm font-semibold text-slate-200 hover:bg-slate-800
                 transition-transform duration-300 hover:scale-108 active:scale-95"
                title="{{ $isLiked ? 'Unlike this post' : 'Like this post' }}">
            <span class="like-ring" aria-hidden="true"></span>
            <svg class="like-icon h-5 w-5 {{$isLiked? 'like-icon-color' :''}}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"/>
            </svg>
            <span>{{ $isLiked ? 'Liked' : 'Like' }}</span>
            <span class="min-w-5 rounded-full bg-slate-800 px-2 py-0.5 text-xs text-slate-300">{{ $count }}</span>
        </button>
    </form>
@else
    <a href="{{ route('LogIn') }}"
       class="blog-like-button inline-flex min-h-11 items-center justify-center gap-2 rounded-2xl border border-slate-700 bg-slate-950 px-4 py-2.5 text-sm font-semibold text-slate-200 transition hover:bg-slate-800"
       title="Log in to like this post">
        <span class="like-ring" aria-hidden="true"></span>
        <svg class="like-icon h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78Z"/>
        </svg>
        <span>Like</span>
        <span class="min-w-5 rounded-full bg-slate-800 px-2 py-0.5 text-xs text-slate-300">{{ $count }}</span>
    </a>
@endauth
