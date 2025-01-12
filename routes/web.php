<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\BrowsingHistoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RateController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
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
