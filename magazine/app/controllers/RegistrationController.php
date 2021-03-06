<?php

/**
 * Controller na registráciu užívateľa
 */
class RegistrationController extends BaseController {

    /**
     * Zobrazí registračný formulár
     * @return type
     */
    public function getRegister() {
        if (Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        return View::make('register');
    }

    /**
     * Pokúsi sa zaregistrovať užívateľa
     * @return type
     */
    public function postRegister() {
        if (Auth::check()) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }
        $input = Input::only(
                        'name', 'password', 'password_confirmation', 'email', 'school'
        );
        $rules = array(
            'name' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'email' => 'required|email|unique:users,email',
            'school' => 'required|min:1'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator)
                            ->withInput();
        }
        $confirmation_code = str_random(30);

        $id = User::create(array(
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'password' => Hash::make(Input::get('password')),
                    'rank' => User::USER,
                    'school' => Input::get('school'),
                    'confirmation_code' => $confirmation_code
                ))->id;

        UserRole::create(array(
            'user_id' => $id,
            'rank_id' => User::USER
        ));

        Mail::send('emails.auth.verify', array('confirmation_code' => $confirmation_code), function($message) {
            $message->to(Input::get('email'), Input::get('name'))
                    ->subject(Lang::get('emails.verify_email'));
        });
        return Redirect::action('HomeController@showWelcome')
                        ->with('message', Lang::get('common.thank_for_sign'));
    }

    /**
     * Potvrdí registráciu užívateľa
     * @param type $confirmation_code
     * @return type
     * @throws InvalidConfirmationCodeException
     */
    public function confirm($confirmation_code = null) {
        if (Auth::check() || !$confirmation_code) {
            return Redirect::action('HomeController@showWelcome')
                            ->with('warning', Lang::get('common.acces_denied'));
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if (!$user) {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        return Redirect::action('HomeController@showWelcome')
                        ->with('message', Lang::get('common.email_verified'));
    }

}
