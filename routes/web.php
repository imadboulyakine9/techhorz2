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

Route::middleware(['auth', CheckRole::class.':user'])->group(function () {
    Route::get('/', function () {
        $issues = Issue::with('articles')->get();
        return view('welcome', compact('issues'));
    });
;
Route::get('/subscriptions', [SubscriptionController::class, 'getSubscriptions'])->name('subscriptions');
Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
Route::post('/themes/subscribe/{theme_id}', [ThemeController::class, 'subscribe'])->name('themes.subscribe');
Route::post('/themes/unsubscribe/{theme_id}', [ThemeController::class, 'unsubscribe'])->name('themes.unsubscribe');
});

Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
    Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');
    Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

    Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
    Route::get('/admin/users', function () { return view('admin.users'); })->name('admin.users');

});

Route::middleware(['auth', CheckRole::class.':theme_manager'])->group(function () {
    //Route::get('/theme-manager', [ThemeManagerController::class, 'index'])->name('theme_manager.dashboard');
});


Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/themes/{theme_id}/articles', [ThemeController::class, 'getArticlesByTheme'])->name('themes.articles');

Route::middleware('auth')->group(function () {
    Route::post('/subscribe/{theme_id}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::get('/subscriptions', [SubscriptionController::class, 'getSubscriptions'])->name('subscriptions');
    Route::get('/browsing-history', [BrowsingHistoryController::class, 'getHistory'])->name('browsingHistory.index');
    Route::post('/articles/{article_id}/comments', [ChatController::class, 'addComment'])->name('comments.add');
    Route::get('/articles/{article_id}/comments', [ChatController::class, 'getComments'])->name('comments.index');
    Route::post('/articles/{article_id}/rate', [RateController::class, 'rateArticle'])->name('articles.rate');
    Route::get('/articles/{article_id}/rating', [RateController::class, 'getArticleRating'])->name('articles.rating');
});

require __DIR__.'/auth.php';
