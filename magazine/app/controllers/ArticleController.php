<?php

class ArticleController extends BaseController {

    public function newArticle($id = null) {
        //WTF
        if ($id) {
            $article = Article::find($id);
            if ($article->user_id == Auth::id() && $article->state == 1) {
                return View::make('article.article_new', array('article' => $article));
            }
        }
        return View::make('article.article_new');
    }

    public function postNewArticle() {
        if (Request::ajax()) {
            $input = Input::all();
            if (!$article = Article::find($input['id'])) {
                $article = new Article;
            }
            $article->title = trim($input['title']);
            $article->text = trim($input['text']);
            $article->abstract = trim($input['abstract']);
            $article->state = 1;
            $article->user_id = Auth::id();
            $article->save();
            $result['id'] = $article->id;
            Tag::where('id_article', '=', $article->id)->delete();
            foreach ($input['tagy'] as $key => $value) {
                if (!$tagGroup = Tag_group::where('name', '=', $value)->first()) {
                    $tagGroup = new Tag_group;
                }
                $tagGroup->name = trim($value);
                $tagGroup->count = 0;
                $tagGroup->save();
                Tag::create(array(
                    'id_tag' => $tagGroup->id,
                    'id_article' => $article->id
                ));
            }
            return Response::json($result);
        }
    }

    public function draft() {
        $articles = Article::draft()->orderBy('id', 'DESC')->where('user_id', '=', Auth::id())->get();
        return View::make('article.article_draft', array('articles' => $articles));
    }

    public function sent() {
        $articles = Article::sent()->orderBy('id', 'DESC')->where('user_id', '=', Auth::id())->get();
        return View::make('article.article_sent', array('articles' => $articles));
    }

    public function accepted() {
        $articles = Article::accepted()->where('user_id', '=', Auth::id())->get();
        return View::make('article.article_accepted', array('articles' => $articles));
    }

    public function unapproved() {
        $articles = Article::unaproved()->where('user_id', '=', Auth::id())->get();
        return View::make('article.article_unapproved', array('articles' => $articles));
    }

    public function articleManagement() {
        $articles = Article::sent()->orderBy('id', 'DESC')->get();
        return View::make('article.article_management', array('articles' => $articles));
    }

    public function detail($id = null) {
        if ($id == null || !$article = Article::find($id)) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.article_does_not_exist'));
        }
        $user = User::find(Auth::id());
        if (Auth::check() && $user->rank == 1){                                                              // admin vidi vsetko
            return View::make('article.article_detail', array('article' => $article));
        }
        if (Auth::check() && $user->rank == 2 && ($article->state != 1 || $article->user_id == Auth::id())){      // red. rada vidi vsetko okrem konceptov pokial niesu ich
            return View::make('article.article_detail', array('article' => $article));
        }
        $review = Review::where('id_article', '=', $id)->first();
        if ($article->state <> 5 && Auth::check() && $article->user_id <> Auth::id()) {   // prihlaseny vidi iba svoje aj nepublikovane
            if ($review && (Auth::id() != $review->reviewer_id)) {                          // ak je recenzent toho clanku tak vidi tiez
                return Redirect::action('HomeController@showWelcome')
                                ->with('warning', Lang::get('common.article_no_access'));
            }
            if (!$review) {                          // ak neni recenzia ziadna tak nevidno pre 1. podmienku
                return Redirect::action('HomeController@showWelcome')
                                ->with('warning', Lang::get('common.article_no_access'));
            }
        }
        if ($article->state <> 5 && !Auth::check()) {   // neprihlaseny vidi iba publikovane
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.article_no_access'));
        }
        return View::make('article.article_detail', array('article' => $article));
    }

}
