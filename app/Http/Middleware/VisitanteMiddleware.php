<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class VisitanteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            $visitor = User::find($request->session()->get('visitor_user_id'));

            if (! $visitor instanceof User) {
                $visitor = User::create([
                    'name' => 'Visitante',
                    'email' => 'visitante-'.Str::uuid().'@fauconectado.local',
                    'password' => Hash::make(Str::random(40)),
                    'role' => 'user',
                ]);

                $request->session()->put('visitor_user_id', $visitor->id);
            }

            Auth::login($visitor);
        }

        return $next($request);
    }
}
