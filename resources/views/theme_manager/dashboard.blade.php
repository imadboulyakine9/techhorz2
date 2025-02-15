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
        .pending-articles {
            margin-top: 20px;
        }

        .article-actions {
            display: flex;
            gap: 10px;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .status-badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }

        .status-pending {
            background-color: #ffc107;
            color: #000;
        }

        .status-approved {
            background-color: #28a745;
            color: white;
        }

        .status-rejected {
            background-color: #dc3545;
            color: white;
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
        <a href="#pending">Pending Articles</a>
        <a href="#theme">Manage Theme</a>
        <a href="#articles">All Articles</a>
        <a href="#statistics">Statistics</a>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Pending Articles Section -->
        <div class="card" id="pending">
            <h2>Pending Articles</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Theme</th>
                        <th>Submitted Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendingArticles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->author->name }}</td>
                            <td>{{ $article->theme->name }}</td>
                            <td>{{ $article->created_at->format('M d, Y') }}</td>
                            <td class="article-actions">
                                <form action="{{ route('manager.review', $article->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="action" value="approve">
                                    <button type="submit" class="btn-approve">Approve</button>
                                </form>
                                <form action="{{ route('manager.review', $article->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="btn-reject">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No pending articles to review.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Theme Management Section -->
        @foreach($managedThemes as $theme)
            <div class="card" id="theme">
                <h2>Theme Details: {{ $theme->name }}</h2>
                <form method="POST" action="{{ route('manager.update') }}">
                    @csrf
                    <input type="hidden" name="theme_id" value="{{ $theme->id }}">
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

            <!-- All Articles Section -->
            <div class="card" id="articles">
                <h2>All Articles</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($theme->articles as $article)
                            <tr>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->author->name }}</td>
                                <td>
                                    <span class="status-badge status-{{ $article->status }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                <td>{{ $article->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No articles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Statistics Section -->
            <div class="card" id="statistics">
                <h2>Theme Statistics</h2>
                <p>Total Articles: {{ $theme->articles->count() }}</p>
                <p>Pending Articles: {{ $theme->articles->where('status', 'pending')->count() }}</p>
                <p>Published Articles: {{ $theme->articles->where('status', 'approved')->count() }}</p>
                <p>Rejected Articles: {{ $theme->articles->where('status', 'rejected')->count() }}</p>
                <p>Number of Subscribers: {{ $theme->subscriptions->count() }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>