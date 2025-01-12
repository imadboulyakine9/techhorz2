<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Article;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function create()
    {
        $articles = Article::all();
        return view('issues.create', compact('articles'));
    }

    
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'articles' => 'required|array',
        'articles.*' => 'exists:articles,id',
    ]);

    $issue = Issue::create([
        'title' => $request->title,
        'description' => $request->description,
        'published_at' => now(),
    ]);

    // Update the articles to associate them with the created issue
    Article::whereIn('id', $request->articles)->update(['issue_id' => $issue->id]);

    return redirect()->route('issues.index')->with('success', 'Issue created successfully.');
}

    public function index()
    {
        $issues = Issue::with('articles')->get();
        return view('issues.index', compact('issues'));
    }
}