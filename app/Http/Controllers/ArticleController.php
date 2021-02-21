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
        // $articles = Article::All();
        // return $articles;/
        return ArticleResource::collection(Article::all()->load('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // $article = new Article($request->all());
      // //return 'FFFFFFFFF';
      // // $article = new Article();
      // // $article->title = $request['title'];
      // // $article->desc = $request['body'];
      // // $article->categories = $request['categories'];
      // //
      //  $article->save();
      $categories = Category::Find($request->categories);
      $article = new Article([

        'title' => $request->title,
        'desc' => $request->desc,
      ]);
      $article->save();
      $article->categories()->attach($categories);
      $article->save();
      //return response()->json($article->load('categories'), 201);
      return new ArticleResource($article->load('categories'), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    public function show(Article $article)
    {
        // $article = Article::findorfail($id);
        // return $article;
        //return (new ArticleResource($article->load('categories')))->response();
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
