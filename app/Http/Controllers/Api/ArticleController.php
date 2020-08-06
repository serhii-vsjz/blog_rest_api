<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteUri;
use Illuminate\Routing\RouteUrlGenerator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;


final class ArticleController extends Controller
{
    use ApiResponse;
    /**
     * NotFoundHttpException
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json(ArticleResource::collection(Article::all()),
            200,
            ['Content-Type' => 'application/json; charset=UTF-8']);
    }

    /**
     * Show article by id.
     *
     * @param int $articleId
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function show(int $articleId)
    {
        $article = Article::find($articleId);

        if (!$article) {
            return response()->json(null, 404);
        }
        return response()->json(new ArticleResource($article),
            200,
            ['Content-Type' => 'application/json; charset=UTF-8']);

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

        return response()->json(
            null,
            201,
        ['Location' => route('article.show', ['article' => $article->id])]);
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
            return response()->json(null,Response::HTTP_NOT_FOUND);
        }

        $data = $request->all();

        if (Gate::allows('update-article', $article))
        {
            $article = $article->fill($data)->push();
            //
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } else {
            return response()->json(null, Response::HTTP_FORBIDDEN);
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
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } else {
            return response()->json(null, Response::HTTP_FORBIDDEN);
        }
    }
}
