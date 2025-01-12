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
                {{-- <a href="{{ route('themes.user') }}">Themes</a> --}}
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
        align-items: center;
    }
    .navbar .logo a {
        color: #fff;
        text-decoration: none;
        font-size: 24px;
    }
    .navbar .nav-links {
        margin-left: auto;
        display: flex;
        gap: 20px;
    }
    .navbar .nav-links a {
        color: #fff;
        text-decoration: none;
    }
    .navbar .nav-links a:hover {
        text-decoration: underline;
    }
</style>