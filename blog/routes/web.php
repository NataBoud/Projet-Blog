<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('accueil');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Route publique se connecter et s'enregistrer mdp 12345@azert
Route::get('/login', function () {
    return view('login');
})->name("enregistrer");

Route::get('/register', function () {
    return view('register');
})->name("se connecter");


// BREEZE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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

require __DIR__.'/auth.php';

