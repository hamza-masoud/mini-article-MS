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

Route::middleware('auth')->group(function () {

    Route::resource('articles', \App\Http\Controllers\Web\ArticleController::class);

    Route::prefix('articles')->as('articles.')->group(function () {

        Route::post('{article:slug}/comments/create', [\App\Http\Controllers\Web\CommentController::class, 'store'])->name('comments.create');
        Route::put('{article:slug}/comments/{comment}/update', [\App\Http\Controllers\Web\CommentController::class, 'update'])->name('comments.update');
        Route::delete('{article:slug}/comments/{comment}/delete', [\App\Http\Controllers\Web\CommentController::class, 'destroy'])->name('comments.destroy');

    });

});


Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {

    Route::get('articles', [\App\Http\Controllers\Web\Admin\ArticleController::class, 'index'])->name('articles.index');
    Route::get('articles/{article:slug}/show', [\App\Http\Controllers\Web\Admin\ArticleController::class, 'show'])->name('articles.show');
    Route::put('articles/{article:slug}/{status}', [\App\Http\Controllers\Web\Admin\ArticleController::class, 'update'])->name('articles.change_status')
        ->where('status', 'approve|reject');
});


