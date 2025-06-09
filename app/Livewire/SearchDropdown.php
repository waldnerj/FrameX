<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public $searchResults = [];
    public $showDropdown = false;

    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->searchResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/multi', [
                    'query' => $this->search,
                    'include_adult' => true,
                ])
                ->json('results', []);
            
            // Filter and limit results to movies and TV shows only
            $this->searchResults = collect($this->searchResults)
                ->filter(function ($result) {
                    return in_array($result['media_type'] ?? '', ['movie', 'tv']) && 
                           !empty($result['poster_path']);
                })
                ->take(6) // Limit to 6 results
                ->toArray();
            
            $this->showDropdown = true;
        } else {
            $this->searchResults = [];
            $this->showDropdown = false;
        }
    }

    public function selectResult($id, $mediaType)
    {
        $this->search = '';
        $this->searchResults = [];
        $this->showDropdown = false;
        
        if ($mediaType === 'movie') {
            return redirect()->route('movies.showMovie', $id);
        } elseif ($mediaType === 'tv') {
            return redirect()->route('movies.showTv', $id);
        }
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    public function showDropdown()
    {
        if (!empty($this->searchResults)) {
            $this->showDropdown = true;
        }
    }

    public function render()
    {
        return view('livewire.search-dropdown');
    }
}