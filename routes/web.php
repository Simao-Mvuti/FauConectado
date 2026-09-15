<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\TutoriaController;
use App\Http\Controllers\AdministradorController;
use Illuminate\Support\Facades\Route;

// Rotas para visitantes (Usuários Não Autenticados)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'login'])->name('login.post');

    // Registro
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Recuperação de Senha
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Rotas Protegidas (Usuários Autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/conteudos/criar', [ConteudoController::class, 'criar'])->name('conteudos.criar');
    Route::post('/conteudos', [ConteudoController::class, 'armazenar'])->name('conteudos.armazenar');
    Route::get('/materiais/criar', [MaterialController::class, 'criar'])->name('materiais.criar');
    Route::post('/materiais', [MaterialController::class, 'armazenar'])->name('materiais.armazenar');
    Route::get('/materiais/{materia}/baixar', [MaterialController::class, 'baixar'])->name('materiais.baixar');
    Route::post('/materiais/{materia}/avaliar', [MaterialController::class, 'avaliar'])->name('materiais.avaliar');
    Route::get('/eventos/criar', [EventoController::class, 'criar'])->name('eventos.criar');
    Route::post('/eventos', [EventoController::class, 'armazenar'])->name('eventos.armazenar');
    Route::get('/tutores/solicitar', [TutoriaController::class, 'solicitar'])->name('tutores.solicitar');
    Route::post('/tutores/solicitacoes', [TutoriaController::class, 'armazenarSolicitacao'])->name('tutores.solicitacoes.armazenar');
    Route::get('/tutores/candidatar', [TutoriaController::class, 'candidatar'])->name('tutores.candidatar');
    Route::post('/tutores/candidaturas', [TutoriaController::class, 'armazenarCandidatura'])->name('tutores.candidaturas.armazenar');
    Route::get('/tutores/avaliar', [TutoriaController::class, 'avaliar'])->name('tutores.avaliar');
    Route::post('/tutores/avaliacoes', [TutoriaController::class, 'armazenarAvaliacao'])->name('tutores.avaliacoes.armazenar');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'administrador'])->prefix('administracao')->name('administracao.')->group(function () {
    Route::get('/', [AdministradorController::class, 'index'])->name('painel');
    Route::post('/conteudos/{conteudo}/aprovar', [AdministradorController::class, 'aprovarConteudo'])->name('conteudos.aprovar');
    Route::post('/conteudos/{conteudo}/rejeitar', [AdministradorController::class, 'rejeitarConteudo'])->name('conteudos.rejeitar');
    Route::post('/materiais/{materia}/aprovar', [AdministradorController::class, 'aprovarMaterial'])->name('materiais.aprovar');
    Route::post('/materiais/{materia}/rejeitar', [AdministradorController::class, 'rejeitarMaterial'])->name('materiais.rejeitar');
});