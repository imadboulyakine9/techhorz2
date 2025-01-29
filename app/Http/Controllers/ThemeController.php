<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /*
    public function index()
    {
        $themes = Theme::all();
        return view('themes.index', compact('themes'));
    }
    */
    public function index()
    {
        $user = Auth::user();
        $theme = Theme::where('manager_id', $user->id)->first();
        return view('theme_manager.dashboard', compact('theme'));
    }

    public function update(Request $request)
    {
        $theme = Theme::first(); // Assuming there's only one theme

        $theme->update($request->all());

        return redirect()->route('theme_manager.dashboard')->with('status', 'Theme updated successfully');
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

        return redirect()->route('themes.user')->with('status', 'Subscribed to theme successfully');
    }

    public function unsubscribe(Request $request, $theme_id)
    {
        $user = Auth::user();

        $subscription = Subscription::where('user_id', $user->id)->where('theme_id', $theme_id)->first();

        if ($subscription) {
            $subscription->delete();
            return redirect()->route('themes.user')->with('status', 'Unsubscribed from theme successfully');
        }

        return redirect()->route('themes.user')->with('error', 'Subscription not found');
    }
}
