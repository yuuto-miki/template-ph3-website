<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 誰でも（このルートに到達できれば）許可
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100', // 必須、文字列、100文字以内
        ];
    }

    // エラーメッセージを日本語にする場合（任意）
    public function messages(): array
    {
        return [
            'name.required' => 'タイトルは必須項目です。',
            'name.max' => 'タイトルは100文字以内で入力してください。',
        ];
    }
}