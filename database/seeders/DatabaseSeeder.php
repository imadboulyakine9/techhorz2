<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Theme;
use App\Models\Issue;
use App\Models\Article;
use App\Models\Rate;
use App\Models\Chat;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        $user1 = User::create([
            'name' => 'Author 1',
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ]);

        $user2 = User::create([
            'name' => 'Author 2',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $user3 = User::create([
            'name' => 'Author 3',
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
            'role' => 'theme_manager'
        ]);


        // Insert themes
        DB::table('themes')->insert([
            [
                'name' => 'Development',
                'description' => 'Description for theme 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'manager_id' => $user1->id,
            ],
            [
                'name' => 'Intelligence Artificielle',
                'description' => 'Explorez les avancées en IA, machine learning et deep learning.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Internet des Objets',
                'description' => 'Découvrez les innovations en IoT et objets connectés.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cybersécurité',
                'description' => 'Actualités et analyses sur la sécurité informatique.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Réalité Virtuelle et Augmentée',
                'description' => 'Les dernières innovations en VR/AR.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cloud Computing',
                'description' => 'Technologies cloud et solutions d\'hébergement.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Blockchain',
                'description' => 'Cryptomonnaies et technologies blockchain.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'News',
                'description' => 'Description for theme 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'manager_id' => $user3->id,
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