<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('accueil');
})->name('accueil');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


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

// CREATE
Route::get('/create', function () {
    return view('article.create');
});

Route::get('/create', [ArticleController::class, 'create'])->name('create');
Route::post('/create', [ArticleController::class, 'store'])->name('store');

//READ
Route::get('/accueil', [ArticleController::class, 'index'])->name('accueil');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('show');

// UPDATE
Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('edit');
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('update');

// DELETE
Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('destroy');



Route::name('comments.')->prefix("comments")->group(function () {
    Route::post("/{articleId}", [CommentController::class, 'store'])->name('store')->middleware('auth');
});


require __DIR__.'/auth.php';

