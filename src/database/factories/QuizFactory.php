<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            // 日本語のランダムな文字列（約10文字〜20文字）を生成
            'name' => fake()->realText(15) . 'クイズ', 
        ];
    }
}