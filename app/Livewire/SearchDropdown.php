<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';
    public $showDropdown = false;
    public $searchResults = [];
    public $selectedIndex = -1;

    protected $listeners = ['resetSearch'];

    public function updatedSearch()
    {
        $this->selectedIndex = -1;
        
        if (strlen(trim($this->search)) >= 2) {
            $this->performSearch();
            $this->showDropdown = true;
        } else {
            $this->searchResults = [];
            $this->showDropdown = false;
        }
    }

    public function performSearch()
    {
        try {
            // Search for movies
            $movieResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/movie', [
                    'query' => $this->search,
                    'page' => 1
                ])
                ->json('results', []);

            // Search for TV shows
            $tvResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/tv', [
                    'query' => $this->search,
                    'page' => 1
                ])
                ->json('results', []);

            // Search for actors
            $actorResults = Http::withToken(config('services.tmdb.token'))
                ->get('https://api.themoviedb.org/3/search/person', [
                    'query' => $this->search,
                    'page' => 1
                ])
                ->json('results', []);

            // Process and combine results with fuzzy matching
            $this->searchResults = $this->processAndRankResults($movieResults, $tvResults, $actorResults);
            
        } catch (\Exception $e) {
            $this->searchResults = [];
        }
    }

    private function processAndRankResults($movies, $tvShows, $actors)
    {
        $results = [];
        $searchTerm = strtolower(trim($this->search));

        // Process movies
        foreach (array_slice($movies, 0, 5) as $movie) {
            if (!empty($movie['title']) && !empty($movie['poster_path'])) {
                $score = $this->calculateFuzzyScore($searchTerm, strtolower($movie['title']));
                $results[] = [
                    'id' => $movie['id'],
                    'title' => $movie['title'],
                    'subtitle' => isset($movie['release_date']) ? date('Y', strtotime($movie['release_date'])) : 'Movie',
                    'poster_path' => $movie['poster_path'],
                    'type' => 'movie',
                    'route' => 'movies.showMovie',
                    'score' => $score
                ];
            }
        }

        // Process TV shows
        foreach (array_slice($tvShows, 0, 5) as $tv) {
            if (!empty($tv['name']) && !empty($tv['poster_path'])) {
                $score = $this->calculateFuzzyScore($searchTerm, strtolower($tv['name']));
                $results[] = [
                    'id' => $tv['id'],
                    'title' => $tv['name'],
                    'subtitle' => isset($tv['first_air_date']) ? date('Y', strtotime($tv['first_air_date'])) . ' • TV Show' : 'TV Show',
                    'poster_path' => $tv['poster_path'],
                    'type' => 'tv',
                    'route' => 'movies.showTv',
                    'score' => $score
                ];
            }
        }

        // Process actors
        foreach (array_slice($actors, 0, 3) as $actor) {
            if (!empty($actor['name']) && !empty($actor['profile_path'])) {
                $score = $this->calculateFuzzyScore($searchTerm, strtolower($actor['name']));
                $knownFor = isset($actor['known_for']) && !empty($actor['known_for']) 
                    ? $actor['known_for'][0]['title'] ?? $actor['known_for'][0]['name'] ?? 'Actor'
                    : 'Actor';
                
                $results[] = [
                    'id' => $actor['id'],
                    'title' => $actor['name'],
                    'subtitle' => $knownFor,
                    'poster_path' => $actor['profile_path'],
                    'type' => 'person',
                    'route' => 'movies.showActor',
                    'score' => $score
                ];
            }
        }

        // Sort by fuzzy score (higher is better) and return top 8 results
        usort($results, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return array_slice($results, 0, 8);
    }

    private function calculateFuzzyScore($search, $target)
    {
        // Exact match gets highest score
        if ($search === $target) {
            return 100;
        }

        // Starts with search term gets high score
        if (strpos($target, $search) === 0) {
            return 90;
        }

        // Contains search term gets good score
        if (strpos($target, $search) !== false) {
            return 80;
        }

        // Calculate Levenshtein distance for fuzzy matching
        $distance = levenshtein($search, $target);
        $maxLength = max(strlen($search), strlen($target));
        
        if ($maxLength === 0) {
            return 0;
        }

        // Convert distance to similarity percentage
        $similarity = (1 - ($distance / $maxLength)) * 100;

        // Boost score for word boundary matches
        $words = explode(' ', $target);
        foreach ($words as $word) {
            if (strpos($word, $search) === 0) {
                $similarity += 20;
                break;
            }
        }

        return max(0, min(100, $similarity));
    }

    public function selectResult($index)
    {
        if (isset($this->searchResults[$index])) {
            $result = $this->searchResults[$index];
            $this->redirect(route($result['route'], $result['id']));
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->searchResults = [];
        $this->showDropdown = false;
        $this->selectedIndex = -1;
    }

    public function hideDropdown()
    {
        $this->showDropdown = false;
    }

    // Keyboard navigation
    public function keyDown()
    {
        if ($this->selectedIndex < count($this->searchResults) - 1) {
            $this->selectedIndex++;
        }
    }

    public function keyUp()
    {
        if ($this->selectedIndex > 0) {
            $this->selectedIndex--;
        }
    }

    public function keyEnter()
    {
        if ($this->selectedIndex >= 0 && isset($this->searchResults[$this->selectedIndex])) {
            $this->selectResult($this->selectedIndex);
        }
    }

    public function render()
    {
        return view('livewire.search-dropdown');
    }
}