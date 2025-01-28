<?php

namespace Database\Factories;

use App\Models\Rate;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    protected $model = Rate::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'article_id' => Article::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}