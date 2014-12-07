<?php

/**
 * Trieda pre prácu s článkami
 */
class ArticleController extends BaseController {

    /**
     * Slúži na zobrazenie editora
     * @param type $id
     * @return type
     */
    public function newArticle($id = null) {
        if (Auth::check()) {
            if ($id) {
                $article = Article::find($id);
                if ($article && $article->user_id == Auth::id() && $article->state == Article::DRAFT) {
                    $tags = '';
                    foreach ($article->tags as $value) {
                        $tags.=$value->tagDescription->name . ',';
                    }
                    return View::make('article.article_new', array('article' => $article, 'tags' => rtrim($tags, ',')));
                }
            }
            return View::make('article.article_new');
        }
        return Redirect::action('HomeController@showWelcome')
                        ->with('warning', Lang::get('common.acces_denied'));
    }

    /**
     * Slúži na vytvorenie nového článku
     * @return type
     */
    public function postNewArticle() {
        if (Request::ajax()) {
            $input = Input::all();
            if (!$article = Article::find($input['id'])) {
                $article = new Article;
            }
            $text = str_replace('\'', '', $input['text']);
            $article->title = trim($input['title']);
            $article->text = trim($text);
            $article->abstract = trim($input['abstract']);
            $article->state = Article::DRAFT;
            $article->user_id = Auth::id();
            $article->save();
            $result['id'] = $article->id;
            Tag::where('id_article', '=', $article->id)->delete();
            foreach ($input['tagy'] as $key => $value) {
                if (!$tagGroup = Tag_group::where('name', '=', strtolower(trim($value)))->first()) {
                    $tagGroup = new Tag_group;
                }
                $tagGroup->name = strtolower(trim($value));
                $tagGroup->save();
                Tag::create(array(
                    'id_tag' => $tagGroup->id,
                    'id_article' => $article->id
                ));
            }
            return Response::json($result);
        }
    }

    /**
     * Odstrani článok
     * @return type
     */
    function postDeteleArticle() {
        if (Request::ajax()) {
            $input = Input::all();
            if (!$article = Article::find($input['id'])) {
                return Response::json(array('result' => true));
            }
            Tag::where('id_article', '=', $article->id)->delete();
            Review::where('id_article', '=', $article->id)->delete();
            $article->delete();
            return Response::json(array('result' => true));
        }
    }

