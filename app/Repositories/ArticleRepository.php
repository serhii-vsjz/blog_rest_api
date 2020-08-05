<?php


namespace App\Repositories;


use App\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAllArticles(): Collection
    {
        return Article::all();
    }

    public function getArticleById(int $id): Article
    {
        return Article::find($id);
    }
}
