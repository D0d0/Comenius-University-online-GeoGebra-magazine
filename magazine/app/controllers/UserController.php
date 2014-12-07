<?php

/**
 * Description of UserController
 *
 * @author Jozef
 */
class UserController extends BaseController {

    public function getManagement() {
        if (!Auth::check() || (!Auth::user()->hasRank(User::ADMIN) && !Auth::user()->hasRank(User::REDACTION))) {
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

    public function updateProfile() {
        if (Request::ajax()) {
            $input = Input::all();
            $rules = array(
                'date' => 'required|date_format:"d.m.Y"',
                'city' => 'required|min:6',
                'school' => 'required|min:6',
            );
            if (Auth::user()->email != $input['email']) {
                $rules['email'] = 'required|email|unique:users,email';
            }
            $validator = Validator::make($input, $rules);
            if ($validator->passes()) {
                $user = Auth::user();
                $user->email = $input['email'];
                $user->city = $input['city'];
                $user->school = $input['school'];
                $user->birth = $input['date'];
                $user->save();
                return Response::json(array(
                            'result' => true
                ));
            }
            return Response::json($validator->messages());
        }
        return Response::json(array(
                    'result' => false
        ));
    }

}
