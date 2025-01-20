<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browsing History</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .history-entry {
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 0;
            transition: background-color 0.3s;
        }
        .history-entry:hover {
            background-color: #f9f9f9;
        }
        .history-entry h3 {
            margin: 0;
            font-size: 1.2em;
        }
        .history-entry span {
            font-size: 0.9em;
            color: #666;
        }
        .search-bar, .filter-bar {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        .search-bar input, .filter-bar select {
            padding: 10px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        .search-bar input:focus, .filter-bar select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>Browsing History</h1>
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search for articles..." onkeyup="filterHistory()">
        </div>
        <div class="filter-bar">
            <select id="filter" onchange="filterHistory()">
                <option value="">All</option>
                <option value="today">Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
            </select>
        </div>
        <ul id="history-list">
            @foreach ($history as $entry)
                <li class="history-entry">
                    <h3>
                        <a href="{{ route('articles.show', $entry->article->id) }}">{{ $entry->article->title }}</a>
                    </h3>
                    <span>Viewed at: {{ $entry->viewed_at }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        function filterHistory() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const filterValue = document.getElementById('filter').value;
            const historyList = document.getElementById('history-list');
            const entries = historyList.getElementsByClassName('history-entry');

            for (let i = 0; i < entries.length; i++) {
                const title = entries[i].getElementsByTagName('h3')[0].innerText.toLowerCase();
                const viewedAt = new Date(entries[i].getElementsByTagName('span')[0].innerText.replace('Viewed at: ', ''));
                let showEntry = true;

                if (searchInput && !title.includes(searchInput)) {
                    showEntry = false;
                }

                if (filterValue) {
                    const now = new Date();
                    if (filterValue === 'today' && viewedAt.toDateString() !== now.toDateString()) {
                        showEntry = false;
                    } else if (filterValue === 'week') {
                        const weekAgo = new Date();
                        weekAgo.setDate(now.getDate() - 7);
                        if (viewedAt < weekAgo) {
                            showEntry = false;
                        }
                    } else if (filterValue === 'month') {
                        const monthAgo = new Date();
                        monthAgo.setMonth(now.getMonth() - 1);
                        if (viewedAt < monthAgo) {
                            showEntry = false;
                        }
                    }
                }

                entries[i].style.display = showEntry ? '' : 'none';
            }
        }
    </script>
</body>
</html>