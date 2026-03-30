<div class="navbar bg-gray-700 shadow-sm">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
                </svg>
            </div>
            <ul
                tabindex="-1"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <li>
                    <ul class="p-2 bg-base-100 w-40 z-1">
                        <li class="listedLinks"><a href="/">Home page</a></li>
                        <li class="listedLinks"><a href="/about">About Us</a></li>
                        <li class="listedLinks"><a href="/contact">Contact Us</a></li>
                        <li class="listedLinks"><a href="/ideas">show Ideas</a></li>
                        <li class="listedLinks"><a href="/ideas/create">Form link</a></li>
                        <li class="listedLinks"><a href="/notes">Notes file</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <a class="btn btn-ghost text-xl">Ideas </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/">Home page</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact Us</a></li>
            <li><a href="/ideas">show Ideas</a></li>
            <li><a href="/ideas/create">Form link</a></li>
            @can('view-admin')
                <li><a href="/notes">Notes file</a></li>
            @endcan

        </ul>
    </div>
    @guest()
        <div class="navbar-end space-x-3">
            <a href="/register" class="btn  rounded-2xl bg-gray-600 border-0
         transition-transform duration-300 hover:scale-112">Register </a>


            <a href="/logIn" class="btn rounded-2xl bg-blue-600 border-0
         transition-transform duration-300 hover:scale-112">Log In </a>
        </div>

    @endguest

    @auth()
        <form class="navbar-end" method="post" action="/logout">
            @csrf
            @method('DELETE')
            <div>
                <button class="btn rounded-[100px] bg-red-700 border-none
         transition-transform duration-300 hover:scale-112">logout
                </button>
            </div>
        </form>
    @endauth

</div>
