<style>
    .navbar {
        background-color:rgb(13, 13, 30); /* Background color from the palette */
        height: 10vh; /* 10% of the viewport height */
        width: 100%; /* Full width */
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-sizing: border-box; /* Ensure padding is included in the element's total width and height */
    }
    .navbar .logo a {
        font-family: 'Times New Roman', Times, serif;
        font-size: 24px;
        color: #BCBCBC; /* Text color from the palette */
        font-weight: bold;
    }
    .navbar .nav-links {
        display: flex;
        gap: 20px; /* Adjust the gap between links as needed */
        align-items: center;
    }
    .navbar .nav-links form {
        margin: 0;
    }
    .navbar a {
        color: #BCBCBC; /* Link color from the palette */
        text-decoration: none;
    }
    .navbar a:hover {
        color: #FAF6F0; /* Hover color from the palette */
    }
</style>

<nav class="navbar">
    <div class="logo">
        <a href="/">Tech Horz</a>
    </div>
    <div class="nav-links">
        @if (Auth::check() && Auth::user()->role === 'user')
            <a href="{{ route('history.index') }}">History</a>
            <a href="{{ route('themes.index') }}">Themes</a>
            <a href="{{ route('studio') }}">Studio</a>
        @elseif (Auth::check() && Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.users') }}">Users</a>
        @elseif (Auth::check() && Auth::user()->role === 'manager')
            <a href="{{ route('manager.dashboard') }}">Manager Dashboard</a>
        @endif
        @if (Auth::check())
            <a href="{{ route('profile.edit') }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </a>
            </form>
        @else
            <a href="{{ route('issues.index') }}">Issues</a>
            <a href="{{ route('articles.index') }}">Articles</a>
            <a href="{{ route('themes.index') }}">Themes</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endif
    </div>
</nav>