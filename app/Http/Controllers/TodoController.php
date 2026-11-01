<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    // Todo一覧取得
    public function index()
    {
        $todos = Todo::with('category')->latest()->get();

        return TodoResource::collection($todos);
    }

    // Todo登録
    public function store(TodoRequest $request)
    {
        dd('store reached');

        $validated = $request->validated();

        $todo = Todo::create($validated);

        return response()->json([
            'message' => 'Todoを作成しました',
            'data' => $todo
        ], 201);
    }

    // Todo詳細取得
    public function show($id)
    {
        $todo = Todo::with('category')->findOrFail($id);

        return response()->json([
            'message' => 'Todo取得成功',
            'data' => $todo
        ]);
    }

    // Todo更新
    public function update(TodoRequest $request, Todo $todo)
    {
        $validated = $request->validated();

        $todo->update($request->validated());

        return response()->json([
            'message' => 'Todoを更新しました',
            'data' => $todo
        ]);
    }

    // Todo削除
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();

        return response()->json([
            'message' => 'Todoを削除しました'
        ]);
    }

    // Todo検索
    public function search(Request $request)
    {
        $query = Todo::with('category');

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

        return response()->json([
            'message' => '検索成功',
            'data' => $todos
        ]);
    }
}
