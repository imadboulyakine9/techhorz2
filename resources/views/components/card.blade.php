<div class="card">
    @if ($theme->image_url)
        <img src="{{ $theme->image_url }}" alt="{{ $theme->name }}" class="fixed-size-image">
    @endif
    <h2>{{ $theme->name }}</h2>
    <p>{{ $theme->description }}</p>
    <form method="POST" action="{{ $isSubscribed ? route('themes.unsubscribe', $theme->id) : route('themes.subscribe', $theme->id) }}" style="display:inline;">
        @csrf
        <button type="submit">{{ $isSubscribed ? 'Unsubscribe' : 'Subscribe' }}</button>
    </form>
</div>

<style>
    .card {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        background-color: #fff;
    }
    .card img {
        border-radius: 8px;
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .fixed-size-image {
        width: 400px; /* Set the desired width */
        height: 400px; /* Set the desired height */
        object-fit: cover; /* Ensure the image covers the area without distortion */
    }
    .card h2 {
        margin-top: 10px;
        font-size: 1.5em;
        color: #333;
    }
    .card p {
        color: #666;
    }
    .card button {
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
    .card button:hover {
        background-color: #0056b3;
    }
</style>