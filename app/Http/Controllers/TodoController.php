<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;

class TodoController extends Controller
{
    public function index()
    {
        //N+1問題
        //$todos = Todo::all();

        $todos = Todo::with('category')->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('todos.index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request)
    {
        //Todoの追加
        $validated = $request->validated();

        $todo = Todo::create($validated);

        return redirect()->route('todos.index')->with('success', 'Todoを作成しました');
    }

    public function update(TodoRequest $request, $id)
    {
        //Todoの更新
        $validated = $request->validated();
        $todo = Todo::find($id);
        $todo->update($validated);

        return redirect()->route('todos.index')->with('success', 'Todoを更新しました');

    }

    public function destroy($id)
    {
        //Todoの削除
        Todo::find($id)->delete();

        return redirect()->route('todos.index')->with('success', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        //Todoの検索
        $query = Todo::query()->with('category');

        if ($request->filled('keyword')) {
            $query->where(
                'content',
                'like',
                '%' . $request->keyword . '%'
            );
        }

        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->category_id
            );
        }

        $todos = $query->get();

        $categories = Category::all();

        return view('todos.index', compact('todos', 'categories'));
    }
}
