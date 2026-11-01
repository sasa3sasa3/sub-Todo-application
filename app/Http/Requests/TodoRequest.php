<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        //dd('TodoRequest executed');

        return [
            'content' => 'required|string|max:20',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Todoを入力してください',
            'content.string' => 'Todoを文字列で入力してください',
            'content.max' => 'Todoを20文字以内で入力してください',

            'category_id.required' => 'カテゴリを選択してください',
            'category_id.exists' => '存在しないカテゴリです',
        ];
    }
}
