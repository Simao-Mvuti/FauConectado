<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ConteudoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TutoriaController;
use Illuminate\Support\Facades\Route;

Route::middleware('visitante')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
    Route::post('/tutores/solicitacoes/{solicitacao}/assumir', [TutoriaController::class, 'assumirSolicitacao'])->name('tutores.solicitacoes.assumir');
    Route::get('/tutores/candidatar', [TutoriaController::class, 'candidatar'])->name('tutores.candidatar');
    Route::post('/tutores/candidaturas', [TutoriaController::class, 'armazenarCandidatura'])->name('tutores.candidaturas.armazenar');
    Route::get('/tutores/avaliar', [TutoriaController::class, 'avaliar'])->name('tutores.avaliar');
    Route::post('/tutores/avaliacoes', [TutoriaController::class, 'armazenarAvaliacao'])->name('tutores.avaliacoes.armazenar');
});

Route::get('/administracao/acesso', [AdministradorController::class, 'acesso'])->name('administracao.acesso');
Route::post('/administracao/acesso', [AdministradorController::class, 'autenticarAcesso'])->name('administracao.autenticar');

Route::middleware(['visitante', 'auth', 'administrador'])->prefix('administracao')->name('administracao.')->group(function () {
    Route::get('/', [AdministradorController::class, 'index'])->name('painel');
    Route::post('/conteudos/{conteudo}/aprovar', [AdministradorController::class, 'aprovarConteudo'])->name('conteudos.aprovar');
    Route::post('/conteudos/{conteudo}/rejeitar', [AdministradorController::class, 'rejeitarConteudo'])->name('conteudos.rejeitar');
    Route::post('/materiais/{materia}/aprovar', [AdministradorController::class, 'aprovarMaterial'])->name('materiais.aprovar');
    Route::post('/materiais/{materia}/rejeitar', [AdministradorController::class, 'rejeitarMaterial'])->name('materiais.rejeitar');
    Route::post('/candidaturas/{candidatura}/aprovar', [AdministradorController::class, 'aprovarCandidatura'])->name('candidaturas.aprovar');
    Route::post('/candidaturas/{candidatura}/rejeitar', [AdministradorController::class, 'rejeitarCandidatura'])->name('candidaturas.rejeitar');
    Route::delete('/conteudos/{conteudo}', [AdministradorController::class, 'excluirConteudo'])->name('conteudos.excluir');
    Route::delete('/materiais/{materia}', [AdministradorController::class, 'excluirMateria'])->name('materiais.excluir');
    Route::delete('/eventos/{evento}', [AdministradorController::class, 'excluirEvento'])->name('eventos.excluir');
    Route::delete('/usuarios/{usuario}', [AdministradorController::class, 'excluirUsuario'])->name('usuarios.excluir');
    Route::post('/usuarios/{usuario}/papel', [AdministradorController::class, 'atualizarPapel'])->name('usuarios.papel');
    Route::delete('/solicitacoes/{solicitacao}', [AdministradorController::class, 'excluirSolicitacao'])->name('solicitacoes.excluir');
    Route::delete('/avaliacoes/{avaliacao}', [AdministradorController::class, 'excluirAvaliacao'])->name('avaliacoes.excluir');
    Route::delete('/avaliacoes-materiais/{avaliacao}', [AdministradorController::class, 'excluirAvaliacaoMaterial'])->name('avaliacoes_materiais.excluir');
});
