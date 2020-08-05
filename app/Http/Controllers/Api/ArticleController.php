<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;


final class ArticleController extends Controller
{
    /**
     * Get all articles
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return ArticleResource::collection(Article::all())
            ->response()
            ->header('Content-Type','application/json')
            ->setEncodingOptions('charset=UTF-8')
            ->setStatusCode(Response::HTTP_OK);
    }


    /**
     *
     *
     * @param int $articleId
     * @return \Illuminate\Http\JsonResponse|Response|object
     */
    public function show(int $articleId)
    {
        $article = Article::find($articleId);

        if (!$article) {
            return (new ArticleResource(null))
                ->response()
                ->setStatusCode(Response::HTTP_OK);
        }
        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Save the new article in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = auth()->guard('api')->user();

        $article = Article::create(array_merge($request->all(), ['user_id' => $user->id]));

        return (new ArticleResource($article))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update article.
     *
     * @param Request $request
     * @param int $objectId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $objectId)
    {
        $article = Article::find($objectId);

        if (!$article) {
            return response()->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();

        if (Gate::allows('update-article', $article))
        {
            $article->fill($data)->push();
            return response(null, Response::HTTP_NO_CONTENT);
        } else {
            return response(null, Response::HTTP_FORBIDDEN);
        }
    }


    /**
     * Remove object by Id.
     *
     * @param int $articleId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(int $articleId)
    {
        $article = Article::find($articleId);

        if(!$article) {
            return response(null, Response::HTTP_NOT_FOUND);
        }

        if (Gate::allows('update-article', $article))
        {
            $article->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        } else {
            return response(null, Response::HTTP_FORBIDDEN);
        }
    }
}
