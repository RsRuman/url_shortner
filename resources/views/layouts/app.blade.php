<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','A default title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<main>
    <div class="grid-container">
        <!-- Content -->
        <div class="content bg-white">
            @yield('content')
        </div>
    </div>
</main>
</body>
</html>
