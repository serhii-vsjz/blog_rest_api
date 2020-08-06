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
        $this->call(UserSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
