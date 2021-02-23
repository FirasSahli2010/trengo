<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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

    public function rating_soort()
    {
          // $articleCollection = collect(
          //         Article::withCount('ratings')::withAvg('ratings')->get()
          //       )->sortByDesc('ra');

          // $articleCollection = collect(
          //         Article::All()->load('ratings')->avg('score')
          //       ); // ::withCount('ratings')
          // return $articleCollectionSorted = $articleCollection;

          //$data = Article::with('ratings')->select('articles.*', 'sum(score)')->join('ratings','article_id','=','articles.id')->groupBy('articles.id')->get();
          $data = DB::table('articles')
                          ->leftJoin('ratings','articles.id', '=', 'ratings.article_id')
                          ->groupBy('articles.id')
                          ->select('articles.*', DB::raw('sum(score) as total_rating'))
                          ->orderBy('total_rating', 'DESC')
                          ->get();
          return $data;
    }

    public function article_amount_limit($amount_limit)
    {
      if ($amount_limit > 0)
      {
        return Article::All()->take($amount_limit);
      }
    }

    public function search_articles($where, $terms)
    {
      $searchTermArray = explode(' ', $terms);
      $cnt = 0;
      if ($where == 'body')
      {
        foreach ($searchTermArray as $searchTerm) {
          if($cnt == 0)
          {
            $cnt++;
            $data = Article::where("desc", "like", "%".$searchTerm."%");
          }
          else {
            $data = $data ->orWhere("desc", "like",  "%".$searchTerm."%");
          }

        }
      }
      else if ($where == 'title')
      {

        foreach ($searchTermArray as $searchTerm) {

          if($cnt == 0)
          {
            $cnt++;
            $data = Article::where("title", "like",  "%".$searchTerm."%");
          }
          else {
            $data = $data->orWhere("title", "like",  "%".$searchTerm."%");
          }
        }

        }
        return $data->get();
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
