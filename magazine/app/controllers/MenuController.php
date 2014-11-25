<?php

/**
 * Controller, ktorý obsluhuje menu
 */
class MenuController extends Controller {

    /**
     * Zobrazí sekciu o nás
     * @return type
     */
    public function getOnas() {
        return View::make('onas');
    }

    /**
     * Zobrazí sekciu kontakt
     * @return type
     */
    public function getKontakt() {
        return View::make('kontakt');
    }

    /**
     * Zobrazí sekciu profil
     * @param type $id
     * @return type
     */
    public function getProfile($id = null) {
        if ($id == null || !$user = User::find($id)) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.user_does_not_exist'));
        }
        $canEdit = Auth::id() == $user->id;
        $articles = Article::published()->where('user_id', '=', $user->id)->get();
        return View::make('profile.profile', array('user' => $user, 'canEdit' => $canEdit, 'articles' => $articles));
    }

}
