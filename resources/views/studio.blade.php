<!DOCTYPE html>
<html>
<head>
    <title>Studio</title>
</head>
<body>
    <h1>Articles</h1>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($articles->isEmpty())
        <p>No articles found.</p>
    @else
        <ul>
            @foreach ($articles as $article)
                <li>{{ $article->title }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Create a new article</h2>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
        <button type="submit">Create Article</button>
    </form>
</body>
</html>