<nav class="navbar">
    <style>
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 20px;
        }
        .navbar .logo {
            display: flex;
            align-items: center;
        }
        .navbar .logo a {
            text-decoration: none;
            color: #333;
        }
        .navbar .nav-links {
            display: flex;
            gap: 20px;
            margin-left: auto;
        }
        .navbar .nav-links a {
            text-decoration: none;
            color: #333;
        }
        .navbar .nav-links a:hover {
            color: #555;
        }
        .navbar .dropdown {
            position: relative;
        }
        .navbar .dropdown button {
            background: none;
            border: none;
            cursor: pointer;
            color: #333;
        }
        .navbar .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        .navbar .dropdown-content a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
        }
        .navbar .dropdown-content a:hover {
            background-color: #f8fafc;
        }
        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    <div class="logo">
        <a href="{{ route('dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </a>
    </div>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            {{ __('Dashboard') }}
        </a>
        <div class="dropdown">
            <button>
                {{ Auth::user()->name }}
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
