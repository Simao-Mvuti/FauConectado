<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'FauConectado' }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS Compilado via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-fcBgLight text-fcTextDark font-sans min-h-screen flex flex-col justify-between antialiased">

    <x-top-banner />
    <x-navbar />

    <main class="flex-grow py-6 sm:py-8">
        {{ $slot }}
    </main>

    <footer class="py-4 text-center text-xs text-fcTextMuted border-t border-gray-200/60 mt-8">
        &copy; {{ date('Y') }} FauConectado. Plataforma colaborativa mantida pela comunidade.
    </footer>

</body>
</html>