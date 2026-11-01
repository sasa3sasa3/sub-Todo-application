<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Todo;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        Category::create($validated);


        return redirect()->route('categories.index')->with('success', 'カテゴリを作成しました');
    }

    public function update(CategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $category = Category::find($id);
        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'カテゴリを更新しました');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'カテゴリを削除しました');
    }
}
