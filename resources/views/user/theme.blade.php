<!DOCTYPE html>
<html>
<head>
    <title>Themes</title>
</head>
<body>
    <x-navbar />
    <h1>Themes</h1>
    <div class="themes-container">
        @foreach ($themes as $theme)
            @php
                $isSubscribed = in_array($theme->id, $subscriptions);
            @endphp
            <x-card :theme="$theme" :isSubscribed="$isSubscribed" />
        @endforeach
    </div>
</body>
</html>

<style>
    .themes-container {
        display: flex;
        flex-wrap: wrap;
    }
</style>