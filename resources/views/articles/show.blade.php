<!DOCTYPE html>
<html>
<head>
    <title>{{ $article->title }}</title>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>{{ $article->title }}</h1>
        <p><strong>Author:</strong> {{ $article->author->name }}</p>
        <p><strong>Theme:</strong> {{ $article->theme->name }}</p>
        @if ($article->image_url)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" style="max-width: 100%; height: auto;">
        @endif
        <p>{{ $article->content }}</p>
    </div>
</body>
</html>