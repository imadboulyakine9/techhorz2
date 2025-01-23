<nav class="navbar">
    <div class="logo">
        <a href="{{ url('/') }}">MyApp</a>
    </div>
    <div class="nav-links">
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            @if (Auth::user()->role === 'user')
                <a href="{{ route('history.index') }}">History</a>
                <a href="{{ route('themes.index') }}">Themes</a>
                <a href="{{ route('studio') }}">Studio</a>
            @elseif (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.users') }}">Users</a>
            @endif
            <a href="{{ route('profile.edit') }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                    Logout
                </a>
            </form>
        @endguest
    </div>
</nav>

<style>
    .navbar {
        background-color: #333;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .navbar .logo a {
        font-family: 'Times New Roman', Times, serif;
        font-size: 24px;
        color: #fff;
        text-decoration: none;
    }
    .nav-links a {
        font-family: 'Georgia', serif;
        font-size: 18px;
        color: #fff;
        text-decoration: none;
        margin-left: 20px;
    }
    .nav-links a:hover {
        color: #ddd;
    }
    .nav-links form {
        display: inline;
    }
</style>