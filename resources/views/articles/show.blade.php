<!DOCTYPE html>
<html>
<head>
    <title>{{ $article->title }}</title>
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