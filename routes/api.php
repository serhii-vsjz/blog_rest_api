<?php

use Illuminate\Support\Facades\Route;


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


    Route::get('article/{article}', 'ArticleController@show')->name('article.show');
    Route::get('article', 'ArticleController@index');

    Route::group(['middleware' => 'auth:api'], function () {

        Route::post('article', 'ArticleController@store');
        Route::put('article/{article}', 'ArticleController@update');
        Route::delete('article/{article}', 'ArticleController@destroy');

        Route::post('comment/{article}', 'CommentController@store');
    });



});

