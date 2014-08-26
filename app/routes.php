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

//Ruta principal redirecciona a login
Route::get('/', function() {
    return Redirect::to('session/create');
});

Route::resource('home', 'HomeController',
                array('only' => array('index')));

//Restful Routes for session controller
Route::resource('session', 'SessionController', array('only' => array('create', 'store', 'destroy')));

//Restful Routes for user controller
Route::resource('user', 'UserController');
