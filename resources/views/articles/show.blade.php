<!DOCTYPE html>
<html>
<head>
    <title>{{ $article->title }}</title>
    <style>
        body {
            background: rgb(224,255,255);
            background: linear-gradient(326deg, rgba(224,255,255,1) 2%, rgba(173,216,230,1) 11%, rgba(93,138,168,1) 52%, rgba(0,49,83,1) 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .main-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            box-sizing:border-box;
        }

        .article-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .article-title {
            font-size: 2.5em;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 3fr;
            gap: 30px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow:hidden;
        }

        .sidebar {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .article-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .article-meta {
            font-size: 1.1em;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .content {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
            box-sizing: border-box;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
        }

        .rating {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
        }

        .stars {
            display: flex;
            flex-direction: row-reverse;
            gap: 8px;
            justify-content: center;
            margin: 15px 0;
        }

        .stars input[type="radio"] {
            display: none;
        }
        .stars label {
            font-size: 2.5em;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .stars label:hover,
        .stars label:hover ~ label,
        .stars input[type="radio"]:checked ~ label {
            color: #ffd700;
        }

        .average-rating {
            text-align: center;
            font-size: 1.2em;
            color: #2c3e50;
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .comments {
            margin-top: 40px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            box-sizing: border-box;
            max-width:100%;
            overflow:hidden;
        }

        .comments ul {
            list-style: none;
            padding: 0;
            width:100%;
            max-width: 100%;
            overflow: hidden;
        }

        .comments li {
            padding: 15px;
            margin-bottom: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            word-wrap: break-word;
            overflow-wrap: break-word;
            width: 100%;
            box-sizing: border-box;
            white-space: pre-wrap;
            width:100%;
            max-width: 100%;
            overflow: hidden;
        }
        .comments li p {
            white-space: pre-wrap; /* Change from pre-line to pre-wrap */
            margin: 10px 0;
            line-height: 1.6;
            overflow-wrap: break-word;
            word-wrap: break-word;
            max-width: 100%;
        }

        .comment-form {
            margin-top: 20px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            max-width:100%;
        }

        .form-group {
            margin-bottom: 20px;
            width:100%;
            box-sizing: border-box;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: bold;
        }

        .form-group textarea {
            width: 100%;
            max-width: 100%;
            min-width: 100%;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
            resize: vertical;
            min-height: 100px;
            overflow-x: hidden;
            white-space: pre-wrap;
            word-wrap: break-word;
            overflow-wrap:break-word;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        section {
            margin-bottom: 40px;
        }

        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <x-navbar />
    <div class="main-container">
        <div class="article-header">
            <h1 class="article-title">{{ $article->title }}</h1>
        </div>

        <div class="container">
            <div class="sidebar">
                <section class="article-meta">
                    <h2>Article Info</h2>
                    <p><strong>Author:</strong> {{ $article->author->name }}</p>
                    <p><strong>Theme:</strong> {{ $article->theme->name }}</p>
                    @if ($article->image_url)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-image">
                    @endif
                </section>

                @auth
                    @if (Auth::user()->role === 'user')
                        <section class="rating">
                            <h2>Rate Article</h2>
                            <form method="POST" action="{{ route('articles.rate', $article->id) }}">
                                @csrf
                                <div class="stars">
                                    <input type="radio" id="star5" name="rating" value="5" {{ $userRating == 5 ? 'checked' : '' }} />
                                    <label for="star5">★</label>
                                    <input type="radio" id="star4" name="rating" value="4" {{ $userRating == 4 ? 'checked' : '' }} />
                                    <label for="star4">★</label>
                                    <input type="radio" id="star3" name="rating" value="3" {{ $userRating == 3 ? 'checked' : '' }} />
                                    <label for="star3">★</label>
                                    <input type="radio" id="star2" name="rating" value="2" {{ $userRating == 2 ? 'checked' : '' }} />
                                    <label for="star2">★</label>
                                    <input type="radio" id="star1" name="rating" value="1" {{ $userRating == 1 ? 'checked' : '' }} />
                                    <label for="star1">★</label>
                                </div>
                                <button type="submit">Submit Rating</button>
                            </form>
                        </section>

                        <section class="average-rating">
                            <h2>Article Rating</h2>
                            <p>{{ $article->ratings->avg('rating') ? number_format($article->ratings->avg('rating'), 1) : 'No ratings yet' }} / 5.0</p>
                        </section>
                    @endif
                @endauth
            </div>

            <div class="content">
                <section class="article-content">
                    <h2>Article Content</h2>
                    <p>{{ $article->content }}</p>
                </section>

                @auth
                    @if (Auth::user()->role === 'user')
                        <section class="comments">
                            <h2>Comments</h2>
                            <ul>
                                @foreach ($article->comments as $comment)
                                    <li>
                                        <strong>{{ $comment->user->name }}</strong>
                                        <p>{{ $comment->comment }}</p>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="comment-form">
                                <form method="POST" action="{{ route('comments.add', $article->id) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Add a comment:</label>
                                        <textarea id="comment" name="comment" rows="4" required></textarea>
                                    </div>
                                    <button type="submit">Submit Comment</button>
                                </form>
                            </div>
                        </section>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</body>
</html>