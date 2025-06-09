<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Watchlist;

class WatchlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $watchlist = $user->watchlist ?? collect();

        return view('watchlist.index', compact('watchlist'));
    }

    public function toggle($movieId)
{
    $userId = Auth::id();

    $watchlistItem = Watchlist::where('user_id', $userId)
        ->where('movie_id', $movieId)
        ->first();

    if ($watchlistItem) {
        $watchlistItem->delete();
        return redirect()->back()->with('success', 'Film wurde von der Watchlist entfernt.');
    } else {
        Watchlist::create([
            'user_id' => $userId,
            'movie_id' => $movieId,
        ]);

        return redirect()->back()->with('success', 'Film wurde zur Watchlist hinzugefügt.');
    }
}


    public function destroy($movieId)
    {
        $userId = Auth::id();

        Watchlist::where('user_id', $userId)
            ->where('movie_id', $movieId)
            ->delete();

        return redirect()->route('watchlist.index')->with('success', 'Film wurde entfernt.');
    }
}
