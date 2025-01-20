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


//get all themes whit description /themes 
//there is also a link of articles of this theme /themes/{theme_id}/articles
//get all issues then he will have a link to the articles(image) /issues + /issues/{issue_id}/articles
//there is also /articles to get all articles
//there is also /articles/{article_id} to get a specific article

Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
Route::get('/themes/{theme_id}/articles', [ThemeController::class, 'getArticlesByTheme'])->name('themes.articles');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article_id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/{issue_id}/articles', [IssueController::class, 'getArticlesByIssue'])->name('issues.articles');


Route::middleware(['auth', CheckRole::class.':user'])->group(function () {
    Route::get('/', function () {
        $issues = Issue::with('articles')->get();
        return view('welcome', compact('issues'));
    });

    
    Route::post('/themes/{theme_id}/subscribe', [SubscriptionController::class, 'subscribe'])->name('themes.subscribe');
    Route::post('/themes/{theme_id}/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('themes.unsubscribe');
    Route::get('/browsing-history', [BrowsingHistoryController::class, 'getHistory'])->name('history.index');
    Route::post('/articles/{article_id}/comments', [ChatController::class, 'addComment'])->name('comments.add');
    Route::post('/articles/{article_id}/rate', [RateController::class, 'rateArticle'])->name('articles.rate');
    Route::get('/articles/{article_id}/rating', [RateController::class, 'getArticleRating'])->name('articles.rating');
    //Route::post('/themes/{theme_id}/subscribe', [SubscriptionController::class, 'subscribe'])->name('themes.user');
    // he have a personal space "welcome where he can see all the themes and the issues"
    // he can manage his subscriptions one page
    // he can manage his history whit filters /browsing-history and /browsing-history?theme_id=1 "for example"
    // he can post an article /articles/create
    // he can see status of his articles /articles/my-articles
    // he can see his profile /profile //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); one page can edit update and see
    // he can rate an article /articles/{article_id}/rate and comment /articles/{article_id}/comments

;
//Route::get('/themes', [ThemeController::class, 'index'])->name('user.theme');
//Route::get('/browsing-history', [BrowsingHistoryController::class, 'getHistory'])->name('browsingHistory.index');
});

Route::middleware(['auth', CheckRole::class.':admin'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
    Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');
    Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

    Route::get('/admin/dashboard', function () { return view('admin.dashboard'); })->name('admin.dashboard');
    Route::get('/admin/users', function () { return view('admin.users'); })->name('admin.users');
});

Route::middleware(['auth', CheckRole::class.':theme_manager'])->group(function () {
    //Route::get('/theme-manager', [ThemeManagerController::class, 'index'])->name('theme_manager.dashboard');
});


//Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
//Route::get('/themes/{theme_id}/articles', [ThemeController::class, 'getArticlesByTheme'])->name('themes.articles');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    /*Route::post('/subscribe/{theme_id}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::get('/subscriptions', [SubscriptionController::class, 'getSubscriptions'])->name('subscriptions');
    Route::get('/browsing-history', [BrowsingHistoryController::class, 'getHistory'])->name('browsingHistory.index');
    ;*/
});

require __DIR__.'/auth.php';
