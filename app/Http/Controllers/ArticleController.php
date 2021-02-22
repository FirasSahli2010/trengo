<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ArticleResource::collection(Article::all()->load('categories'));
    }

    public function display_views()
    {
          $articleCollection = collect(
                  Article::withCount('views')->get()
                )->sortByDesc('views_count');
          return $articleCollectionSorted = $articleCollection;
    }


    public function display_article_views(Article $article)
    {
        return new ArticleResource($article);
    }

    public function dateFilter($fromDate, $toDate) {
      $articles = Article::whereDate('created_at', '>=', $fromDate)
                          ->whereDate('created_at', '<=', $toDate)
                          ->get();
      return ArticleResource::collection($articles->load('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $categories = Category::Find($request->categories);
      $article = new Article([

        'title' => $request->title,
        'desc' => $request->desc,
      ]);
      $article->save();
      $article->categories()->attach($categories);
      $article->save();
      return new ArticleResource($article->load('categories'), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return new ArticleResource($article->load('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }


}
