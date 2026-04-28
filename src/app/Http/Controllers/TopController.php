<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index()
    {
        // エラーを防ぐため、とりあえず空の配列を準備する
        $questions = [];

        // View（見た目）に $questions を渡す
        return view('top', compact('questions'));
    }
}