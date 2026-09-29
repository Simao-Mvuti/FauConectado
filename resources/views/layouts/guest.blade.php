<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>FauConectado | Acesso académico</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-[#f9faf7]">
        <div class="min-h-screen flex items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
            <div class="w-full max-w-5xl overflow-hidden rounded-[28px] bg-white shadow-[0_30px_80px_rgba(23,49,35,0.15)]">
                <div class="grid min-h-[680px] lg:grid-cols-[1.1fr_0.9fr]">
                    <section class="hidden flex-col justify-between bg-[#173123] p-10 text-white lg:flex">
                        <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-3 self-start">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-sm font-bold">FC</span>
                            <span class="text-lg font-bold tracking-wide">FauConectado</span>
                        </a>

                        <div class="space-y-6">
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] text-white/80">
                                <span class="h-2 w-2 rounded-full bg-green-400"></span>
                                Comunidade Académica
                            </span>

                            <h1 class="max-w-sm font-serif text-4xl leading-tight">
                                A comunidade que cresce com cada material partilhado.
                            </h1>

                            <p class="max-w-md text-base text-white/80">
                                Aprende com colegas, encontra tutores e mantém a rede de apoio académico sempre ativa.
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-white/80">
                            <p class="font-medium text-white">“Aprender melhor não precisa de ser solitário.”</p>
                        </div>
                    </section>

                    <section class="flex items-center justify-center bg-[#f9faf7] p-6 sm:p-10">
                        <div class="w-full max-w-md">
                            <a href="{{ route('home') }}" wire:navigate class="mb-6 inline-flex items-center gap-3 text-[#173123] lg:hidden">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#173123] text-sm font-bold text-white">FC</span>
                                <span class="text-lg font-bold tracking-wide">FauConectado</span>
                            </a>

                            <div class="auth-card rounded-[24px] border border-[#dfe7e0] bg-white p-6 shadow-sm sm:p-8">
                                @php
                                    $authCopy = match (request()->route()?->getName()) {
                                        'login' => ['Entra na tua conta', 'Acede à tua comunidade académica e continua de onde ficaste.'],
                                        'register' => ['Cria a tua conta', 'Junta-te à comunidade e partilha conhecimento com outros estudantes.'],
                                        'password.request' => ['Recuperar palavra-passe', 'Indica o teu e-mail para receberes um link de recuperação.'],
                                        'password.reset' => ['Define uma nova palavra-passe', 'Escolhe uma palavra-passe segura para proteger a tua conta.'],
                                        'verification.notice' => ['Verifica o teu e-mail', 'Confirma o teu endereço para terminares a configuração da conta.'],
                                        'password.confirm' => ['Confirma a tua identidade', 'Por segurança, confirma a palavra-passe antes de continuar.'],
                                        default => ['Bem-vindo ao FauConectado', 'A tua comunidade de apoio académico.'],
                                    };
                                @endphp

                                <h2 class="mb-2 font-serif text-2xl font-bold text-[#173123]">{{ $authCopy[0] }}</h2>
                                <p class="mb-6 text-sm leading-relaxed text-gray-600">{{ $authCopy[1] }}</p>

                                {{ $slot }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <style>
            .auth-card label {
                color: #173123;
                font-size: 0.875rem;
                font-weight: 600;
            }

            .auth-card input:not([type="checkbox"]) {
                width: 100%;
                border: 1px solid #dfe7e0;
                border-radius: 0.875rem;
                background: #f9faf7;
                padding: 0.75rem 0.875rem;
                color: #173123;
                box-shadow: none;
            }

            .auth-card input:not([type="checkbox"]):focus {
                border-color: #173123;
                outline: 2px solid transparent;
                box-shadow: 0 0 0 3px rgb(23 49 35 / 12%);
            }

            .auth-card input[type="checkbox"] {
                accent-color: #173123;
            }

            .auth-card button[type="submit"] {
                min-height: 2.75rem;
                border-radius: 9999px;
                background: #173123;
                padding: 0.7rem 1.25rem;
                color: white;
                font-weight: 700;
                transition: background-color 150ms ease;
            }

            .auth-card button[type="submit"]:hover {
                background: #12281d;
            }

            .auth-card a {
                color: #173123;
            }
        </style>
    </body>
</html>
