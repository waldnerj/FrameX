<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class SearchDropdown extends Component
{
    public $search = '';
    public $searchResults = [];
    public $showDropdown = false;
    public $isLoading = false;
    public $debugInfo = '';

    public function updatedSearch()
    {
        $this->isLoading = true;
        $this->debugInfo = '';
        
        if (strlen($this->search) >= 2) {
            try {
                // Check if token exists
                $token = config('services.tmdb.token');
                if (!$token) {
                    $this->debugInfo = 'TMDB token not configured';
                    $this->isLoading = false;
                    return;
                }

                // Make API request
                $response = Http::withToken($token)
                    ->get('https://api.themoviedb.org/3/search/multi', [
                        'query' => $this->search,
                        'include_adult' => false, // Changed to false for better results
                        'language' => 'en-US',
                        'page' => 1
                    ]);

                if ($response->successful()) {
                    $results = $response->json('results', []);
                    $this->debugInfo = 'API returned ' . count($results) . ' results';
                    
                    // Less restrictive filtering - only require media_type
                    $this->searchResults = collect($results)
                        ->filter(function ($result) {
                            return in_array($result['media_type'] ?? '', ['movie', 'tv']);
                        })
                        ->take(6)
                        ->toArray();
                    
                    $this->debugInfo .= ', after filtering: ' . count($this->searchResults);
                    
                    $this->showDropdown = true;
                } else {
                    $this->debugInfo = 'API Error: ' . $response->status() . ' - ' . $response->body();
                    $this->searchResults = [];
                    $this->showDropdown = false;
                }
                
            } catch (\Exception $e) {
                $this->debugInfo = 'Exception: ' . $e->getMessage();
                $this->searchResults = [];
                $this->showDropdown = false;
                Log::error('Search error: ' . $e->getMessage());
            }
        } else {
            $this->searchResults = [];
            $this->showDropdown = false;
            $this->debugInfo = 'Search too short';
        }
        
        $this->isLoading = false;
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