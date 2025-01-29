<!DOCTYPE html>
<html>
<head>
    <title>Articles for {{ $theme->name }}</title>
    <style>
        body{
                background-color:#2c3968;
                color:#B9D9EB;
        }

        .articles{
            margin-right:50px;
        }
        a{
            color:#fff;
        }
    </style>
</head>
<body>
    <h1>Articles for {{ $theme->name }}</h1>

    <div class="articles">
    <ul>
    @foreach ($articles as $article)
            <li>
                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
            </li>
        @endforeach
    </ul>
    </div>
    
    <h4 style="margin-left:20px;">
        <a href="{{ route('themes.index') }}">Back to Themes</a>
    </h4>
    
</body>
</html>