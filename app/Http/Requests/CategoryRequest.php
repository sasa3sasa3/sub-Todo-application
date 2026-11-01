<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        // ルートから現在更新しようとしているカテゴリのIDを取得する
        $categoryId = $this->route('id');

        // 第3引数に現在のIDを渡すことで、自分自身の名前との重複はエラーにしない
        return [
            'name' => 'required|string|max:10|unique:categories,name,' . $categoryId,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'カテゴリを入力してください',
            'name.string' => 'カテゴリを文字列にしてください',
            'name.max' => 'カテゴリを10文字以下で入力してください',
            'name.unique' => 'カテゴリが既に存在しています',
        ];
    }
}
