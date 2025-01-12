<nav class="navbar">
    <div class="logo">
        <a href="{{ route('dashboard') }}">MyApp</a>
    </div>
    <div class="nav-links">
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
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