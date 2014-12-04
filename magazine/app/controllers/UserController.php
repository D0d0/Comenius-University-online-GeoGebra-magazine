<?php

/**
 * Description of UserController
 *
 * @author Jozef
 */
class UserController extends BaseController {

    public function getManagement() {
        if (!Auth::user()->hasRank(User::ADMIN) && !Auth::user()->hasRank(User::REDACTION)) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        return View::make('user_management');
    }

    public function postChangeRank() {

        if (Request::ajax()) {
            $input = Input::all();
            if (!$user = User::find($input['user_id'])) {
                return Response::json(array(
                            'result' => false
                ));
            }
            if ($role = UserRole::where('user_id', '=', $input['user_id'])->where('rank_id', '=', $input['rank'])) {
                $role->delete();
            }
            if ($input['active'] == 'true') {
                UserRole::create(array(
                    'user_id' => $input['user_id'],
                    'rank_id' => $input['rank'],
                ));
            }
            return Response::json(array(
                        'result' => true
            ));
        }
        return Response::json(array(
                    'result' => false
        ));
    }

    public function postChangeBan() {
        if (Request::ajax()) {
            $input = Input::all();
            if (!$user = User::find($input['user_id'])) {
                return Response::json(array(
                            'result' => false
                ));
            }
            $user->ban = $input['state'];
            $user->save();
            return Response::json(array(
                        'result' => true
            ));
        }
        return Response::json(array(
                    'result' => false
        ));
    }

}
