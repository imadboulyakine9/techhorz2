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
use App\Http\Controllers\ThemeManagerController;

/* use App\Http\Controllers\UserController;
use App\Http\Controllers\StatsController; */

use App\Models\User;
use App\Models\Issue;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Subscription;
use App\Models\BrowsingHistory;
use App\Models\Chat;
use App\Models\Rate;



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
    Route::get('/studio' , [ArticleController::class, 'getUserArticles'])->name('studio');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
});

Route::get('/' , function(){
    $themes = \App\Models\Theme::all();
    return view('welcome' , 
    [
        'themes' => $themes ,
        'stats' => [
            'users' => \App\Models\User::where('role', 'user')->count(),
           'managers' => \App\Models\User::where('role', 'manager')->count(),
            'articles' => \App\Models\Article::count(),
            'issues' => \App\Models\Issue::count(),
            'themes' => \App\Models\Theme::count(),

        ]
    ]);
}) -> name('welcome');
/**   --------------------------------Admin routes----------------------------------*/ 
Route::middleware(['auth', CheckRole::class.':admin'])->prefix('admin')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
    //Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');
    //Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');

    Route::get('/dashboard', function () {
        $stats=[
            'users' => \App\Models\User::where('role', 'user')->count(),
            'managers' => \App\Models\User::where('role', 'manager')->count(),
            'issues' => \App\Models\Issue::count(),
            'themes' => \App\Models\Theme::count(),
            'articles' => \App\Models\Article::count(),  
        ];

        return view('admin.dashboard' , ['stats' => $stats]); 
    
    })->name('admin.dashboard');


    Route::get('/users', function () {
        
        $users = \App\Models\User::all();
        return view('admin.users', compact('users')); 
    
    })->name('admin.users');

    // Update namespace for RegisteredUserController
    Route::put('/users/{user}/block', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'blockUser'])
    ->name('admin.users.block');
    Route::put('/users/{user}/unblock', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'unblockUser'])
    ->name('admin.users.unblock');
    Route::put('/users/{user}/role', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'updateUserRole'])
    ->name('admin.users.role');
    Route::get('/users/{user}/edit', function($user) {
        $user = \App\Models\User::findOrFail($user);
        return view('admin.users.edit', compact('user'));
    })->name('admin.users.edit');

    // Issues management
    Route::get('/issues', [IssueController::class, 'index'])->name('admin.issues.index');
/*     Route::put('/users/{user}/block', [UserController::class, 'block'])->name('admin.users.block');
    Route::put('/users/{user}/unblock', [UserController::class, 'unblock'])->name('admin.users.unblock');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('admin.users.role');

    // Issues management
    Route::get('/issues', [IssueController::class, 'index'])->name('admin.issues.index');
    Route::post('/issues', [IssueController::class, 'store'])->name('admin.issues.store');
    Route::put('/issues/{issue}/publish', [IssueController::class, 'publish'])->name('admin.issues.publish');
    Route::put('/issues/{issue}/unpublish', [IssueController::class, 'unpublish'])->name('admin.issues.unpublish');
    Route::put('/issues/{issue}/toggle', [IssueController::class, 'toggle'])->name('admin.issues.toggle');

    // Articles management
    Route::put('/articles/{article}/toggle', [ArticleController::class, 'toggle'])->name('admin.articles.toggle');
    Route::put('/articles/{article}/activate', [ArticleController::class, 'activate'])->name('admin.articles.activate');
    Route::put('/articles/{article}/deactivate', [ArticleController::class, 'deactivate'])->name('admin.articles.deactivate');

    // Statistics
    Route::get('/stats/users', [StatsController::class, 'users'])->name('admin.stats.users');
    Route::get('/stats/managers', [StatsController::class, 'managers'])->name('admin.stats.managers');
    Route::get('/stats/issues', [StatsController::class, 'issues'])->name('admin.stats.issues');
    Route::get('/stats/themes', [StatsController::class, 'themes'])->name('admin.stats.themes');
    Route::get('/stats/articles', [StatsController::class, 'articles'])->name('admin.stats.articles'); */
});

/**   ------------------------------End of Admin routes----------------------------------*/ 
Route::middleware(['auth', CheckRole::class.':manager'])->group(function () {
    Route::get('/manager/dashboard', [ThemeController::class, 'managerDashboard'])->name('manager.dashboard');
    Route::post('/theme-manager/update', [ThemeController::class, 'update'])->name('manager.update');
    Route::post('/manager/articles/{article}/review', [ThemeManagerController::class, 'reviewArticle'])->name('manager.review');
});


//Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
//Route::get('/themes/{theme_id}/articles', [ThemeController::class, 'getArticlesByTheme'])->name('themes.articles');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture');
    Route::delete('/profile/picture', [ProfileController::class, 'removeProfilePicture'])->name('profile.picture.remove');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /*Route::post('/subscribe/{theme_id}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::get('/subscriptions', [SubscriptionController::class, 'getSubscriptions'])->name('subscriptions');
    Route::get('/browsing-history', [BrowsingHistoryController::class, 'getHistory'])->name('browsingHistory.index');
    ;*/
    Route::get('/manager/dashboard', [ThemeManagerController::class, 'dashboard'])
         ->name('manager.dashboard');
    Route::post('/manager/review/{article}', [ThemeManagerController::class, 'reviewArticle'])
         ->name('manager.review');


         Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
            Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
});

require __DIR__.'/auth.php';
