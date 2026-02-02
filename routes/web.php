<?php

use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

Route::view('/politicas-de-privacidad', 'policies.privacy-policy')->name('privacy-policy');
Route::view('/terminos-y-condiciones', 'policies.consent-terms')->name('consent-terms');

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/categorias'))
        ->add(Url::create('/encuestas'))
        ->add(Url::create('/partidos-politicos'));

    foreach (App\Models\Category::all() as $category) {
        $sitemap->add(Url::create(route('categories.show', $category))
            ->setLastModificationDate($category->updated_at));
    }

    foreach (App\Models\Poll::all() as $poll) {
        $sitemap->add(Url::create(route('polls.show', $poll))
            ->setLastModificationDate($poll->updated_at));
    }

    foreach (App\Models\PoliticalParty::all() as $party) {
        $sitemap->add(Url::create(route('parties.show', $party))
            ->setLastModificationDate($party->updated_at));

        foreach ($party->candidates as $candidate) {
            $sitemap->add(Url::create(route('parties.candidate', ['politicalParty' => $party, 'candidate' => $candidate]))
                ->setLastModificationDate($candidate->updated_at));
        }
    }

    return $sitemap;
});

require __DIR__.'/settings.php';
