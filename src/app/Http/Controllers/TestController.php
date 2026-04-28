<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Userモデルを使う宣言

class TestController extends Controller
{
    public function test() {
        $users = User::all(); // データベースの users テーブルから全レコードを取得
        return view ('test', compact('users')); // resources/views/test.blade.php にデータを渡して表示
    }}
