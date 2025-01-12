<!DOCTYPE html>
<html>
<head>
    <title>Browsing History</title>
</head>
<body>
    <x-navbar />
    <h1>Browsing History</h1>
    <ul>
        @foreach ($history as $entry)
            <li>
                <a href="{{ route('articles.show', $entry->article->id) }}">{{ $entry->article->title }}</a>
                <span>Viewed at: {{ $entry->viewed_at }}</span>
            </li>
        @endforeach
    </ul>
</body>
</html>