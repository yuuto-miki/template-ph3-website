<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz; // Quizモデルを使う宣言

    class QuizController extends Controller
{
    public function index()
    {
        // モデルを利用して、quizzesテーブルのデータを全件取得！
        $quizzes = Quiz::all();

        // 取得したデータを 'quizzes.index' というビュー（お皿）に渡す
        return view('quizzes.index', compact('quizzes'));
    }

// $id にはURLの数字（1や2など）が入ってきます
    public function show($id)
    {
        // クイズと一緒に、紐づく設問(questions)と選択肢(choices)をまとめて取得！
        $quiz = Quiz::with('questions.choices')->findOrFail($id);

        return view('quizzes.show', compact('quiz'));
    }

    // クイズ編集フォームを表示
    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('quizzes.edit', compact('quiz'));
    }

    // クイズを更新
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255', // タイトル（name）のみ編集可能
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update($validatedData);

        return redirect()->route('quizzes.index')->with('message', '更新されました！');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete(); // データベースから削除！

        return redirect()->route('quizzes.index')->with('message', '削除しました！');
    }
}