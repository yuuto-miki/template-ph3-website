<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    // 1. 管理画面のクイズ一覧
    public function index()
    {
        // ▼ 修正ポイント1：withTrashed() を追加して削除済みも取得！
        // ▼ 修正ポイント2：最新順(latest)にして、ページネーション確認用に「10件」にしています
        $quizzes = Quiz::withTrashed()->latest()->paginate(10);
        
        return view('admin.quizzes.index', compact('quizzes'));
    }

    // 2. 新規作成画面（Bladeの新規作成ボタン用）
    public function create()
    {
        return view('admin.quizzes.create');
    }

    // 3. 新規保存処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Quiz::create($validated);

        return redirect()->route('admin.quizzes.index')->with('message', 'クイズを新規作成しました。');
    }

    // 4. クイズ編集画面
    public function edit(Quiz $quiz)
    {
        // ▼ 修正ポイント3：管理画面用のフォルダ(admin.)に向き先を修正
        return view('admin.quizzes.edit', compact('quiz'));
    }

    // 5. クイズ更新処理
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $quiz->update($validated);

        return redirect()->route('admin.quizzes.index')->with('message', 'クイズのタイトルを更新しました。');
    }

    // 6. 削除処理（Bladeの削除ボタン用 / 論理削除）
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')->with('message', 'クイズを削除しました。');
    }
}