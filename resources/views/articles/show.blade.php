<!DOCTYPE html>
<html>
<head>
    <title>{{ $article->title }}</title>
    <style>
        .rating {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
        .stars {
            display: flex;
            gap: 5px;
        }
        .stars input {
            display: none;
        }
        .stars label {
            font-size: 2em;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }
        .stars input:checked ~ label,
        .stars input:hover ~ label,
        .stars label:hover ~ label {
            color: #f5b301;
        }
        .comments {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group textarea {
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
        <h1>{{ $article->title }}</h1>
        <p><strong>Author:</strong> {{ $article->author->name }}</p>
        <p><strong>Theme:</strong> {{ $article->theme->name }}</p>
        @if ($article->image_url)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" style="max-width: 100%; height: auto;">
        @endif
        <p>{{ $article->content }}</p>

        @auth
            @if (Auth::user()->role === 'user')
                <div class="rating">
                    <h2>Rate this article</h2>
                    <form method="POST" action="{{ route('articles.rate', $article->id) }}">
                        @csrf
                        <div class="stars">
                            <input type="radio" id="star5" name="rating" value="5" {{ $userRating == 5 ? 'checked' : '' }} />
                            <label for="star5" title="5 stars">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4" {{ $userRating == 4 ? 'checked' : '' }} />
                            <label for="star4" title="4 stars">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3" {{ $userRating == 3 ? 'checked' : '' }} />
                            <label for="star3" title="3 stars">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2" {{ $userRating == 2 ? 'checked' : '' }} />
                            <label for="star2" title="2 stars">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="1" {{ $userRating == 1 ? 'checked' : '' }} />
                            <label for="star1" title="1 star">&#9733;</label>
                        </div>
                        <button type="submit">Submit Rating</button>
                    </form>
                </div>

                <div class="average-rating">
                    <h2>Your Rating: {{ $userRating ?? 'Not rated yet' }}</h2>
                    <h2>Average Rating: {{ round($article->ratings->avg('rating'), 2) }}</h2>
                </div>

                <div class="comments">
                    <h2>Comments</h2>
                    <ul>
                        @foreach ($article->comments as $comment)
                            <li>
                                <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                            </li>
                        @endforeach
                    </ul>

                    <form method="POST" action="{{ route('comments.add', $article->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Add a comment:</label>
                            <textarea id="comment" name="comment" rows="4" required></textarea>
                        </div>
                        <button type="submit">Submit</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
</body>
</html>