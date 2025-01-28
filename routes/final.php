<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\BrowsingHistoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\IssueController;
use App\Models\Issue;

use App\Http\Middleware\CheckRole;

// Public routes
Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
Route::get('/themes/{theme_id}/articles', [ThemeController::class, 'getArticlesByTheme'])->name('themes.articles');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article_id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/{issue_id}/articles', [IssueController::class, 'getArticlesByIssue'])->name('issues.articles');

// Routes for authenticated users with 'user' role
Route::middleware(['auth', CheckRole::class.':user'])->group(function () {
    Route::get('/', function () {
        $issues = Issue::with('articles')->get();
        return view('welcome', compact('issues'));
    });

    Route::get('/foryou', [ArticleController::class, 'getRecommendedArticles'])->name('foryou');
    Route::post('/themes/{theme_id}/subscribe', [SubscriptionController::class, 'subscribe'])->name('themes.subscribe');
    Route::post('/themes/{theme_id}/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('themes.unsubscribe');
    Route::get('/browsing-history', [BrowsingHistoryController::class, 'getHistory'])->name('history.index');
    Route::post('/articles/{article_id}/comments', [ChatController::class, 'addComment'])->name('comments.add');
    Route::post('/articles/{article_id}/rate', [RateController::class, 'rateArticle'])->name('articles.rate');
    Route::get('/articles/{article_id}/rating', [RateController::class, 'getArticleRating'])->name('articles.rating');
    Route::get('/studio', [ArticleController::class, 'getUserArticles'])->name('studio');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
});

// Routes for authenticated users with 'admin' role
Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
    Route::get('/admin/users', function () { return view('admin.users'); })->name('admin.users');
});

// Routes for authenticated users with 'theme_manager' role
Route::middleware(['auth', CheckRole::class.':theme_manager'])->group(function () {
    // Add routes for theme manager here
});

// Routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Add other authenticated routes here
});

require __DIR__.'/auth.php';