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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'user'], function(){
  Route::get('profile/login','User\ProfileController@login');
  Route::get('profile/edit','User\ProfileController@edit')->middleware('auth');
  Route::get('profile/add','User\ProfileController@add')->middleware('auth');
  Route::get('home/guest','User\HomeController@guest')->middleware('auth');
  Route::get('home/twitter','User\HomeController@twitter')->middleware('auth');
  Route::get('home/facebook','User\HomeController@facebook')->middleware('auth');
  Route::get('home/talk','User\HomeController@talk')->middleware('auth');
  Route::get('group/create','User\GroupController@add')->middleware('auth');
  Route::post('group/create','User\GroupController@create')->middleware('auth');
  Route::get('group/talk','User\GroupController@talk')->middleware('auth');
  Route::get('group/edit','User\GroupController@edit')->middleware('auth');
  Route::get('community/talk','User\CommunityController@talk')->middleware('auth');
  Route::get('user/talk','User\UserController@talk')->middleware('auth');
  Route::get('user/edit','User\UserController@edit')->middleware('auth');
  Route::get('user/TermsOfService','User\UserController@TermsOfService')->middleware('auth');
});

Route::group(['prefix' => 'user/home/{id}'], function () {
    Route::get('followings', 'User\HomeController@followings')->name('followings');
    Route::get('followers', 'User\HomeController@followers')->name('followers');
    });
    
Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('unfollow');
    });

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/login/{social}', 'Auth\OAuthLoginController@socialLogin');
Route::get('/login/{social}/callback', 'Auth\OAuthLoginController@handleProviderCallback');

Route::get('/login/{social}', 'Auth\OAuthLoginController@socialLogin');
Route::get('user/follow','Auth\OAuthLoginController@getFollowList');
Route::get('user/follow','Auth\OAuthLoginController@getFollowList');
Route::get('user/twitter','Auth\OAuthLoginController@twitter');

Route::get('/login/{social}/callback', 'Auth\OAuthLoginController@handleProviderCallback');

Auth::routes();
Route::get('/','HomeController@index')->middleware('auth');//←ようこそ、のページ
Route::get('/home','HomeController@index');

