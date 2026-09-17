<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'FauConectado')) · FauConectado</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-paper text-ink antialiased">

    @include('components.navegacao')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('components.rodape')

</body>
</html>