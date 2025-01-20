<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Theme;
use App\Models\BrowsingHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



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

        // Log browsing history
        if (Auth::check()) {
            BrowsingHistory::create([
                'user_id' => Auth::id(),
                'article_id' => $id,
                'viewed_at' => now(),
            ]);
        }

        return view('articles.show', compact('article'));
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
    ]);

    return redirect()->route('articles.index')
        ->with('success', 'Article created successfully');
}

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $article = Article::findOrFail($id);
        $article->update($request->all());

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'Article updated successfully');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article deleted successfully');
    }
}
