<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/accueil', function () {
    return view('welcome');
})->name('accueil');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/create', function () {
    return view('article.create');
});

// CREATE
Route::get('/create', [ArticleController::class, 'create'])->name('create');
Route::post('/create', [ArticleController::class, 'store']);

//READ
Route::get('/accueil', [ArticleController::class, 'index'])->name('accueil');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('show');

// UPDATE
Route::get('/article/{id}/edit', [ArticleController::class, 'edit'])->name('edit');
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('update');

// DELETE
Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('destroy');

