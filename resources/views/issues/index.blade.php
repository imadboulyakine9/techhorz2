<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Issues</title>
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
        .issue {
            border-bottom: 1px solid #e5e7eb;
            padding: 20px 0;
        }
        .issue h2 {
            margin: 0 0 10px;
        }
        .issue p {
            margin: 0;
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>Issues</h1>
        @foreach ($issues as $issue)
            <div class="issue">
                <h2>{{ $issue->title }}</h2>
                <p>{{ $issue->description }}</p>
                <h3>Articles:</h3>
                <ul>
                    @foreach ($issue->articles as $article)
                        <li>{{ $article->title }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</body>
</html>