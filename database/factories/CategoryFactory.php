<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                '勉強',
                '仕事',
                '買い物',
                '趣味',
                '運動',
            ]),
        ];
    }
}
