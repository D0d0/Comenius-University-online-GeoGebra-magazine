<?php

class LoginController extends Controller {

    public function getLogout() {
        if (Auth::check()) {
            Auth::logout();
            return Redirect::action('HomeController@showWelcome')
                            ->with('message', Lang::get('common.logout_successful'));
        }
        return Redirect::action('HomeController@showWelcome')
                        ->with('warning', Lang::get('common.acces_denied'));
    }

    public function getLogin() {
        if (Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        return View::make('login');
    }

    public function postLogin() {
        if (Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $input = Input::only(
                        'email', 'password'
        );
        $rules = array(
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator)
                            ->withInput(Input::except('password'));
        }
        if (Auth::attempt(array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'confirmed' => 1), Input::get('remember'))) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('message', Lang::get('common.login_successful'));
        }
        return Redirect::back()
                        ->withInput(Input::except('password'));
    }

}
