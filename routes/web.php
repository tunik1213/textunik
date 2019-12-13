<?php

Route::get('/test', 'TestController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/article/edit/{id?}', 'ArticleController@editForm')->name('article.edit');
    Route::post('/article/edit/{id}', 'ArticleController@editPost')->name('article.post');
    Route::post('/upload', 'ArticleController@uploadImage');
    Route::post('/comments/add','CommentsController@addComment');

    Route::post('/home', 'HomeController@updateUser');
    Route::get('/user/getAvatarImage', 'HomeController@getAvatarImage');

    Route::group(['middleware' => 'moderator'], function () {
        Route::get('/moderation/', 'ArticleController@moderation');
        Route::get('/moderation/{id}', 'ArticleController@moderation');
    });
});

Route::get('/', 'ArticleController@feed');
Route::get('/article/{id}', 'ArticleController@viewPost');
Route::get('/images/{articleId}/{imgId}','ArticleController@getImage');

Route::get('/comments/getByParent/{parentId}','CommentsController@getByParent');

Route::get('/user/getMiniAvatarImage/{userId?}', 'HomeController@getMiniAvatarImage');
Route::get('/profile/{userId}', 'HomeController@profile')->name('profile');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/login_form', 'AccessController@loginForm')->middleware('guest');

Route::get('sitemap.xml', 'ExportController@sitemap');
Route::get('convertAllImages', 'ServiceController@convertAllImages');

Route::get('/about', function () {
    return view('staticPages.about');
});

Route::get('/social-auth/{provider}', 'Auth\SocialController@redirectToProvider')->name('auth.social');
Route::get('/social-auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback')->name('auth.social.callback');