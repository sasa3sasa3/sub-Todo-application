<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    // カテゴリ一覧取得
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'message' => 'カテゴリ一覧取得成功',
            'data' => $categories
        ]);
    }

    // カテゴリ登録
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return response()->json([
            'message' => 'カテゴリを作成しました',
            'data' => $category
        ], 201);
    }

    // カテゴリ詳細取得
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'message' => 'カテゴリ取得成功',
            'data' => $category
        ]);
    }

    // カテゴリ更新
    public function update(CategoryRequest $request, $id)
    {
        $validated = $request->validated();

        $category = Category::findOrFail($id);

        $category->update($validated);

        return response()->json([
            'message' => 'カテゴリを更新しました',
            'data' => $category
        ]);
    }

    // カテゴリ削除
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'message' => 'カテゴリを削除しました'
        ]);
    }
}
