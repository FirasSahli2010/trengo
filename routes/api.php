<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\RatingController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('article/category/{category_list}', [ArticleController::class, 'category_search']);
// Route::post('article',  'App\Http\Controllers\ArticleController@create');
//
// Route::get('article', [ArticleController::class, 'index']);
Route::get('article/from/{from_date}/to/{to_date}', 'App\Http\Controllers\ArticleController@dateFilter');
Route::apiResource('article', ArticleController::class);
Route::apiResource('category', CategoryController::class);

Route::apiResource('view', ViewsController::class);
Route::apiResource('rating', RatingController::class);
