<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// ↓この行は一番上の方（他のuseが並んでいるところ）に書いてもOKです！
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;    
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizController;

Route::get('/users', [UserController::class, 'index']);
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
// ↓この行は一番下に追記します
Route::get('/users', [UserController::class, 'index']);

Route::get('/test', [TestController::class, 'test']);

// ① 投稿画面を「表示する（GET）」ための道案内
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->name('posts.create');

// ② データを「保存する（POST）」ための道案内
Route::post('/posts', [PostController::class, 'store'])->middleware('auth')->name('posts.store');

Route::get('/quizzes', [QuizController::class, 'index'])->middleware('auth')->name('quizzes.index');

Route::get('/quizzes/{id}', [QuizController::class, 'show'])->middleware('auth')->name('quizzes.show');

Route::get('/quizzes/{id}/edit', [QuizController::class, 'edit'])->middleware('auth')->name('quizzes.edit');

Route::patch('/quizzes/{id}', [QuizController::class, 'update'])->middleware('auth')->name('quizzes.update');

Route::get('/posts', [PostController::class, 'index'])->middleware('auth')->name('posts.index');

Route::delete('/quizzes/{id}', [QuizController::class, 'destroy'])->middleware('auth')->name('quizzes.destroy');

Route::get('/admin', function () {return view('admin.dashboard');})->middleware(['auth', 'admin'])->name('admin.dashboard');