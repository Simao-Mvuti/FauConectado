<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\MateriaUploadController;
use App\Livewire\ApoiarIndex;
use App\Livewire\MateriaIndex;
use App\Livewire\MateriaShow;
use App\Livewire\TutorIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/materias', MateriaIndex::class)->name('materias.index');
Route::get('/materias/upload', [MateriaUploadController::class, 'create'])->name('materias.upload');
Route::post('/materias/upload', [MateriaUploadController::class, 'store'])->name('materias.upload.store');
Route::get('/tutores', TutorIndex::class)->name('tutor.index');
Route::get('/apoiar', ApoiarIndex::class)->name('apoiar.index');
Route::get('/materias/{id}', MateriaShow::class)->name('materias.show');

Route::get('/tutor-inscricao', [TutorIndex::class, 'inscrever'])->name('tutor.inscricao');
Route::get('/tutores-inscricao', [TutorIndex::class, 'inscrever'])->name('tutores.inscricao');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/materiais', [AdminDashboardController::class, 'materiais'])->name('admin.materiais');
    Route::get('/admin/tutores', [AdminDashboardController::class, 'tutores'])->name('admin.tutores');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
