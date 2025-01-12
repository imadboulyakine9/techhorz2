<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        // Insert articles
        DB::table('articles')->insert([
            [
                'title' => 'Article 1',
                'content' => 'Content for article 1',
                'author_id' => $user1->id,
                'theme_id' => 1,
                'image_url' => 'http://example.com/image1.jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Article 2',
                'content' => 'Content for article 2',
                'author_id' => $user2->id,
                'theme_id' => 2,
                'image_url' => 'http://example.com/image2.jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Article 3',
                'content' => 'Content for article 3',
                'author_id' => $user2->id,
                'theme_id' => 2,
                'image_url' => 'http://example.com/image2.jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Article 4',
                'content' => 'New content for article 4',
                'author_id' => $user2->id,
                'theme_id' => 2,
                'image_url' => 'http://example.com/image2.jpg',
                'is_published' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
