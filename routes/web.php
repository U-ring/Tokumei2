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
  Route::get('profile/edit','User\ProfileController@edit')->middleware('auth');
  Route::get('profile/add','User\ProfileController@add')->middleware('auth');
  Route::get('profile/home','User\ProfileController@home')->middleware('auth');
  Route::get('profile/talk','User\ProfileController@talk')->middleware('auth');
  Route::get('group/talk','User\GroupController@talk')->middleware('auth');
  Route::get('group/edit','User\GroupController@edit')->middleware('auth');
  Route::get('community/talk','User\CommunityController@talk')->middleware('auth');
  Route::get('user/talk','User\UserController@talk')->middleware('auth');
  Route::get('user/edit','User\UserController@edit')->middleware('auth');
  Route::get('user/TermsOfService','User\UserController@TermsOfService')->middleware('auth');
});

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/login/{social}', 'Auth\OAuthLoginController@socialLogin');
Route::get('/login/{social}/callback', 'Auth\OAuthLoginController@handleProviderCallback');

Route::get('/login/{social}', 'Auth\OAuthLoginController@socialLogin');
Route::get('/login/{social}/callback', 'Auth\OAuthLoginController@handleProviderCallback');

Auth::routes();
