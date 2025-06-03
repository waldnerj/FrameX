<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-black text-white">
    <nav class="border-b border-gray-800">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between px-6 py-6">
            <ul class="flex flex-col md:flex-row items-center space-x-8">
                <li>
                    <a href="{{route('movies.movieIndex')}}">
                        <img src="{{ asset('images/Movie.svg') }}" alt="Logo" class="w-12 h-auto">
                    </a>
                </li>
                <li class="md:ml-16 mt-3 md:mt-0">
                    <a href="{{route('movies.movieIndex')}}" class="hover:text-red-600">Movies</a>
                </li>                
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{route('movies.tvIndex')}}" class="hover:text-red-600">TV Shows</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{route('movies.actorIndex')}}" class="hover:text-red-600">Actors</a>
                </li>
            </ul>
            
            <!-- Search Bar and Avatar -->
            <div class="flex flex-col md:flex-row items-center space-x-4">
                <!-- Search Bar -->
                <div class="relative mt-3 md:mt-0">
                    <input type="text" class="bg-gray-800 text-sm rounded-full w-64 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 placeholder-gray-400" placeholder="Search">
                </div>
                
                <!-- Avatar (Right aligned) -->
                <!-- Authentifizierungsbereich -->
<div class="md:ml-auto mt-3 md:mt-0">
    @auth
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <!-- Jetstream: Profilbild mit Dropdown -->
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-red-600" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Profil -->
                    <x-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profil') }}
                    </x-dropdown-link>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Abmelden') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @endif
    @else
        <!-- Login & Registrieren -->
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
