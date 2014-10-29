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
        return View::make('article.article_draft');
    }
    
    public function accepted() {
        return View::make('article.article_accepted');
    }
    
    public function unapproved() {
        return View::make('article.article_unapproved');
    }
    
    public function articleManagement() {
        return View::make('article.article_management');
    }
    
    public function detail() {
        return View::make('article.article_detail');
    }

}
