<!DOCTYPE html>
<html>
<head>
    <title>Articles for {{ $theme->name }}</title>
    <style>
        body{
            background: rgb(137,116,125);
            background: radial-gradient(circle, rgba(137,116,125,1) 20%, rgba(106,90,205,1) 100%);
            color: #B9D9EB;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .article-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .article-card {
            background: #3a4980;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: transform 0.2s;
        }

        .article-card:hover {
            transform: translateY(-5px);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 4px;
        }

        .article-title {
            font-size: 1.2em;
            margin: 10px 0;
            color: #fff;
        }

        .article-meta {
            font-size: 0.9em;
            color: #B9D9EB;
            margin-bottom: 10px;
        }

        .action-button {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .read-button {
            background-color: #4CAF50;
            color: white;
        }

        .edit-button {
            background-color: #2196F3;
            color: white;
            margin-left: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            margin-left: 10px;
        }

        .status-pending {
            background-color: #ffd700;
            color: #000;
        }

        .status-published {
            background-color: #4CAF50;
            color: white;
        }

        .status-rejected {
            background-color: #ff4444;
            color: white;
        }

        .back-link {
            display: inline-block;
            margin: 20px;
            color: #fff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .section-title {
            color: #fff;
            margin-top: 30px;
            border-bottom: 2px solid #CCCCFF;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Articles for {{ $theme->name }}</h1>

        @auth
        <!-- User's Articles Section -->
        <h2 class="section-title">My Articles in this Theme</h2>
        <div class="article-grid">
            @forelse (Auth::user()->articles()->where('theme_id', $theme->id)->get() as $userArticle)
                <div class="article-card">
                    @if ($userArticle->image_url)
                        <img src="{{ asset($userArticle->image_url) }}" alt="{{ $userArticle->title }}" class="article-image">
                    @endif
                    <h3 class="article-title">{{ $userArticle->title }}</h3>
                    <div class="article-meta">
                        Created: {{ $userArticle->created_at->format('M d, Y') }}
                        @if($userArticle->is_published)
                            <span class="status-badge status-published">Published</span>
                        @elseif($userArticle->is_rejected)
                            <span class="status-badge status-rejected">Rejected</span>
                        @else
                            <span class="status-badge status-pending">Pending Review</span>
                        @endif
                    </div>
                    <p>{{ Str::limit($userArticle->content, 100) }}</p>
                    <a href="{{ route('articles.show', $userArticle->id) }}" class="action-button read-button">Read</a>
                    <a href="{{ route('articles.edit', $userArticle->id) }}" class="action-button edit-button">Edit</a>
                </div>
            @empty
                <p>You haven't written any articles for this theme yet.</p>
            @endforelse
        </div>
        @endauth

        <!-- Published Articles Section -->
        <h2 class="section-title">Published Articles</h2>
        <div class="article-grid">
            @forelse ($articles->where('is_published', true) as $article)
                <div class="article-card">
                    @if ($article->image_url)
                        <img src="{{ asset($article->image_url) }}" alt="{{ $article->title }}" class="article-image">
                    @endif
                    <h3 class="article-title">{{ $article->title }}</h3>
                    <div class="article-meta">
                        By: {{ $article->author->name }}
                        <br>
                        Published: {{ $article->created_at->format('M d, Y') }}
                    </div>
                    <p>{{ Str::limit($article->content, 100) }}</p>
                    <a href="{{ route('articles.show', $article->id) }}" class="action-button read-button">Read More</a>
                </div>
            @empty
                <p>No published articles found in this theme.</p>
            @endforelse
        </div>

        <a href="{{ route('themes.index') }}" class="back-link">← Back to Themes</a>
    </div>
</body>
</html>
