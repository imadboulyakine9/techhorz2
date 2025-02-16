<!DOCTYPE html>
<html>
<head>
    <title>Writing Studio</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background-image: url('/images/Studio.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
/*fix the container in one position and make the page scroll*/
        .container {
            color: #fff;
            width: 65%;
            max-width: 1200px;
            height: 50vh; /* Set a fixed height */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #6082B6;
            position: fixed; /* Fix the container */
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow-y: auto;
        }
        /* Add custom scrollbar styling */
        .container::-webkit-scrollbar {
            width: 10px;
        }
        .container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .container::-webkit-scrollbar-thumb {
            background: #004170;
            border-radius: 5px;
        }

        .container::-webkit-scrollbar-thumb:hover {
            background: #003050;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], 
        textarea, 
        select {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        textarea {
            height: 200px;
            resize: vertical;
        }

        .create_btn {
            width: 150px;
            background-color: #004170;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }

        .articles-list {
            margin-top: 30px;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .article-item {
            padding: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #fff;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            margin-left: 10px;
        }

        .status-pending {
            background-color: #FFA500;
        }

        .status-published {
            background-color: #28a745;
        }

        .status-rejected {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Writing Studio</h1>
        
        <!-- Create Article Form -->
        <div class="write-section">
            <h2 style="color: #002147;">Write a New Article</h2>
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="theme_id">Theme:</label>
                    <select id="theme_id" name="theme_id" required>
                        <option value="">Select a theme</option>
                        @foreach($themes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Article Image (optional):</label>
                    <input type="file" id="image" name="image_url" accept="image/*">
                </div>

                <button type="submit" class="create_btn">Submit Article</button>
            </form>
        </div>

        <!-- My Articles Section -->
        <div class="articles-list">
            <h2>My Articles</h2>
            @if ($articles->isEmpty())
                <p>You haven't written any articles yet.</p>
            @else
                @foreach ($articles as $article)
                    <div class="article-item">
                        <h3>{{ $article->title }}
                            @if($article->is_published)
                                <span class="status-badge status-published">Published</span>
                            @elseif($article->status === 'rejected' || $article->is_rejected)
                                <span class="status-badge status-rejected">Rejected</span>
                            @else
                                <span class="status-badge status-pending">Pending Review</span>
                            @endif
                        </h3>
                        <p>Theme: {{ $article->theme->name }}</p>
                        <p>Created: {{ $article->created_at->format('M d, Y') }}</p>
                        <a href="{{ route('articles.edit', $article->id) }}" class="create_btn">Edit Article</a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>