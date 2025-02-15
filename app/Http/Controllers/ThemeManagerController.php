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
        $pendingArticles = Article::whereIn('theme_id', $managedThemes->pluck('id'))
                                 ->where('status', Article::STATUS_PENDING)
                                 ->with(['author', 'theme'])
                                 ->get();
        
        return view('manager.dashboard', compact('pendingArticles', 'managedThemes'));
    }

    public function reviewArticle(Request $request, Article $article)
    {
        $request->validate([
            'action' => 'required|in:approve,reject'
        ]);

        if (!Auth::user()->managedThemes->contains('id', $article->theme_id)) {
            return back()->with('error', 'Unauthorized action');
        }

        if ($request->action === 'approve') {
            $article->update([
                'status' => Article::STATUS_APPROVED,
                'is_published' => true
            ]);
            $message = 'Article approved and published';
        } else {
            $article->update([
                'status' => Article::STATUS_REJECTED,
                'is_published' => false
            ]);
            $message = 'Article rejected';
        }

        return back()->with('success', $message);
    }
}