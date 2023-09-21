<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('auth')->as('auth.')->group(function () {
    Route::view('login', 'pages.auth.login')->name('login');
    Route::post('login', [\App\Http\Controllers\Web\AuthController::class, 'login'])->name('login_submit');
    Route::view('register', 'pages.auth.register')->name('register');
    Route::post('logout', [\App\Http\Controllers\Web\AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

Route::get('home', [\App\Http\Controllers\Web\HomeController::class, 'index'])->name('home');
Route::get('home/article/{article:slug}', [\App\Http\Controllers\Web\HomeController::class, 'show'])->name('home-article-show');
