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
                if ($article->user_id == Auth::id() && $article->state == Article::DRAFT) {
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
            Tag::where('id_article', '=', $input['id'])->delete();
            Article::find($input['id'])->delete();
            Review::where('id_article', '=', $input['id'])->delete();
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
        $articles = Article::draft()->orderBy('id', 'DESC')->where('user_id', '=', Auth::id())->get();
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
        $articles = Article::sent()->orderBy('id', 'DESC')->where('user_id', '=', Auth::id())->get();
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
        $articles = Article::accepted()->where('user_id', '=', Auth::id())->get();
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
        $articles = Article::unaproved()->where('user_id', '=', Auth::id())->get();
        return View::make('article.article_unapproved', array('articles' => $articles));
    }

    /**
     * Slúží na zobrazenie správy článkov
     * @return type
     */
    public function articleManagement() {
        if (!Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $articles = Article::sent()->orderBy('id', 'DESC')->get();
        return View::make('article.article_management', array('articles' => $articles));
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
        /* if (Auth::check() && Auth::user()->hasRank(User::ADMIN)) {                                                              // admin vidi vsetko
          return View::make('article.article_detail', array('article' => $article));
          }
          if (Auth::check() && Auth::user()->hasRank(User::REDACTION) && ($article->state != Article::DRAFT || $article->user_id == Auth::id())) {      // red. rada vidi vsetko okrem konceptov pokial niesu ich
          return View::make('article.article_detail', array('article' => $article));
          } */
        $review = Review::where('id_article', '=', $id)->first();
        if ($article->state <> Article::PUBLISHED && Auth::check() && $article->user_id <> Auth::id()) {   // prihlaseny vidi iba svoje aj nepublikovane
            if ($review && (Auth::id() != $review->reviewer_id)) {                          // ak je recenzent toho clanku tak vidi tiez
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
        $tags = $article->tags()->get();
        $tagIds = [];
        foreach ($tags as $tag) {
            $tagIds[] = $tag->id_tag;
        }
        try {
            $articleIds = [];
            $articles = [];
            foreach (Tag::whereIn('id_tag', $tagIds)->get() as $tag) {
                if ($tag->articles->state == Article::PUBLISHED && !in_array($tag->id_article, $articleIds) && $tag->id_article != $id) {
                    $articleIds[] = $tag->article_id;
                    $articles[] = $tag->articles;
                }
            }
        } catch (Exception $e) {
            
        }
        return View::make('article.article_detail', array('article' => $article, 'articles' => $articles));
    }
    
    function sendArticle($id = null){
        
    }

}
