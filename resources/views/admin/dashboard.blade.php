
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>Admin Dashboard</h1>
        
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p>{{ $stats['users'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Theme Managers</h3>
                <p>{{ $stats['managers'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Issues</h3>
                <p>{{ $stats['issues'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Themes</h3>
                <p>{{ $stats['themes'] }}</p>
            </div>
            <div class="stat-card">
                <h3>Articles</h3>
                <p>{{ $stats['articles'] }}</p>
            </div>
        </div>
    </div>
</body>
</html>