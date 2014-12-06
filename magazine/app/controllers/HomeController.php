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
        $maxPages = ceil(Article::published()->count() / 9);
        $articles = Article::published()->orderBy('updated_at', 'DESC')->simplePaginate(9);
        return View::make('index', array(
                    'articles' => $articles,
                    'maxPages' => $maxPages
        ));
    }

    public function tags() {
        $input = Input::all();

        if (!Request::ajax() || !$query = Input::get('query')) {
            return Response::json(array('result' => $input));
        }

        $quoted_query = '%' . DBHelper::strip_like($query) . '%';
        $tags = DB::table('users')
                ->where('name', 'LIKE', $quoted_query)
                ->leftJoin('articles', 'users.id', '=', 'articles.user_id')
                ->where('articles.state', '=', Article::PUBLISHED)
                ->distinct()
                ->select('name');
        if ($tags->count() < 10) {
            $tags = DB::table('tag_groups')
                    ->leftJoin('tags', 'tags.id_tag', '=', 'tag_groups.id')
                    ->leftJoin('articles', 'tags.id_article', '=', 'articles.id')
                    ->where('name', 'LIKE', $quoted_query)
                    ->where('articles.state', '=', Article::PUBLISHED)
                    ->select('name')
                    ->distinct()
                    ->union($tags);
            $querySql = $tags->toSql();
            $tags = DB::table(DB::raw("($querySql order by name asc) as name"))->mergeBindings($tags);
        }
        $tags = $tags
                ->orderBy('name', 'ASC')
                ->take(10)
                ->lists('name');
        return Response::json(array('result' => $tags));
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

        $date_validator = Validator::make(
                        array('datum' => $query), array('datum' => 'date_format:"d.m.Y"')
        );

        $quoted_query = '%' . DBHelper::strip_like($query) . '%';
        $articles = Article::published();
        if ($date_validator->passes()) {
            $myDate = DateTime::createFromFormat('d.m.Y', $query);
            $iso8601date = $myDate->format('Y-m-d');
            $articles = $articles
                    ->where('updated_at', '>=', $iso8601date)
                    ->orderBy('updated_at', 'DESC');
        } else {
            $articles = $articles
                    ->leftJoin('users', 'users.id', '=', 'articles.user_id')
                    ->leftJoin('tags', 'tags.id_article', '=', 'articles.id')
                    ->leftJoin('tag_groups', 'tags.id_tag', '=', 'tag_groups.id')
                    ->select('articles.*')
                    ->distinct()
                    ->where(function($q2) use ($quoted_query) {
                        $q2->where('articles.title', 'LIKE', $quoted_query)
                        ->orWhere(function($q3) use ($quoted_query) {
                            $q3->where('tag_groups.name', 'LIKE', $quoted_query);
                        })
                        ->orWhere(function($q4) use ($quoted_query) {
                            $q4->where('articles.text', 'LIKE', $quoted_query);
                        })
                        ->orWhere(function($q5) use ($quoted_query) {
                            $q5->where('users.name', 'LIKE', $quoted_query);
                        });
                    })
                    ->orderBy('updated_at', 'DESC');
        }
        $maxPages = ceil(count($articles->get()) / 9);
        return View::make('index', array(
                    'articles' => $articles->orderBy('title', 'asc')->simplePaginate(9),
                    'maxPages' => $maxPages,
                    'query' => $query,
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
        $maxPages = ceil(Article::whereIn('id', $idArticles)->published()->count() / 9);
        $articles = Article::whereIn('id', $idArticles)->orderBy('updated_at', 'DESC')->published()->simplePaginate(9);
        return View::make('index', array(
                    'articles' => $articles,
                    'maxPages' => $maxPages));
    }

}
