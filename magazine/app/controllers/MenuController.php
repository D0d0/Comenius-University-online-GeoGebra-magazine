<?php

class MenuController extends Controller {

    public function getOnas() {
        return View::make('onas');
    }

    public function getKontakt() {
        return View::make('kontakt');
    }

    public function getProfile($id = null) {
        if ($id == null || !$user = User::find($id)) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.user_does_not_exist'));
        }
        $canEdit = Auth::id() == $user->id;
        $articles = Article::where('user_id', '=', $user->id)->where('state', '=', 5)->get();
        return View::make('profile.profile', array('user' => $user, 'canEdit' => $canEdit, 'articles' => $articles));
    }

}
