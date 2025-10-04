<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="shortcut icon" href="{{ asset('storage/fav.png') }}" type="image/x-icon">
    <title>@yield('title', 'B&B')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    {{ $slot }}
</body>

</html>
