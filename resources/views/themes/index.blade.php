<!DOCTYPE html>
<html>
<head>
    <title>Themes</title>
</head>
<body>
    <x-navbar />
    <h1>Themes</h1>
    <ul>
        @foreach ($themes as $theme)
            <li>
                <a href="{{ route('themes.articles', $theme->id) }}">{{ $theme->name }}</a>
                <form method="POST" action="{{ route('themes.subscribe', $theme->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit">Subscribe</button>
                </form>
                <form method="POST" action="{{ route('themes.unsubscribe', $theme->id) }}" style="display:inline;">
                    @csrf
                    <button type="submit">Unsubscribe</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>