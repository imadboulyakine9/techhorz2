<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $user1 = User::create([
            'name' => 'Author 1',
            'email' => 'author1@example.com',
            'password' => bcrypt('password')
        ]);

        $user2 = User::create([
            'name' => 'Author 2',
            'email' => 'author2@example.com',
            'password' => bcrypt('password')
        ]);

        // Insert themes
        DB::table('themes')->insert([
            [
                'name' => 'Development',
                'description' => 'Description for theme 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'News',
                'description' => 'Description for theme 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        // Insert articles
        DB::table('articles')->insert([
            [
                'title' => 'Article 1',
                'content' => 'Content for article 1',
                'author_id' => $user1->id,
                'theme_id' => 1,
                'image_url' => 'https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Article 2',
                'content' => 'Content for article 2',
                'author_id' => $user2->id,
                'theme_id' => 2,
                'image_url' => 'https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Article 3',
                'content' => 'Content for article 3',
                'author_id' => $user2->id,
                'theme_id' => 2,
                'image_url' => 'https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Article 4',
                'content' => 'New content for article 4',
                'author_id' => $user2->id,
                'theme_id' => 2,
                'image_url' => 'https://images.pexels.com/photos/674010/pexels-photo-674010.jpeg?cs=srgb&dl=pexels-anjana-c-169994-674010.jpg&fm=jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
} 