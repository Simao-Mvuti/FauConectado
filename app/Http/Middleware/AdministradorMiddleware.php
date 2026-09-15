<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministradorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user()?->eAdministrador(), 403, 'Acesso restrito aos administradores.');

        return $next($request);
    }
}
