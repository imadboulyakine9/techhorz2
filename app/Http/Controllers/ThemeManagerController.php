<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeManagerController extends Controller
{
    public function dashboard()
    {
        $managedThemes = Auth::user()->managedThemes;

        if ($managedThemes->isEmpty()) {
            return redirect()->back()->with('error', 'No themes assigned to you.');
        }
        $pendingArticles = Article::whereIn('theme_id', $managedThemes->pluck('id'))
                                 ->where('status', Article::STATUS_PENDING)
                                 ->with(['author', 'theme'])
                                 ->get();
        
        return view('theme_manager.dashboard', [
                          'managedThemes' => $managedThemes,
                          'pendingArticles' => $pendingArticles
                                ]);
    }

    public function reviewArticle(Request $request, Article $article)
{
    if (!Auth::user()->managedThemes->contains('id', $article->theme_id)) {
        return back()->with('error', 'Unauthorized action');
    }

    $action = $request->input('action');
    
    if ($action === 'approve') {
        $article->update([
            'status' => 'approved',
            'is_published' => true
        ]);
        $message = 'Article approved and published successfully';
    } else {
        $article->update([
            'status' => 'rejected',
            'is_published' => false
        ]);
        $message = 'Article rejected successfully';
    }

    return back()->with('success', $message);
}
}