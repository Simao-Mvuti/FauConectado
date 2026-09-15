<?php

namespace App\Http\Controllers;

use App\Models\Conteudo;
use App\Models\Materias;
use App\Models\Eventos;

class DashboardController extends Controller
{
  public function index()
{
    $user = auth()->user();
    $conteudos = Conteudo::all();
    $materias = Materias::all();
    $eventos = Eventos::all();

    return view('dashboard', [
        'user' => $user,
        'conteudos'=>$conteudos,
        'materias'=>$materias,
        'eventos'=>$eventos
    ]);
}
}
