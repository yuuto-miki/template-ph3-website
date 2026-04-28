<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Postモデルを使う宣言

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all(); // データベースの posts テーブルから全レコードを取得
        return view('posts.index', compact('posts')); // resources/views/posts/index.blade.php にデータを渡して表示
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255', // 必須入力（required）、255文字以内（max:255）
            'body'  => 'required',         // 必須入力（required）
        ]);

        $validatedData['user_id'] = auth()->id(); // 現在ログインしているユーザーのIDを追加

        Post::create($validatedData);

        return back()->with('message', '投稿が保存されました！');
    }
}
