<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Themes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 20px;
            background:linear-gradient(to bottom, #1a1f71 , #E1EBEE  , #5D8AA8 , #004170);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
        }
        .card h2 {
            font-size: 1.5em;
            color: #000000; /* Black from the palette */
        }
        .card p {
            color: #666;
        }
        /* .subscribe-button {
            padding: 10px 15px;
            background-color: #000000; /* Black from the palette */
            /*color: #F4DFC8; /* Text color from the palette */
            /*border: none;
            cursor: pointer;
            border-radius: 4px;
        } */
        .subscribe-button {
            padding: 10px 15px;
            color: #F0F8FF; 
            font-weight:bold;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .subscribe-button.subscribed {
            background-color: #dc3545; /* Red for unsubscribe */
        }

        .subscribe-button.not-subscribed {
            background-color: #28a745; /* Green for subscribe */
        }

        .subscribe-button:hover.subscribed {
            background-color: #c82333;
        }

        .subscribe-button:hover.not-subscribed {
            background-color: #218838;
        }


        .card-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }
        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .button-link {
            display: block;
            padding: 0;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .button-link a {
            display: inline-block;
            min-width: 30px;
            padding: 12px 24px;
            background-color: #7B68EE;
            color: white;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }

        .button-link:hover a {
            background-color: #CCCCFF;
        }


    </style>
</head>
<body>
    <x-navbar />
    <br>
    <div class="container">
        @foreach ($themes as $theme)
            <div class="card">
                <div class="card-image">
                    @switch($theme->id)
                        @case(1)
                            <img src="{{ asset('images/Development.jpg') }}" alt="Development">
                            @break
                        @case(2)
                            <img src="{{ asset('images/Ai.jpg') }}" alt="AI">
                            @break
                        @case(3)
                            <img src="{{ asset('images/IOT.jpg') }}" alt="IOT">
                            @break
                        @case(4)
                            <img src="{{ asset('images/cyber.webp') }}" alt="Cyber">
                            @break
                        @case(5)
                            <img src="{{ asset('images/virtual_int.png') }}" alt="VR">
                            @break
                        @case(6)
                            <img src="{{ asset('images/cloud.webp') }}" alt="Cloud">
                            @break
                        @case(7)
                            <img src="{{ asset('images/blockchain.avif') }}" alt="Blockchain">
                            @break
                        @default
                            <img src="{{ asset('images/default.jpg') }}" alt="Default">
                    @endswitch
                </div>
                <h2>{{ $theme->name }}</h2>
                <p>{{ $theme->description }}</p>
                <br>

                <button class="button-link">
                <a href="{{ route('themes.articles', $theme->id) }}">View Articles</a>
                </button>

                <br>
                @auth
                @if (Auth::user()->role === 'user')
                    @php
                        $isSubscribed = Auth::user()->subscriptions ? Auth::user()->subscriptions->contains('theme_id', $theme->id) : false;
                    @endphp
                    <form method="POST" action="{{ $isSubscribed ? route('themes.unsubscribe', $theme->id) : route('themes.subscribe', $theme->id) }}">
                        @csrf
                        <button type="submit" class="subscribe-button {{ $isSubscribed ? 'subscribed' : 'not-subscribed' }}">
                            {{ $isSubscribed ? 'Unsubscribe' : 'Subscribe' }}
                        </button>
                    </form>
                @endif
                @endauth
            </div>
        @endforeach
    </div>
</body>
</html>