<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .article {
            border-bottom: 1px solid #e5e7eb;
            padding: 20px 0;
        }
        .article h2 {
            margin: 0 0 10px;
        }
        .article p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Articles</h1>
        @foreach ($articles as $article)
            <div class="article">
                <h2>{{ $article->title }}</h2>
                <p>{{ $article->content }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>