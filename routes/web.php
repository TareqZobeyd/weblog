<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Auth Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts Routes
    Route::get('/home/create', [PostController::class, 'create'])->name('home.create');
    Route::post('/home', [PostController::class, 'store'])->name('home.store');
    Route::get('/home/{post}/edit', [PostController::class, 'edit'])->name('home.edit');
    Route::put('/home/{post}', [PostController::class, 'update'])->name('home.update');
    Route::delete('/home/{post}', [PostController::class, 'destroy'])->name('home.destroy');

    // Comments Routes
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Tags Routes
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

});

Route::get('/home', [PostController::class, 'index'])->name('home.index');

require __DIR__.'/auth.php';
