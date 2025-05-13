<?php

namespace App\Http\Livewire; // Dies ist der korrekte Namespace

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';  // Hier speicherst du den Suchbegriff

    public function render()
    {
        $searchResults = [];

        // Nur Ergebnisse abrufen, wenn der Suchbegriff mindestens 2 Zeichen enthält
        if (strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie', [
                    'query' => $this->search,
                ])
                ->json('results');
        }

        // Rückgabe der Ergebnisse an die View
        return view('livewire.search-dropdown', [
            'searchResults' => $searchResults,
        ]);
    }
}
