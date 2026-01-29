<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'home')->name('home');
Route::livewire('/categorias', 'categories.index')->name('categories');
Route::livewire('/categorias/{category:slug}', 'categories.show')->name('categories.show');
Route::livewire('/encuestas', 'polls.index')->name('polls');
Route::livewire('/encuestas/{poll:slug}', 'polls.show')->name('polls.show');
Route::livewire('/partidos-politicos', 'parties')->name('parties');
Route::livewire('/candidatos', 'candidates')->name('candidates');
Route::livewire('/contacto', 'contact')->name('contact');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
