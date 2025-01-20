</head>
<body>
    <x-navbar />
    <h1>Themes</h1>
    <ul>
        @foreach ($themes as $theme)
            <li>
                <a href="{{ route('themes.articles', $theme->id) }}">{{ $theme->name }}</a>
                <p>{{ $theme->description }}</p>
                
                @auth
                    @if (Auth::user()->role === 'user')
                        @php
                            $isSubscribed = Auth::user()->subscriptions ? Auth::user()->subscriptions->contains('theme_id', $theme->id) : false;
                        @endphp
                        <form method="POST" action="{{ $isSubscribed ? route('themes.unsubscribe', $theme->id) : route('themes.subscribe', $theme->id) }}">
                            @csrf
                            <button type="submit">{{ $isSubscribed ? 'Unsubscribe' : 'Subscribe' }}</button>
                        </form>
                    @endif
                @endauth
            </li>
        @endforeach
    </ul>
</body>
</html>