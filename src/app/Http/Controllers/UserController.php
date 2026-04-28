<?php

namespace App\Http\Controllers;

use App\Models\User; // Userモデルを使う宣言
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // データベースの users テーブルから全レコードを取得 　User::はUserモデルの呼び出し
        $users = User::all();

        // resources/views/users/index.blade.php にデータを渡して表示
        return view('users.index', compact('users'));
    }
}