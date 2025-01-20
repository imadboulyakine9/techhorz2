<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
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
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="container">
        <h1>Create Article</h1>
        <form method="POST" action="{{ route('articles.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="theme_id">Theme</label>
                <select id="theme_id" name="theme_id" required>
                    @foreach ($themes as $theme)
                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input id="image_url" type="url" name="image_url" value="{{ old('image_url') }}">
            </div>

            <div class="form-group">
                <button type="submit">Create Article</button>
            </div>
        </form>
    </div>
</body>
</html>