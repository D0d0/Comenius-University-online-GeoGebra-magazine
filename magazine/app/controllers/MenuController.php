<?php

/**
 * Controller, ktorý obsluhuje menu
 */
class MenuController extends BaseController {

    /**
     * Zobrazí sekciu o nás
     * @return type
     */
    public function getOnas() {
        $users = User::ordered()->notBanned()->get();
        $admin = [];
        $redaction =[];
        $reviewers = [];
        foreach ($users as $user){
            if($user->hasRank(User::ADMIN)){
                $admin[] = $user;
                continue;
            }
            if($user->hasRank(User::REDACTION)){
                $redaction[] = $user;
                continue;
            }
            if($user->hasRank(User::REVIEWER)){
                $reviewers[] = $user;
                continue;
            }
        }
        return View::make('onas', array(
                    'admin' => $admin,
                    'redaction' => $redaction,
                    'reviewers' => $reviewers,
        ));
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
