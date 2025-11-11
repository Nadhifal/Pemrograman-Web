<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

use App\Http\Controllers\HomeController;
Route::match(['get', 'post'], '/', [HomeController::class, 'index'])->name('home');


