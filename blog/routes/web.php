<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route publique se connecter et s'enregistrer mdp 12345@azert

// BREEZE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::name('articles.')
    ->prefix("articles")
    ->controller(ArticleController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/article/{article}')->name('show');
        Route::get('/article/{id}/edit', 'edit')->name('edit');
        Route::put('/article/{id}', 'update')->name('update');
        Route::delete('/article/{id}', 'destroy')->name('destroy');

    });

Route::get('/', function () {
    return redirect()->route('articles.index');
})->name('accueil');

Route::name('comments.')->prefix("comments")->group(function () {
    Route::post("/{articleId}", [CommentController::class, 'store'])->name('store')->middleware('auth');
});




require __DIR__.'/auth.php';

