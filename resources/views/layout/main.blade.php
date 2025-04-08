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
            <!-- Logo (Movie SVG) -->
            <ul class="flex flex-col md:flex-row items-center space-x-8">
                <li>
                    <a href="{{route('movie.index')}}">
                        <img src="{{ asset('images/Movie.svg') }}" alt="Logo" class="w-12 h-auto">
                    </a>
                </li>
                <li class="md:ml-16 mt-3 md:mt-0">
                    <a href="{{route('movie.index')}}" class="hover:text-red-600">Movies</a>
                </li>                
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{route('tv.show')}}" class="hover:text-red-600">TV Shows</a>
                </li>
                <li class="md:ml-6 mt-3 md:mt-0">
                    <a href="{{route('actor.show')}}" class="hover:text-red-600">Actors</a>
                </li>
            </ul>
            
            <!-- Search Bar and Avatar -->
            <div class="flex flex-col md:flex-row items-center space-x-4">
                <!-- Search Bar -->
                <div class="relative mt-3 md:mt-0">
                    <input type="text" class="bg-gray-800 text-sm rounded-full w-64 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 placeholder-gray-400" placeholder="Search">
                </div>
                
                <!-- Avatar (Right aligned) -->
                <div class="md:ml-auto mt-3 md:mt-0">
                    <a href="">
                        <img src="{{ asset('images/avatar.svg') }}" alt="avatar" class="rounded-full w-10 h-10 border-2 border-red-600">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
</html>
