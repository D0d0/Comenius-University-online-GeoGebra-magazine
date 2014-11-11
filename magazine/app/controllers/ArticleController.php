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
        return View::make('article.article_management');
    }

    public function detail($id = null) {
        //TODO LEN PUBLIKOVANE
        //ALEBO LEN JEHO S RECENZIOU
        if ($id == null || !$article = Article::find($id)) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.article_does_not_exist'));
        }
        return View::make('article.article_detail', array('article' => $article));
    }

}
