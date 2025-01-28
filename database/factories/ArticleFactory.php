<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'author_id' => User::factory(),
            'theme_id' => Theme::factory(),
            'image_url' => $this->faker->imageUrl,
            'is_published' => $this->faker->boolean,
        ];
    }
}