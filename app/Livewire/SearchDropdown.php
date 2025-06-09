<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class SearchDropdown extends Component
{
    public $search = '';
    public $searchResults = [];
    public $showDropdown = false;

    // Add this method to force re-render
    public function updatedSearch()
    {
        if (strlen($this->search) >= 2) {
            $this->performSearch();
        } else {
            $this->clearResults();
        }
    }

    public function performSearch()
    {
        try {
            $response = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/multi', [
                    'query' => $this->search,
                    'include_adult' => false,
                    'language' => 'en-US',
                    'page' => 1
                ]);

            if ($response->successful()) {
                $results = $response->json('results', []);
                
                // Filter and limit results
                $this->searchResults = collect($results)
                    ->filter(function ($result) {
                        return in_array($result['media_type'] ?? '', ['movie', 'tv']);
                    })
                    ->take(6)
                    ->values() // Reset array keys
                    ->toArray();
                
                $this->showDropdown = count($this->searchResults) > 0;
                
                // Force component to re-render
                $this->dispatch('search-updated');
            } else {
                $this->clearResults();
            }
        } catch (\Exception $e) {
            $this->clearResults();
        }
    }

    public function clearResults()
    {
        $this->searchResults = [];
        $this->showDropdown = false;
        $this->dispatch('search-cleared');
    }

    public function selectResult($id, $mediaType)
    {
        $this->clearResults();
        $this->search = '';
        
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

    public function showDropdownIfResults()
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