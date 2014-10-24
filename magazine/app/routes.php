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

Route::get('/onas', function() {
    return View::make('onas');
});

Route::get('/kontakt', function() {
    return View::make('kontakt');
});

Route::get('/user/{id}', function($id) {
    $user = User::find($id);
    return View::make('user', array('user' => $user));
});

Route::get('/user', function() {
    return View::make('user');
});

Route::get('/article/new', function() {
    return View::make('article.article_new');
});

Route::get('/article/draft', function() {
    return View::make('article.article_draft');
});

Route::get('/article/accepted', function() {
    return View::make('article.article_accepted');
});

Route::get('/article/unapproved', function() {
    return View::make('article.article_unapproved');
});
Route::get('/article/detail', function() {
    return View::make('article.article_detail');
});

Route::get('/article/article_management', function(){
   return View::make('article.article_management'); 
});

Route::get('/profile', function(){
   return View::make('profile.profile'); 
});