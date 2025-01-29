<!-- filepath: /home/imad/Projects/PHP/project1/techhorz2/resources/views/theme_manager/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Manager Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 20px;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .container {
            margin-left: 270px;
            padding: 20px;
        }
        .card {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card h2 {
            margin-top: 0;
        }
        .card table {
            width: 100%;
            border-collapse: collapse;
        }
        .card table, .card th, .card td {
            border: 1px solid #ddd;
        }
        .card th, .card td {
            padding: 8px;
            text-align: left;
        }
        .card th {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <a href="#">Theme Manager Dashboard</a>
        </div>
        <div class="nav-links">
            <a href="{{ route('profile.edit') }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
            </form>
        </div>
    </div>
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="#">Dashboard</a>
        <a href="#">Manage Theme</a>
        <a href="#">Articles</a>
        <a href="#">Statistics</a>
    </div>
    <div class="container">
        <div class="card">
            <h2>Theme Details</h2>
            <form method="POST" action="{{ route('theme_manager.update') }}">
                @csrf
                <div class="form-group">
                    <label for="theme-name">Theme Name</label>
                    <input type="text" id="theme-name" name="name" value="{{ $theme->name }}">
                </div>
                <div class="form-group">
                    <label for="theme-description">Theme Description</label>
                    <textarea id="theme-description" name="description">{{ $theme->description }}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Update Theme</button>
                </div>
            </form>
        </div>
        <div class="card">
            <h2>Articles</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($theme->articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author }}</td>
                            <td>{{ $article->status }}</td>
                            <td>
                                <a href="#">Edit</a>
                                <a href="#">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card">
            <h2>Statistics</h2>
            <p>Number of Articles: {{ $theme->articles->count() }}</p>
            <p>Number of Subscribers: {{ $theme->subscriptions->count() }}</p>
        </div>
    </div>
</body>
</html>