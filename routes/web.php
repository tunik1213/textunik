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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/test', 'TestController@index');

Route::get('/', 'FeedController@index');

Route::get('/article/add', 'ArticleController@addForm')->middleware('auth');
Route::post('/article/add', 'ArticleController@addPost')->middleware('auth');
Route::get('/article/{id}', 'ArticleController@viewPost');
Route::get('/moderation/', 'ArticleController@moderation')->middleware('auth')->middleware('moderator');
Route::get('/moderation/{id}', 'ArticleController@moderation')->middleware('auth')->middleware('moderator');
Route::post('/upload', 'ArticleController@uploadImage')->middleware('auth');

Route::get('/comments/getByParent/{parentId}','CommentsController@getByParent');
Route::post('/comments/add','CommentsController@addComment')->middleware('auth');

Route::post('/home', 'HomeController@updateUser')->middleware('auth');
Route::get('/user/getAvatarImage', 'HomeController@getAvatarImage')->middleware('auth');
Route::get('/user/getMiniAvatarImage/{userId?}', 'HomeController@getMiniAvatarImage');

Route::get('/forbidden', 'AccessController@forbiddenPage');

Route::get('/profile/{userId}', 'HomeController@profile');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login_form', 'AccessController@loginForm')->middleware('guest');

Route::get('/images/{articleId}/{imgId}','ArticleController@getImage');
