<?php

/**
 * Controller na zobrazenie domovskej stránky
 */
class HomeController extends BaseController {

    /**
     * Zobrazí domovskú stránku
     * @return type
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
        if (!$query = Input::get('hladanie')) {
            $query = '';
        }

        $query = strtolower(trim($query));

        if (!$query) {
            // search for nothig => show everything
            return Redirect::action('HomeController@showWelcome');
        }

        $q = DB::table('articles')
                ->leftJoin('tags', 'tags.id_article', '=', 'articles.id')
                ->leftJoin('tag_groups', 'tags.id_tag', '=', 'tag_groups.id')
                ->select('articles.*')
                ->distinct()
                ->where('articles.state', '=', Article::PUBLISHED)
                ->where(function($q2) use ($query) {
            $q2->whereRaw("lower(articles.title) like '%" . $query . "%'")
                ->orWhere(function($q3) use ($query) {
                $q3->whereRaw("lower(tag_groups.name) like '%" . $query . "%'");
            })
            ->orWhere(function($q4) use ($query) {
                $q4->whereRaw("lower(articles.text) like '%" . $query . "%'");
            });
        });
        return View::make('index', array(
                    'articles' => $q->simplePaginate(9),
                    'maxPages' => ceil(count($q->get()) / 9),
                    'query' => $query
        ));
    }

    /**
     * Zobrazí domovskú stránku s článkami, ktoré majú určité kľúčové slovo
     * @param type $id
     * @return type
     */
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
