<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Rate;
use App\Models\Subscription;
use App\Models\BrowsingHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $userRating = null;
        
        // Log browsing history
        if (Auth::check()) {
            BrowsingHistory::create([
                'user_id' => Auth::id(),
                'article_id' => $id,
                'viewed_at' => now(),
            ]);
            $userRating = Rate::where([
                'article_id'=> $id,
                'user_id'=> Auth::id()
            ])->first();
        $userRating = $userRating ? $userRating->rating : null;
        }

        return view('articles.show', compact('article' , 'userRating'));
    }

    public function create()
    {
        $themes = Theme::all();
        return view('articles.create', compact('themes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'theme_id' => 'required|exists:themes,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for file upload
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = $request->file('image_url') ? $request->file('image_url')->store('images') : null;

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'author_id' => Auth::id(),
            'theme_id' => $request->theme_id,
            'image_url' => $imagePath, // Store the file path
            'is_published' => false,
            'status' => Article::STATUS_PENDING,
        ]);

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
    
    // Check if the user is the author of the article
    if (Auth::id() !== $article->author_id) {
        return redirect()->route('studio')
            ->with('error', 'You are not authorized to edit this article.');
    }

    $themes = Theme::all();
    return view('articles.edit', compact('article', 'themes'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'theme_id' => 'required|exists:themes,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $article = Article::findOrFail($id);
        
        // Check if the user is the author
        if (Auth::id() !== $article->author_id) {
            return redirect()->route('studio')
                ->with('error', 'You are not authorized to edit this article.');
        }
    
        $data = $request->only(['title', 'content', 'theme_id']);
        
        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($article->image_url) {
                Storage::delete($article->image_url);
            }
            $data['image_url'] = $request->file('image_url')->store('images');
        }
    
        // Reset status to pending after update
        $data['status'] = Article::STATUS_PENDING;
        $data['is_published'] = false;
    
        $article->update($data);
    
        return redirect()->route('studio')
            ->with('success', 'Article updated successfully and submitted for review');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully');
    }
    /*public function getArticlesForUser()
    {
        $articles = Article::all();
        return view('foryou', compact('articles'));
    }*/
    public function getUserArticles()
    {
        $userId = Auth::id();
        $articles = Article::where('author_id', $userId)
        ->with('theme')  // Eager load the theme relationship
        ->orderBy('created_at', 'desc')
        ->get();
        $themes = Theme::all();  // Get all themes for the dropdown
        return view('studio', compact('articles', 'themes'));
    }
    public function getRecommendedArticles()
{
    $userId = Auth::id();

    // Fetch articles based on user browsing history
    $browsingHistoryArticles = BrowsingHistory::where('user_id', $userId)
        ->with('article')
        ->get()
        ->pluck('article');

    // Fetch articles based on user subscriptions
    $subscriptionArticles = Subscription::where('user_id', $userId)
        ->with('theme.articles')
        ->get()
        ->pluck('theme.articles')
        ->flatten();

    // Merge and remove duplicates
    $recommendedArticles = $browsingHistoryArticles->merge($subscriptionArticles)->unique('id');

    return view('foryou', compact('recommendedArticles'));
}

public function getThemeArticles($theme_id)
{
    $theme = Theme::findOrFail($theme_id);
    $articles = Article::where('theme_id', $theme_id)
                      ->with(['author'])
                      ->orderBy('created_at', 'desc')
                      ->get();

    return view('themes.articles', compact('theme', 'articles'));
}


}
