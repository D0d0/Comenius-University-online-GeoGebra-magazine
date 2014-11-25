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
