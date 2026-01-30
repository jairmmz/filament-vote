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

Route::middleware('guest')->group(function () {
    Route::livewire('/login', 'auth.login')->name('login');
    Route::livewire('/register', 'auth.register')->name('register');
    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google.redirect');
    Route::livewire('/forgot-password', 'auth.forgot-password')->name('forgot-password');
    Route::livewire('/reset-password', 'auth.reset-password')->name('reset-password');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', App\Livewire\Actions\Logout::class)->name('logout.frontend');
    Route::livewire('/verify-email', 'auth.verify-email')->name('verify-email');
    Route::livewire('/confirm-password', 'auth.confirm-password')->name('confirm-password');
});

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
// Route::livewire('/two-factor-challenge', 'auth.two-factor-challenge')->name('two-factor-challenge');

require __DIR__.'/settings.php';
