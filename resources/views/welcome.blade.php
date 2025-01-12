<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f8fafc;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }
            .header, .footer {
                text-align: center;
                padding: 20px;
                background-color: #fff;
                border-bottom: 1px solid #e5e7eb;
            }
            .header a, .footer a {
                color: #333;
                text-decoration: none;
                margin: 0 10px;
            }
            .main {
                padding: 20px;
                background-color: #fff;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                margin-top: 20px;
            }
            .card {
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 20px;
                text-align: center;
            }
            .card img {
                max-width: 100%;
                border-radius: 8px;
            }
            .card h2 {
                margin-top: 10px;
                font-size: 1.5rem;
                color: #333;
            }
            .card p {
                color: #666;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #333;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
                margin-top: 10px;
            }
            .button:hover {
                background-color: #555;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header class="header">
                <h1>Laravel</h1>
                @if (Route::has('login'))
                    <nav>
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="main">
                <div class="card">
                    <img src="https://laravel.com/assets/img/welcome/docs-light.svg" alt="Laravel documentation screenshot">
                    <h2>Documentation</h2>
                    <p>Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.</p>
                    <a href="https://laravel.com/docs" class="button">Read Documentation</a>
                </div>
                <div class="card">
                    <img src="https://laravel.com/assets/img/welcome/laracasts-light.svg" alt="Laracasts screenshot">
                    <h2>Laracasts</h2>
                    <p>Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.</p>
                    <a href="https://laracasts.com" class="button">Watch Laracasts</a>
                </div>
                <div class="card">
                    <img src="https://laravel.com/assets/img/welcome/news-light.svg" alt="Laravel News screenshot">
                    <h2>Laravel News</h2>
                    <p>Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.</p>
                    <a href="https://laravel-news.com" class="button">Visit Laravel News</a>
                </div>
            </main>

            <footer class="footer">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </body>
</html>
