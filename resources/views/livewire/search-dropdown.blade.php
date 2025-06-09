<div 
    class="relative" 
    x-data="{ 
        dropdownOpen: @entangle('showDropdown'),
        searchTerm: @entangle('search')
    }" 
    @click.away="dropdownOpen = false; $wire.hideDropdown()"
    x-on:search-updated.window="dropdownOpen = true"
    x-on:search-cleared.window="dropdownOpen = false"
>
    <div class="relative">
        <input
            wire:model.live.debounce.300ms="search"
            x-model="searchTerm"
            type="text"
            class="bg-gray-800 text-sm rounded-full w-64 px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-red-600 placeholder-gray-400"
            placeholder="Search movies & TV shows..."
            @focus="$wire.showDropdownIfResults()"
            autocomplete="off"
        />
        
        <!-- Loading Spinner -->
        <div wire:loading wire:target="search,performSearch" class="absolute right-3 top-1/2 transform -translate-y-1/2">
            <svg class="animate-spin h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
        
        <!-- Search Icon -->
        <div wire:loading.remove wire:target="search,performSearch" class="absolute right-3 top-1/2 transform -translate-y-1/2">
            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>

    <!-- Results Dropdown -->
    <div 
        x-show="dropdownOpen && searchTerm.length >= 2"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute z-50 bg-gray-800 text-white rounded-md w-full mt-2 shadow-lg border border-gray-700 max-h-96 overflow-y-auto"
        style="display: none;"
    >
        @if(count($searchResults) > 0)
            <div class="py-2">
                @foreach($searchResults as $index => $result)
                    <button 
                        wire:click="selectResult({{ $result['id'] }}, '{{ $result['media_type'] }}')"
                        class="w-full px-4 py-3 hover:bg-gray-700 focus:bg-gray-700 focus:outline-none text-left flex items-center space-x-3 transition-colors duration-150"
                        wire:key="search-result-{{ $result['id'] }}-{{ $index }}"
                    >
                        <div class="flex-shrink-0">
                            @if(!empty($result['poster_path']))
                                <img 
                                    src="https://image.tmdb.org/t/p/w92{{ $result['poster_path'] }}" 
                                    alt="{{ $result['title'] ?? $result['name'] ?? 'Movie/TV Show' }}"
                                    class="w-12 h-16 object-cover rounded shadow-sm"
                                    loading="lazy"
                                />
                            @else
                                <div class="w-12 h-16 bg-gray-600 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-white font-medium text-sm truncate">
                                {{ $result['title'] ?? $result['name'] ?? 'Unknown Title' }}
                            </div>
                            <div class="text-gray-400 text-xs flex items-center space-x-2 mt-1">
                                <span class="capitalize">{{ $result['media_type'] ?? 'unknown' }}</span>
                                @if(!empty($result['release_date']) || !empty($result['first_air_date']))
                                    <span>•</span>
                                    <span>
                                        @php
                                            $date = $result['release_date'] ?? $result['first_air_date'] ?? null;
                                        @endphp
                                        @if($date)
                                            {{ \Carbon\Carbon::parse($date)->format('Y') }}
                                        @endif
                                    </span>
                                @endif
                                @if(!empty($result['vote_average']) && $result['vote_average'] > 0)
                                    <span>•</span>
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="text-yellow-400">{{ number_format($result['vote_average'], 1) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        @elseif(strlen($search) >= 2)
            <div class="py-4 px-4 text-center" wire:loading.remove wire:target="search,performSearch">
                <p class="text-gray-400 text-sm">No results found for "{{ $search }}"</p>
            </div>
        @endif
    </div>

    <!-- Debug info (remove in production) -->
    @if(app()->environment('local'))
        <div class="absolute top-full left-0 mt-1 text-xs text-gray-400 bg-gray-900 p-2 rounded" wire:ignore>
            Results: {{ count($searchResults) }} | Show: {{ $showDropdown ? 'true' : 'false' }} | Search: "{{ $search }}"
        </div>
    @endif
</div>