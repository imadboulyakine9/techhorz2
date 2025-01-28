<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <x-navbar />
    <div class="container">
        <header class="header">
            <h1>{{ config('app.name', 'Laravel') }}</h1>
            <nav class="nav-links">
                @guest
                    <a href="{{ route('login') }}">Log in</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </a>
                    </form>
                @endguest
            </nav>
        </header>

        @auth
            @if (Auth::user()->role === 'user')
                <div class="issues">
                    <h2>Issues</h2>
                    @foreach ($issues as $issue)
                        <div class="issue">
                            <h3>{{ $issue->title }}</h3>
                            <p>{{ $issue->description }}</p>
                            <h4>Articles:</h4>
                            <ul>
                                @foreach ($issue->articles as $article)
                                    <li>{{ $article->title }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        @endauth

        @auth
            @if (Auth::user()->role === 'admin')
                <div>
                    <h2>Admin Dashboard</h2>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.users') }}">Manage Users</a></li>
                    </ul>
                </div>
            @endif
        @endauth
    </div>
</body>
</html>