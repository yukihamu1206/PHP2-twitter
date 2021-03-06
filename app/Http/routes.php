<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','WelcomeController@index');

Route::get('signup','Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup','Auth\AuthController@postRegister')->name('signup.post');

Route::get('login','Auth\AuthController@getLogin')->name('login.get');
Route::post('login','Auth\AuthController@postlogin')->name('login.post');
Route::get('logout','Auth\AuthController@getLogout')->name('logout.get');
// ルーティングのグループを作って['middleware' => 'auth']でログイン認証確認
Route::group(['middleware' => 'auth'], function(){
   Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
     Route::group(['prefix' => 'users/{id}'], function () { 
        Route::post('follow','UserFollowController@store')->name('user.follow');
        Route::delete('unfllow','UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings','UsersController@followings')->name('users.followings');
        Route::get('followers','UsersController@followers')->name('users.followers');
    });
    
    Route::resource('twitters','TwittersController',['only' => ['store','destroy']]);
});
