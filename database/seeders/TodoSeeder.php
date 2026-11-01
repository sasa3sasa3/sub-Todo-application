<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Todo;
use App\Models\Category;

class TodoSeeder extends Seeder
{
    public function run(): void
    {
        //すべてのカテゴリを取得
        $categories = Category::all();

        //各カテゴリに3件のTodoを作成
        foreach ($categories as $category) {
            Todo::factory()->count(3)->create([
                'category_id' => $category->id,
            ]);
        }
    }
}
