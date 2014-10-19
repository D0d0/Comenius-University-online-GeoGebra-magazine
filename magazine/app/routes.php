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

Route::get('/', function() {
    /*
      if (DB::connection()->getDatabaseName()) {
      echo "ak sa zobrazilo toto, tak je db správne pripojena " . DB::connection()->getDatabaseName();
      } else {
      echo "ak sa zobrazilo toto, tak db nie je správne pripojena alebo nakonfigurovana";
      }
     */
    return View::make('index', array('max' => 3));
});

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