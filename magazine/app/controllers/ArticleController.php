<?php

class ArticleController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function newArticle() {
        return View::make('article.article_new');
    }

    public function draft() {
        $articles = Article::where('user_id', '=', Auth::id())->where('state', '=', 1)->get();
        return View::make('article.article_draft', array('articles' => $articles));
    }

    public function accepted() {
        $articles = Article::where('user_id', '=', Auth::id())->where('state', '=', 3)->get();
        return View::make('article.article_accepted', array('articles' => $articles));
    }

    public function unapproved() {
        $articles = Article::where('user_id', '=', Auth::id())->where('state', '=', 4)->get();
        return View::make('article.article_unapproved', array('articles' => $articles));
    }

    public function articleManagement() {
        return View::make('article.article_management');
    }

    public function detail() {
        return View::make('article.article_detail');
    }

}
