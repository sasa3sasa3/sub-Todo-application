<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Todo;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{

    public function definition(): array
    {
        return [
            'content' => fake()->randomElement([
                'Laravelを勉強する',
                '買い物へ行く',
                '部屋を掃除する',
                '筋トレをする',
                'お問い合わせ機能を作る',
            ]),
        ];
    }
}       

