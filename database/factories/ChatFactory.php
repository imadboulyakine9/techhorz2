<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = Chat::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'article_id' => Article::factory(),
            'comment' => $this->faker->sentence,
        ];
    }
}