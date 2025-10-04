<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'B&B')</title>
    <link rel="shortcut icon" href="{{ asset('storage/fav.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="md:flex flex-row">
    <x-aside/>
    <div class="flex-1 flex flex-col">
        <main class="flex-1 p-6 bg-gray-100">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
