<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;

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
}
