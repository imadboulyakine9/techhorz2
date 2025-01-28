<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Issue;
use App\Models\Rate;
use App\Models\Chat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        User::factory()->count(10)->create();

        // Insert themes
        Theme::factory()->count(10)->create();

        // Insert issues
        Issue::factory()->count(10)->create();

        // Insert articles
        Article::factory()->count(10)->create();

        // Insert rates
        Rate::factory()->count(10)->create();

        // Insert chats
        Chat::factory()->count(10)->create();
    }
}