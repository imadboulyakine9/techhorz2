<!DOCTYPE html>
<html>
<head>
    <title>Articles for {{ $theme->name }}</title>
</head>
<body>
    <h1>Articles for {{ $theme->name }}</h1>
    <ul>
    @foreach ($articles as $article)
            <li>
                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('themes.index') }}">Back to Themes</a>
</body>
</html>