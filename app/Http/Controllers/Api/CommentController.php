<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, int $id)
    {
        $user = auth()->guard('api')->user();

        $comment = Comment::create(array_merge($request->all(), ['user_id' => $user->id, 'article_id' => $id]));

        return response()->json(
            null,
            201,
            ['Location' => route('article.show', ['article' => $comment->article->id])]);
    }
}
