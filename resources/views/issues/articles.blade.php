<!DOCTYPE html>
<html>
<head>
    <title>Articles for {{ $issue->title }}</title>
</head>
<body>
    <x-navbar />
    <h1>Articles for {{ $issue->title }}</h1>
    <ul>
        @foreach ($issue->articles as $article)
            <li>
                <a href="{{ route('articles.show', $article->id) }}">
                    @if ($article->image_url)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" style="max-width: 100px; height: auto;">
                    @endif
                    {{ $article->title }}
                </a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('issues.index') }}">Back to Issues</a>
</body>
</html>