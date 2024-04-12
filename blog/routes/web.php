<?php

use Illuminate\Support\Facades\Route;

Route::get('/accueil', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});
