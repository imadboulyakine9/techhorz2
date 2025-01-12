<div class="card">
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
    }
    .card h2 {
        margin-top: 0;
    }
    .card button {
        padding: 10px 15px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }
    .card button:hover {
        background-color: #0056b3;
    }
</style>