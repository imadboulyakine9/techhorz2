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
            <li><a href="{{ route('themes.articles', $theme->id) }}">{{ $theme->name }}</a></li>
        @endforeach
    </ul>
</body>
</html>