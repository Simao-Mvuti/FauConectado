<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'FauConectado') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-slate-50 dark:bg-zinc-950 text-slate-800 dark:text-zinc-100 antialiased">

    @auth
        @include('components.navegacao')
    @endauth

    <main class="flex-1">
        @yield('content')
    </main>

    @include('components.rodape')

</body>
</html>