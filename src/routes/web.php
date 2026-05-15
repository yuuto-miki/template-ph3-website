<?php

use Illuminate\Support\Facades\Route;

// コントローラーの読み込み（use宣言は一番上にまとめるのが綺麗です）
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\AdminQuizController; // 管理者用のクイズコントローラー

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 誰でもアクセスできるルート（認証不要）
// ==========================================
Route::get('/users', [UserController::class, 'index']);
Route::get('/test', [TestController::class, 'test']);

// 認証機能の読み込み（Breezeデフォルト）
require __DIR__.'/auth.php';


// ==========================================
// 一般ユーザー用ルート（ログイン必須）
// ==========================================
Route::middleware('auth')->group(function () {
    
    // ダッシュボード
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // プロフィール管理（Breezeデフォルト）
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 投稿（Posts）機能
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // クイズ（Quizzes）機能：一般ユーザーは「一覧」と「挑戦（詳細）」のみ
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
    
});


// ==========================================
// 管理者専用ルート（ログイン ＆ 管理者権限必須）
// ==========================================
// 「prefix('admin')」をつけることで、URLが自動的に /admin/... になります
// 「name('admin.')」をつけることで、名前が自動的に admin.quizzes... になります
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    
    // 管理者ダッシュボード（/admin/dashboard）
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // 管理者用クイズ管理（一覧、編集、更新、削除）
    Route::get('/quizzes', [AdminQuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}/edit', [AdminQuizController::class, 'edit'])->name('quizzes.edit');
    Route::patch('/quizzes/{quiz}', [AdminQuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [AdminQuizController::class, 'destroy'])->name('quizzes.destroy');
    Route::get('/quizzes/create', [AdminQuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [AdminQuizController::class, 'store'])->name('quizzes.store');

    // （今後の実装用）設問メンテナンス画面へのルート
    Route::get('/quizzes/{quiz}/questions', function(\App\Models\Quiz $quiz) {
        return "ここは「{$quiz->name}」の設問管理画面です（今後実装）";
    })->name('questions.index');
    
});