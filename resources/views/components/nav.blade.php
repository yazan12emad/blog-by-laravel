<nav {{ $attributes->merge(['class' => 'sticky top-0 z-50 border-b border-slate-800 bg-slate-950/95 backdrop-blur']) }}>
    <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <div class="dropdown lg:hidden">
                <button tabindex="0" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-800 bg-slate-900 text-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <ul tabindex="0" class="menu dropdown-content z-60 mt-3 w-64 rounded-2xl border border-slate-800 bg-slate-950 p-3 shadow-xl">
                    <li>
                        <a href="/"
                           class="rounded-xl px-3 py-2 text-sm font-medium {{ request()->is('/') || request()->is('Home') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-900' }}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/blogs"
                           class="rounded-xl px-3 py-2 text-sm font-medium {{ request()->is('blogs') || request()->is('blogs/*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-900' }}">
                            Blogs
                        </a>
                    </li>
                    <li>
                        <a href="/category"
                           class="rounded-xl px-3 py-2 text-sm font-medium {{ request()->is('category') || request()->is('category/*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-900' }}">
                            Categories
                        </a>
                    </li>

                    @can('view-admin')
                        <li>
                            <a href="/notes"
                               class="rounded-xl px-3 py-2 text-sm font-medium {{ request()->is('notes') || request()->is('notes/*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-900' }}">
                                Notes
                            </a>
                        </li>
                    @endcan

                    @guest
                        <li class="mt-2">
                            <a href="/register" class="rounded-xl bg-white px-3 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-200">
                                Register
                            </a>
                        </li>
                        <li>
                            <a href="/logIn" class="rounded-xl border border-slate-700 px-3 py-2 text-sm font-semibold text-slate-200 hover:bg-slate-900">
                                Log In
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>

            <a href="/" class="flex items-center gap-3 rounded-xl px-2 py-1">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-sm font-bold text-slate-900">
                    B
                </span>
                <div class="leading-tight">
                    <p class="text-sm font-semibold text-white sm:text-base">Blog Laravel</p>
                </div>
            </a>
        </div>

        <div class="hidden lg:flex lg:items-center lg:gap-2">
            <a href="/"
               class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->path() === '/' ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                Home
            </a>
            <a href="/blogs"
               class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->is('blogs') || request()->is('blogs/*') ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                Blogs
            </a>
            <a href="/category"
               class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->is('category') || request()->is('category/*') ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                Categories
            </a>

            @can('view-admin')
                <a href="/notes"
                   class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->is('notes') || request()->is('notes/*') ? 'bg-white text-slate-900' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                    Notes
                </a>
            @endcan
        </div>

        <div class="flex items-center gap-2">
            @guest
                <div class="hidden sm:flex sm:items-center sm:gap-2">
                    <a href="/register" class="rounded-full border border-slate-700 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-slate-900">
                        Register
                    </a>
                    <a href="/logIn" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                        Log In
                    </a>
                </div>
            @endguest

            @auth
                <a href="{{ route('profile', auth()->user()->id) }}" class="hidden sm:block">
                    <img src="{{ auth()->user()->profile_image_url }}"
                         alt="User Avatar"
                         class="h-10 w-10 rounded-full border border-slate-700 object-cover">
                </a>

                <form method="post" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-full border cursor-pointer  border-slate-700 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:bg-slate-900">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
