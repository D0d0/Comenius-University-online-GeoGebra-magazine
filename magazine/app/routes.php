<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
Route::get('/', 'HomeController@showWelcome');
Route::post('/', 'HomeController@showWelcome');
Route::get('/find/{id?}', 'HomeController@findTag');
Route::get('/search/{query?}', 'HomeController@search');
Route::get('/tags/{query?}', 'HomeController@tags');

Route::get('/register', 'RegistrationController@getRegister');
Route::post('/register', 'RegistrationController@postRegister');
Route::get('/verify/{confirmationCode?}', 'RegistrationController@confirm');

Route::get('/login', 'LoginController@getLogin');
Route::post('/login', 'LoginController@postLogin');
Route::get('/logout', 'LoginController@getLogout');

Route::get('/remind', 'RemindersController@getRemind');
Route::post('/remind', 'RemindersController@postRemind');
Route::get('/reset/{token?}', 'RemindersController@getReset');
Route::post('/reset/{token?}', 'RemindersController@postReset');

Route::get('/onas', 'MenuController@getOnas');
Route::get('/kontakt', 'MenuController@getKontakt');
Route::get('/profile/{id?}', 'MenuController@getProfile');

Route::group(array('prefix' => 'user'), function() {
    Route::get('/management', 'UserController@getManagement');
    Route::post('/changeBan', 'UserController@postChangeBan');
    Route::post('/changeRank', 'UserController@postChangeRank');
    Route::post('/update', 'UserController@updateProfile');
});

Route::group(array('prefix' => 'article'), function() {
    Route::get('/new/{id?}', 'ArticleController@newArticle');
    Route::post('/new', 'ArticleController@postNewArticle');

    Route::post('/delete', 'ArticleController@postDeteleArticle');
    Route::post('/changestate', 'ArticleController@changeState');

    Route::get('/draft', 'ArticleController@draft');

    Route::get('/sent', 'ArticleController@sent');

    Route::get('/accepted', 'ArticleController@accepted');

    Route::get('/unapproved', 'ArticleController@unapproved');

    Route::get('/published', 'ArticleController@published');

    Route::get('/reviews', 'ArticleController@forReview');
    
    Route::get('/article_management', 'ArticleController@articleManagement');

    Route::get('/detail/{id?}', 'ArticleController@detail');

    Route::post('/review/create', 'ReviewController@postCreateReview');
    Route::post('/review/add', 'ReviewController@postAddReview');
});
