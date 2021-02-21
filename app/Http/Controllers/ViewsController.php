<?php

namespace App\Http\Controllers;

use App\Models\Views;
use App\Models\Article;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;

class ViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $article = Article::find($request->article);
        $view = new Views([
          'user_address' => $request->user_address,
        ]);

        $view->article()->associate($article);

        $view->save();

          return $view->load('article');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Views  $views
     * @return \Illuminate\Http\Response
     */
    public function show(Views $views)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Views  $views
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Views $views)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Views  $views
     * @return \Illuminate\Http\Response
     */
    public function destroy(Views $views)
    {
        //
    }
}
