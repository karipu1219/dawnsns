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
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('post/create','PostsController@create');
Route::post('/post/{id}/update-form','PostsController@updateform');
Route::get('/post/{id}/delete','PostsController@delete');


Route::get('/profile','UsersController@profile');
Route::post('profile/form','UsersController@form');
Route::get('/{follower}/profile','UsersController@followerprofile');

Route::get('/search','UsersController@search');
Route::post('search/index','UsersController@index');
Route::get('/result','UsersController@result');


Route::get('/follow-list','PostsController@followlist');
Route::get('/follower-list','PostsController@followerlist');

Route::get('/logout','Auth\LoginController@logout');

Route::get('/post/{follow}/follow','FollowsController@follow');
Route::get('/post/{follow}/follow-delete','FollowsController@delete');

