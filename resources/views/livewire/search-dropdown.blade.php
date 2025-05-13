<div x-data="{ open: false }" @click.away="open = false">
    <input
        wire:model="search"  <!-- Bindet die Livewire-Variable an das Eingabefeld -->
        type="text"
        class="bg-gray-800 text-sm rounded-full w-64 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 placeholder-gray-400"
        placeholder="Search"
        @focus="open = true"
    />

    <div x-show="open" class="absolute z-10 bg-gray-800 text-white rounded w-64 mt-4">
        @if(strlen($search) > 2)  <!-- Zeigt die Ergebnisse nur an, wenn mehr als 2 Zeichen eingegeben wurden -->
            <ul>
                <!-- Hier kannst du die Suchergebnisse rendern, z.B. Filme oder TV-Shows -->
                <li class="px-4 py-2 hover:bg-red-600">Example Result 1</li>
                <li class="px-4 py-2 hover:bg-red-600">Example Result 2</li>
            </ul>
        @else
            <p class="px-4 py-2 text-gray-400">Start typing to search...</p>
        @endif
    </div>
</div>
