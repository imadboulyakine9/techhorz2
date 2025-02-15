<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
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

        .container {
            color: #fff;
            width: 65%;
            max-width: 1200px;
            height: 50vh;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #6082B6;
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow-y: auto;
        }
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

        .btn {
            width: 150px;
            background-color: #004170;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            margin: 5px;
        }

        .btn:hover {
            background-color: #003050;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Article</h1>
        
        <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" required>
            </div>

            <div class="form-group">
                <label for="theme_id">Theme:</label>
                <select id="theme_id" name="theme_id" required>
                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}" {{ $article->theme_id == $theme->id ? 'selected' : '' }}>
                            {{ $theme->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" required>{{ old('content', $article->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Article Image:</label>
                @if($article->image_url)
                    <p>Current image: {{ basename($article->image_url) }}</p>
                @endif
                <input type="file" id="image" name="image_url" accept="image/*">
            </div>

            <button type="submit" class="btn">Update Article</button>
            <a href="{{ route('studio') }}" class="btn">Back to Studio</a>
        </form>
    </div>
</body>
</html>