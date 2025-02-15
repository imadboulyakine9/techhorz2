<!-- filepath: /home/imad/Projects/PHP/project1/techhorz2/resources/views/components/articlecard.blade.php -->
<div class="card">
    @if ($article->image_url)
        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="responsive-image">
    @endif
    <h2>{{ $article->title }}</h2>
    <a href="{{ route('articles.show', $article->id) }}" class="btn">See more</a>
</div>

<style>
    .card {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .card img {
        border-radius: 8px;
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .responsive-image {
        max-width: 100%;
        height: auto;
    }
    .card h2 {
        margin-top: 10px;
        font-size: 1.5em;
    }
    .card .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .card .btn:hover {
        background-color: #0056b3;
    }

    body{
        background: rgb(176,196,222);
        background: linear-gradient(90deg, rgba(176,196,222,1) 0%, rgba(84,90,167,1) 35%, rgba(76,81,109,1) 100%);

    }
</style>