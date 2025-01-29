<!DOCTYPE html>
<html>
<head>
    <title>Studio</title>

    <style>
        body{
                margin: 0;
                padding: 0;
                min-height: 100vh;
                background-image: url('/images/Studio.png');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }

            .container{
                color :#fff;
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                padding-top:10px;
                border: 1px solid #ccc;
                border-radius: 8px;
                background-color: #6082B6;
                margin-top: 200px;
                position: relative;
                top:117px;
            }

            form{
                display:grid;
                font-size: 16px;
                font-weight: bold;
            }

            .create_btn{
                width:100px;
                background-color: #004170;
                color:#fff;
                font-weight:bold;
                border:none;
                border-radius: 5px;
                padding: 10px;
                cursor: pointer;
            }
    </style>
</head>
<body>
    <div class="container">
    <h1>Articles</h1>
    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if ($articles->isEmpty())
        <p>No articles found.</p>
    @else
        <ul>
            @foreach ($articles as $article)
                <li>{{ $article->title }}</li>
            @endforeach
        </ul>
    @endif

    <h2 style=" color: #002147; ">Create a new article</h2>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
        <button type="submit" class="create_btn">Create Article</button>
    </form>
</div>
</body>
</html>