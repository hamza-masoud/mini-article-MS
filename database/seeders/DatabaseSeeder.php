<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        User::create([
            'email' => 'hamza@gmail.com',
            'password' => \Hash::make('Password'),
            'first_name' => 'Hamza',
            'last_name' => 'Masoud',
            'role' => 'admin',
            'gender' => 'male',
            'verified_at' => now()
        ]);

        User::create([
            'email' => 'fadi@gmail.com',
            'password' => \Hash::make('Password'),
            'first_name' => 'Fadi',
            'last_name' => 'Al Khairy',
            'role' => 'admin',
            'gender' => 'male',
            'verified_at' => now()
        ]);

//        create 20 users
        User::factory(20)->create(['role' => 'user'])
            ->each(function ($user) use ($faker) {
//                create 5 articles for each user
                $user->articles()->saveMany(Article::factory($faker->randomDigit())->make())
                    ->each(function ($article) use ($faker, $user) {
//                        create 5 comments (from random users) for each article
                        $article->comments()->saveMany(Comment::factory($faker->numberBetween(3, 30))
                            ->make(['user_id' => $faker->numberBetween(1, 10)]))
                            ->each(function ($comment) use ($faker, $article) {
//                        create 5 comments (from random users) for each comment
                                $comment->replies()->saveMany(Comment::factory($faker->numberBetween(0, 10))
                                    ->make(['user_id' => $faker->numberBetween(1, 10), 'article_id' => $article->id]));
                            });
                    });
            });
    }
}

