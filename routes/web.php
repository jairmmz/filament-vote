<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'home')->name('home');
Route::livewire('/categorias', 'categories.index')->name('categories');
Route::livewire('/categorias/{category:slug}', 'categories.show')->name('categories.show');
Route::livewire('/encuestas', 'polls.index')->name('polls');
Route::livewire('/encuestas/{poll:slug}', 'polls.show')->name('polls.show');
Route::livewire('/partidos-politicos', 'parties.index')->name('parties');
Route::livewire('/partidos-politicos/{politicalParty:slug}', 'parties.show')->name('parties.show');
Route::livewire('/partidos-politicos/{politicalParty:slug}/candidato/{candidate:slug}', 'parties.candidate')->name('parties.candidate');
Route::livewire('/contacto', 'contact')->name('contact');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

require __DIR__.'/settings.php';
