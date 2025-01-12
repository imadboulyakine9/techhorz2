<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('themes.index', compact('themes'));
    }

    public function getArticlesByTheme($theme_id)
    {
        $theme = Theme::findOrFail($theme_id);
        $articles = $theme->articles;
        return view('themes.articles', compact('theme', 'articles'));
    }

    public function subscribe(Request $request, $theme_id)
    {
        $user = Auth::user();

        Subscription::create([
            'user_id' => $user->id,
            'theme_id' => $theme_id,
        ]);

        return redirect()->route('themes.index')->with('status', 'Subscribed to theme successfully');
    }

    public function unsubscribe(Request $request, $theme_id)
    {
        $user = Auth::user();

        $subscription = Subscription::where('user_id', $user->id)->where('theme_id', $theme_id)->first();

        if ($subscription) {
            $subscription->delete();
            return redirect()->route('themes.index')->with('status', 'Unsubscribed from theme successfully');
        }

        return redirect()->route('themes.index')->with('error', 'Subscription not found');
    }
}
