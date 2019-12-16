<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'user'], function(){
  Route::get('profile/login','User\ProfileController@login');
  Route::get('profile/edit','User\ProfileController@edit');
  Route::get('profile/add','User\ProfileController@add');
  Route::get('profile/home','User\ProfileController@home');
  Route::get('profile/talk','User\ProfileController@talk');
  Route::get('group/talk','User\GroupController@talk');
  Route::get('group/edit','User\GroupController@edit');
  Route::get('community/talk','User\CommunityController@talk');
  Route::get('user/talk','User\UserController@talk');
  Route::get('user/edit','User\UserController@edit');
  
});
