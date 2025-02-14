<?php
/* 
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Issue;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function users()
    {
        $stats = User::where('role', 'user')->count();
        return view('admin.stats.users', compact('stats'));
    }

    public function managers()
    {
        $stats = User::where('role', 'theme_manager')->count();
        return view('admin.stats.managers', compact('stats'));
    }

    public function issues()
    {
        $stats = Issue::count();
        return view('admin.stats.issues', compact('stats'));
    }

    public function themes()
    {
        $stats = Theme::count();
        return view('admin.stats.themes', compact('stats'));
    }

    public function articles()
    {
        $stats = Article::count();
        return view('admin.stats.articles', compact('stats'));
    } 
}*/

?>