    /**
     * Slúži na zobrazenie všetkých konceptov od užívateľa
     * @return type
     */
    public function draft() {
        if (!Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Auth::User()->articles()->draft()->orderBy('updated_at', 'DESC')->get();
        return View::make('article.article_draft', array('articles' => $articles));
    }

    /**
     * Slúži na zobrazenie článkov, ktoré sú odoslané na recenzovanie
     * @return type
     */
    public function sent() {
        if (!Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Auth::User()->articles()
                        ->sent()
                        ->distinct()
                        ->leftJoin('reviews', 'articles.id', '=', 'reviews.id_article')
                        ->orWhere(function($q) {
                            $q->where('reviews.text', '<>', '')
                            ->where(function($q2) {
                                $q2->where('articles.state', '=', Article::UNAPROVED)
                                ->orWhere('articles.state', '=', Article::ACCEPTED);
                            });
                        })
                        ->orderBy('articles.updated_at', 'DESC')
                        ->select('articles.id')->get();
        return View::make('article.article_sent', array('articles' => $articles));
    }

    /**
     * Slúži na zobrazenie akceptovaných článkov
     * @return type
     */
    public function accepted() {
        if (!Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Auth::User()->articles()->accepted()->orderBy('updated_at', 'DESC')->get();
        return View::make('article.article_accepted', array('articles' => $articles));
    }

    /**
     * Slúži na zobrazenie neakceptovaných článkov
     * @return type
     */
    public function unapproved() {
        if (!Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Auth::User()->articles()->unaproved()->orderBy('updated_at', 'DESC')->get();
        return View::make('article.article_unapproved', array('articles' => $articles));
    }

    /**
     * Slúži na zobrazenie publikovaných článkov
     * @return type
     */
    public function published() {
        if (!Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Auth::User()->articles()->published()->orderBy('updated_at', 'DESC')->get();
        return View::make('article.article_published', array('articles' => $articles));
    }

    /**
     * Slúží na zobrazenie správy článkov
     * @return type
     */
    public function articleManagement() {
        if (!Auth::check() || (!Auth::user()->hasRank(User::ADMIN) && !Auth::user()->hasRank(User::REDACTION))) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Article::where('state', '<>', Article::PUBLISHED)->where('state', '<>', Article::DRAFT)->orderBy('updated_at', 'DESC')->get();
        return View::make('article.article_management', array('articles' => $articles));
    }

    public function forReview() {
        if (!Auth::check() || !Auth::user()->hasRank(User::REVIEWER)) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Article::
                        leftJoin('reviews', 'articles.id', '=', 'reviews.id_article')
                        ->where('reviews.text', '=', '')
                        ->where('reviews.reviewer_id', '=', Auth::id())
                        ->where('articles.state', '=', Article::SENT)
                        ->orderBy('reviews.updated_at', 'DESC')
                        ->select('articles.id')->get();
        return View::make('article.article_review', array(
                    'articles' => $articles
        ));
    }

    /**
     * Zobrazenie článku
     * @param type $id
     * @return type
     */
    public function detail($id = null) {
        if ($id == null || !$article = Article::find($id)) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.article_does_not_exist'));
        }
        if (Auth::check() && Auth::user()->hasRank(User::ADMIN)) {                                                              // admin vidi vsetko
            return View::make('article.article_detail', array('article' => $article));
        }
        /*if (Auth::check() && Auth::user()->hasRank(User::REDACTION) && ($article->state != Article::DRAFT || $article->user_id == Auth::id())) {      // red. rada vidi vsetko okrem konceptov pokial niesu ich
            return View::make('article.article_detail', array('article' => $article));
        }*/
        $review = Review::where('id_article', '=', $id)->first();
        if ($article->state <> Article::PUBLISHED && Auth::check() && $article->user_id <> Auth::id()) {   // prihlaseny vidi iba svoje aj nepublikovane
            if ($review && (Auth::id() != $review->reviewer_id)) {                          // ak je recenzent toho clanku tak vidi tiez
                return Redirect::action('HomeController@showWelcome')
                                ->with('warning', Lang::get('common.acces_denied'));
            }
            if ($review && Auth::id() == $review->reviewer_id && ($article->state == Article::ACCEPTED || $article->state == Article::UNAPROVED)) {
                return Redirect::action('HomeController@showWelcome')
                                ->with('warning', Lang::get('common.acces_denied'));
            }
            if (!$review) {                          // ak neni recenzia ziadna tak nevidno pre 1. podmienku
                return Redirect::action('HomeController@showWelcome')
                                ->with('warning', Lang::get('common.acces_denied'));
            }
        }
        if ($article->state <> Article::PUBLISHED && !Auth::check()) {   // neprihlaseny vidi iba publikovane
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        try {
            $articleIds = [];
            $articles = [];
            foreach (Tag::whereIn('id_tag', $article->tags()->select('id_tag')->get()->toArray())->get() as $tag) {
                if ($tag->articles->state == Article::PUBLISHED && !in_array($tag->id_article, $articleIds) && $tag->id_article != $id) {
                    $articleIds[] = $tag->id_article;
                    $articles[] = $tag->articles;
                }
            }
        } catch (Exception $e) {
            
        }
        return View::make('article.article_detail', array(
                    'article' => $article,
                    'articles' => $articles
        ));
    }

    function changeState() { {
            if (Request::ajax()) {
                $input = Input::all();
                if (!$article = Article::find($input['id'])) {
                    return Response::json(array(
                                'result' => true
                    ));
                }
                $article->state = $input['state'];
                $article->save();
                if ($input['state'] == Article::SENT && $review = $article->review) {
                    $review->delete();
                }
                if ($input['state'] == Article::PUBLISHED) {
                    // POSLI MALIS AUTOROVI
                }
                return Response::json(array(
                            'result' => true
                ));
            }
        }
    }

}
