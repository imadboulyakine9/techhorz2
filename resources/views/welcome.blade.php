<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .themes-carousel {
            display: flex;
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 300px;
            margin: 20px 0;
        }
        .theme-slide {
            min-width: 100%;
            transition: transform 0.5s ease-in-out;
            position: relative;
        }
        .theme-slide img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }
        .theme-info {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 8px;
        }
        .theme-title {
            font-size: 1.5em;
            margin-bottom: 5px;
        }
        .theme-description {
            font-size: 1em;
        }
        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }
        .carousel-control.prev {
            left: 10px;
        }
        .carousel-control.next {
            right: 10px;
        }
        .subscribe-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .unsubscribe-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .header{
            color : #fff;
        }
    </style>

</head>
<body>
    <x-navbar />
    <div class="container">
        <header class="header">
            <h1>Themes</h1>
            
        </header>

        @auth
            @if (Auth::user()->role === 'user')
            <style>
            body{
                margin: 0;
                padding: 0;
                min-height: 100vh;
                background-image: url('/images/TechUser.png');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            </style>
                
            @endif
        @endauth

        @auth
            @if (Auth::user()->role === 'admin')
            <style>
            body{
                margin: 0;
                padding: 0;
                min-height: 100vh;
                background-image: url('/images/TechAdmin.png');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
            </style>
            
            @endif
        @endauth
    </div>

    <div class="themes-carousel">
            <button class="carousel-control prev" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-control next" onclick="nextSlide()">&#10095;</button>
            @foreach ($themes as $theme)
                <div class="theme-slide">
                    
                    @switch($theme->id)
                        @case(1)
                        <img src="{{ asset('images/Development.jpg')}}" alt="Development">
                        @break

                        @case(2)
                        <img src="{{ asset('images/Ai.jpg')}}" alt="Ai">
                        @break

                        @case(3)
                        <img src="{{ asset('images/IOT.jpg')}}" alt="IOT">
                        @break

                        @case(4)
                        <img src="{{ asset('images/cyber.webp')}}" alt="Cyber">
                        @break

                        @case(5)
                        <img src="{{ asset('images/virtual_int.png')}}" alt="virtual_int">
                        @break

                        @case(6)
                        <img src="{{ asset('images/cloud.webp')}}" alt="Cloud">
                        @break

                        @case(7)
                        <img src="{{ asset('images/blockchain.avif')}}" alt="blockchain">
                        @break

                        @case(8)
                        <img src="{{ asset('images/news.webp')}}" alt="News">
                        @break

                        @default
                        <img src="{{ asset('images/default.jpg')}}" alt="default">

                    @endswitch
                    <div class="theme-info">
                        <div class="theme-title">{{ $theme->name }}</div>
                        <div class="theme-description">{{ $theme->description }}</div>
                        @auth
                            @if (Auth::user()->role === 'user')
                                @if ($theme->isSubscribed(Auth::user()->id))
                                    <form action="{{ route('themes.unsubscribe', $theme->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="unsubscribe-button">Unsubscribe</button>
                                    </form>
                                @else
                                    <form action="{{ route('themes.subscribe', $theme->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="subscribe-button">Subscribe</button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.theme-slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.transform = `translateX(${100 * (i - index)}%)`;
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        // Auto slide change every 5 seconds
        setInterval(nextSlide, 5000);

        // Initialize the first slide
        showSlide(currentSlide);
    </script>
</body>
</html>