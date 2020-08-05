<?php


namespace App\Repositories;


use App\Article;
use Illuminate\Database\Eloquent\Collection;


interface ArticleRepositoryInterface
{
    public function getAllArticles(): Collection;
    public function getArticleById(int $id): Article;
}
