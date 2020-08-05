<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Article;
use App\Http\Resources\ArticleResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {

    Route::group(['namespace' => 'Auth'], function () {

        Route::post('login', 'LoginController');
        Route::post('register', 'RegisterController');
    });

    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{article}', 'ArticleController@show');
    Route::post('articles', 'ArticleController@store')->middleware('auth:api');
    Route::put('articles/{article}', 'ArticleController@update')->middleware('auth:api');
    Route::delete('articles/{article}', 'ArticleController@destroy')->middleware('auth:api');

    Route::post('comments/{article}', 'CommentController@store')->middleware('auth:api');

    // Route::apiResource('Comment', 'CommentController')->only('index', 'store', 'destroy');
});

