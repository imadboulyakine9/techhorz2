<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BrowsingHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BrowsingHistoryController extends Controller
{
    public function getHistory()
    {
        $user = Auth::user();
        $history = BrowsingHistory::where('user_id', $user->id)->with('article')->orderBy('viewed_at', 'desc')->get();

        return view('history.index', compact('history'));
    }
}
