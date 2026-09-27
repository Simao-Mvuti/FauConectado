<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\MateriaIndex;
use App\Livewire\TutorIndex;
use App\Livewire\ApoiarIndex;
use App\Livewire\ComoFuncionaIndex;


Route::view('/', 'welcome')->name('home');
Route::get('/materias', MateriaIndex::class)->name('materias.index');
Route::get('/tutores',TutorIndex::class)->name('tutor.index');
Route::get('/apoiar',ApoiarIndex::class)->name('apoiar.index');
Route::get('/como-funciona',ComoFuncionaIndex::class)->name('comoFunciona.index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



require __DIR__.'/auth.php';
