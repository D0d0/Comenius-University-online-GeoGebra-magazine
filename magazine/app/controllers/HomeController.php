<?php

class HomeController extends BaseController {
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

    public function showWelcome() {
        $articles = Article::published()->simplePaginate(9);
        $maxPages = ceil(Article::published()->count() / 9);
        return View::make('index', array('articles' => $articles, 'maxPages' => $maxPages));
    }

    public function search() {
        if (!Input::has('hladanie')) {
            return Redirect::action('HomeController@showWelcome');
        }

        $query = Input::get('hladanie');
        if (!isset($query)) {
            $query = '';
        }
        $query = strtolower(trim($query));

        if (empty($query)) {
            // search for nothig => show everything
            return Redirect::action('HomeController@showWelcome');
        }

        $q = DB::table('tags')
            ->leftJoin('articles', 'tags.id_article', '=', 'articles.id')
            ->leftJoin('tag_groups', 'tags.id_tag', '=', 'tag_groups.id')
            ->select('articles.*')
            ->where('articles.state', '=', 5)
            ->where(function($q2) use ($query) {
                $q2->whereRaw("lower(articles.title) like '%" . $query . "%'")
                   ->orWhere(function($q3) use ($query) {
                       $q3->where('articles.state', '=', 5)
                          ->whereRaw("lower(tag_groups.name) like '%" . $query . "%'");
                   })
                   ->orWhere(function($q4) use ($query) {
                       $q4->where('articles.state', '=', 5)
                          ->whereRaw("lower(articles.text) like '%" . $query . "%'");
                   });
            });

        return View::make('index', array(
            'articles' => $q->simplePaginate(9),
            'maxPages' => ceil($q->count() / 9),
            'query' => $query
        ));
    }

    public function findTag($id = null) {
        $idArticles = [];
        foreach (Tag::where('id_tag', '=', $id)->get() as $tag) {
            $idArticles[] = $tag->id_article;
        }
        if (!count($idArticles)) {
            return Redirect::action('HomeController@showWelcome');
        }
        $articles = Article::whereIn('id', $idArticles)->published()->simplePaginate(9);
        $maxPages = ceil(Article::whereIn('id', $idArticles)->published()->count() / 9);
        return View::make('index', array('articles' => $articles, 'maxPages' => $maxPages));
    }

}
