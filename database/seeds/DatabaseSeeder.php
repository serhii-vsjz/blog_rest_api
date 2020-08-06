<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Article;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 5)
            ->create()
            ->each(function ($user) {
                $articles = $user->articles()->createMany(
                    factory(Article::class, 3)->make()->toArray()
                );
        });

        $articles = factory(Comment::class, 15)->create();
    }
}
