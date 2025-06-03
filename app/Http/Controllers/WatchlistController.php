<?php

// app/Http/Controllers/WatchlistController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if (!$user) {
        // Optional: Umleiten oder Fehler, falls nicht eingeloggt
        return redirect()->route('login');
    }

    // Annahme: User hat eine Beziehung 'watchlist'
    $watchlist = $user->watchlist ?? collect();

    return view('watchlist.index', compact('watchlist'));
}

}

