<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Movie App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js für Dropdown-Funktionalität -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans bg-black text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between py-6">
            <ul class="flex flex-col md:flex-row items-center space-x-8">
                <li>
                    <a href="{{ route('movies.movieIndex') }}">
                        <img src="{{ asset('images/Movie.svg') }}" alt="Logo" class="w-12 h-auto" />
                    </a>
                </li>
                <li class="md:ml-16 mt-3 md:mt-0">
                    <a href="{{ route('movies.movieIndex') }}" class="hover:text-red-600">Movies</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('movies.tvIndex') }}" class="hover:text-red-600">TV Shows</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('movies.actorIndex') }}" class="hover:text-red-600">Actors</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{ route('watchlist.index') }}" class="hover:text-red-600">Watch List</a>
                </li>
            </ul>

            <!-- Search Bar and Auth Section -->
            <div class="flex flex-col md:flex-row items-center space-x-4">
                <!-- Search Bar -->
                <div class="relative mt-3 md:mt-0">
                    <input
                        type="text"
                        class="bg-gray-800 text-sm rounded-full w-64 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 placeholder-gray-400"
                        placeholder="Search"
                    />
                </div>

                <!-- Auth Section -->
                <div
                    class="md:ml-auto mt-3 md:mt-0 relative"
                    x-data="{ open: false }"
                    @keydown.escape.window="open = false"
                    @click.away="open = false"
                >
                    @auth
                        <button
                            @click="open = !open"
                            type="button"
                            class="flex items-center text-sm font-medium text-white hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-red-600 rounded"
                            aria-haspopup="true"
                            :aria-expanded="open.toString()"
                            id="user-menu-button"
                        >
                            {{ Auth::user()->name }}
                            <svg
                                class="ml-2 h-4 w-4 transition-transform duration-200"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                :class="{ 'rotate-180': open }"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-4 w-48 bg-gray-900 rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-20 flex flex-col"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1"
                            style="display: none;"
                        >
                            <a
                                href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-sm text-white hover:bg-red-600"
                                role="menuitem"
                                tabindex="-1"
                            >
                                Einstellungen
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="block m-0 p-0" role="none">
                                @csrf
                                <button
                                    type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-red-600"
                                    role="menuitem"
                                    tabindex="-1"
                                >
                                    Abmelden
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-white hover:text-red-500">Login</a>
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-white hover:text-red-500">Registrieren</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
