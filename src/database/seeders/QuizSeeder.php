<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ITクイズの作成
        $itQuiz = Quiz::create(['name' => 'ITクイズ']);

        $q1 = Question::create([
            'quiz_id' => $itQuiz->id,
            'text' => '日本のIT人材が2030年には最大どれくらい不足すると言われているでしょうか？',
        ]);
        Choice::create(['question_id' => $q1->id, 'text' => '約79万人', 'is_correct' => true]);
        Choice::create(['question_id' => $q1->id, 'text' => '約28万人', 'is_correct' => false]);
        Choice::create(['question_id' => $q1->id, 'text' => '約183万人', 'is_correct' => false]);

        $q2 = Question::create([
            'quiz_id' => $itQuiz->id,
            'text' => '既存業界のビジネスと、先進的なテクノロジーを結びつけて生まれた、新しいビジネスのことをなんと言うでしょう？',
        ]);
        Choice::create(['question_id' => $q2->id, 'text' => 'INTECH', 'is_correct' => false]);
        Choice::create(['question_id' => $q2->id, 'text' => 'BIZZTECH', 'is_correct' => false]);
        Choice::create(['question_id' => $q2->id, 'text' => 'X-TECH', 'is_correct' => true]);

        // 2. 自己紹介クイズの作成
        $introQuiz = Quiz::create(['name' => 'Aさんクイズ']);

        $aq1 = Question::create([
            'quiz_id' => $introQuiz->id,
            'text' => '出身地はどこでしょう？',
        ]);
        Choice::create(['question_id' => $aq1->id, 'text' => '東京', 'is_correct' => true]);
        Choice::create(['question_id' => $aq1->id, 'text' => 'ハワイ', 'is_correct' => false]);
        Choice::create(['question_id' => $aq1->id, 'text' => 'ロンドン', 'is_correct' => false]);
    }
}