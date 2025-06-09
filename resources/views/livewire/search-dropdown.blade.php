<div 
    x-data="{ 
        open: @entangle('showDropdown'),
        selectedIndex: @entangle('selectedIndex')
    }" 
    @click.away="$wire.hideDropdown()" 
    @keydown.escape.window="$wire.hideDropdown()"
    @keydown.arrow-down.prevent="$wire.keyDown()"
    @keydown.arrow-up.prevent="$wire.keyUp()"
    @keydown.enter.prevent="$wire.keyEnter()"
    class="relative"
>
    <!-- Search Input -->
    <div class="relative">
        <input
            wire:model.debounce.300ms="search"
            type="text"
            class="bg-gray-800 text-sm rounded-full w-64 px-4 py-2 pr-8 focus:outline-none focus:ring-2 focus:ring-red-600 placeholder-gray-400 text-white"
            placeholder="Search movies, shows, actors..."
            @focus="$wire.set('showDropdown', true)"
            autocomplete="off"
        />
        
        <!-- Clear button -->
        @if($search)
            <button 
                wire:click="clearSearch"
                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-white transition-colors"
                type="button"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        @endif
    </div>

    <!-- Search Results Dropdown -->
    <div 
        x-show="open && {{ count($searchResults) > 0 ? 'true' : 'false' }}"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 w-full mt-2 bg-gray-900 border border-gray-700 rounded-lg shadow-xl max-h-96 overflow-y-auto"
        style="display: none;"
    >
        @if(strlen($search) >= 2)
            @forelse($searchResults as $index => $result)
                <div 
                    wire:click="selectResult({{ $index }})"
                    class="flex items-center p-3 hover:bg-gray-800 cursor-pointer transition-colors border-b border-gray-700 last:border-b-0 {{ $selectedIndex === $index ? 'bg-gray-800' : '' }}"
                >
                    <!-- Poster/Profile Image -->
                    <div class="flex-shrink-0 w-12 h-16 mr-3">
                        @if($result['poster_path'])
                            <img 
                                src="https://image.tmdb.org/t/p/w92{{ $result['poster_path'] }}" 
                                alt="{{ $result['title'] }}"
                                class="w-full h-full object-cover rounded {{ $result['type'] === 'person' ? 'rounded-full' : 'rounded' }}"
                            />
                        @else
                            <div class="w-full h-full bg-gray-700 rounded flex items-center justify-center">
                                @if($result['type'] === 'person')
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 1v12a2 2 0 002 2h8a2 2 0 002-2V5H7z"></path>
                                    </svg>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="text-white font-medium truncate">
                            {{ $result['title'] }}
                        </div>
                        <div class="text-gray-400 text-sm truncate">
                            {{ $result['subtitle'] }}
                        </div>
                    </div>

                    <!-- Type Badge -->
                    <div class="flex-shrink-0 ml-2">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            {{ $result['type'] === 'movie' ? 'bg-red-600 text-white' : '' }}
                            {{ $result['type'] === 'tv' ? 'bg-blue-600 text-white' : '' }}
                            {{ $result['type'] === 'person' ? 'bg-green-600 text-white' : '' }}
                        ">
                            @if($result['type'] === 'movie')
                                Movie
                            @elseif($result['type'] === 'tv')
                                TV
                            @else
                                Actor
                            @endif
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-4 text-gray-400 text-center">
                    No results found for "{{ $search }}"
                </div>
            @endforelse
        @else
            <div class="p-4 text-gray-400 text-center">
                Type at least 2 characters to search...
            </div>
        @endif

        @if(count($searchResults) > 0)
            <div class="p-2 text-xs text-gray-500 text-center bg-gray-800 border-t border-gray-700">
                Use ↑↓ arrows to navigate, Enter to select
            </div>
        @endif
    </div>

    <!-- Loading indicator -->
    <div 
        wire:loading.delay 
        wire:target="search"
        class="absolute right-2 top-1/2 transform -translate-y-1/2"
    >
        <svg class="animate-spin h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
</div>