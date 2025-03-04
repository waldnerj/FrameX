@extends('layout.main')

@section('content')
<div class="movie-info border-b border-gray-800 bg-black">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <!-- Movie Image -->
        <img src="{{ asset('images/PARASITE.jpeg') }}" alt="parasite" class="w-96 rounded-lg shadow-lg">
        
        <!-- Movie Details -->
        <div class="ml-16 max-w-2xl">
            <h2 class="text-4xl font-semibold text-white">Parasite (2019)</h2>
            
            <!-- Rating and Movie Info -->
            <div class="flex items-center text-gray-400 text-sm mt-2">
                <img src="{{ asset('images/star.svg') }}" alt="Star" class="w-5 h-5 text-red-600">
                <span class="ml-1 text-red-600">85%</span>
                <span class="mx-2">|</span>       
                <span>Feb 20, 2020</span>
                <span class="mx-2">|</span>  
                <span>Action, Thriller, Drama</span>
            </div>

            <!-- Movie Description -->
            <p class="text-gray-300 mt-6 leading-relaxed">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium natus unde et ipsam magnam, pariatur distinctio accusantium numquam architecto laudantium eos dolore nobis eligendi iure voluptatibus quod quas inventore illo.
            </p>
            
            <!-- Featured Cast -->
            <div class="mt-10">
                <h4 class="text-white font-semibold">Featured Cast</h4>
                <div class="flex mt-4">
                    <div class="mr-8">
                        <div class="font-semibold text-white">Bong Joon-ho</div>
                        <div class="text-sm text-gray-400">Screenplay, Director, Story</div>
                    </div>
                    <div>
                        <div class="font-semibold text-white">Han Jin-won</div>
                        <div class="text-sm text-gray-400">Screenplay</div>
                    </div>
                </div>
            </div>

            <!-- Play Trailer Button -->
            <div class="mt-10">
                <button class="flex items-center bg-red-600 text-white rounded-lg font-semibold px-6 py-3 hover:bg-red-700 transition duration-200">
                    <img src="{{ asset('images/play.svg') }}" alt="Play" class="w-6 h-6">
                    <span class="ml-3">Play Trailer</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Cast Section (Movies displayed side by side) -->
<div class="movie-cast border-b border-grey-800 bg-black">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold text-white">Cast</h2>

        <!-- Grid layout to display only 5 items in a row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 mt-8">
            <!-- Movie 1 -->
            <div class="flex-shrink-0">
                <a href="">
                    <img src="{{ asset('images/PARASITE.jpeg') }}" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                </a>
                <div class="mt-2">
                    <a href="" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">Parasite</a>
                    <div class="text-gray-400 text-sm">
                        John Doe
                    </div>
                </div>
            </div>

            <!-- Movie 2 -->
            <div class="flex-shrink-0">
                <a href="">
                    <img src="{{ asset('images/PARASITE.jpeg') }}" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                </a>
                <div class="mt-2">
                    <a href="" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">Parasite</a>
                    <div class="text-gray-400 text-sm">
                        John Doe
                    </div>
                </div>
            </div>

            <!-- Movie 3 -->
            <div class="flex-shrink-0">
                <a href="">
                    <img src="{{ asset('images/PARASITE.jpeg') }}" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                </a>
                <div class="mt-2">
                    <a href="" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">Parasite</a>
                    <div class="text-gray-400 text-sm">
                        John Doe
                    </div>
                </div>
            </div>

            <!-- Movie 4 -->
            <div class="flex-shrink-0">
                <a href="">
                    <img src="{{ asset('images/PARASITE.jpeg') }}" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                </a>
                <div class="mt-2">
                    <a href="" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">Parasite</a>
                    <div class="text-gray-400 text-sm">
                        John Doe
                    </div>
                </div>
            </div>

            <!-- Movie 5 -->
            <div class="flex-shrink-0">
                <a href="">
                    <img src="{{ asset('images/PARASITE.jpeg') }}" alt="Parasite" class="hover:opacity-75 transition ease-in-out duration-150 rounded-md shadow-lg">
                </a>
                <div class="mt-2">
                    <a href="" class="text-lg font-semibold text-white hover:text-red-600 transition duration-300">Parasite</a>
                    <div class="text-gray-400 text-sm">
                        John Doe
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
