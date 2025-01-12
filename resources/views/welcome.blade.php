<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
        }
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .nav-links a:hover {
            background-color: #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>{{ config('app.name', 'Laravel') }}</h1>
            <nav class="nav-links">
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Register</a>
            </nav>
        </header>
    </div>
</body>
</html>