<?php

Route::group(['middleware' => 'auth'], function () {

    Route::get('/article/edit/{id?}', 'ArticleController@editForm')->name('article.edit');
    Route::post('/article/edit/{id}', 'ArticleController@editPost')->name('article.post');
    Route::post('/upload', 'ArticleController@uploadImage');
    Route::post('/comments/add','CommentsController@addComment');
    Route::post('/comments/edit/{id}','CommentsController@editComment');

    Route::post('/home', 'HomeController@updateUser');

    Route::group(['middleware' => 'moderator'], function () {
        Route::get('/api/generateSlug/{text}',function(string $text){
            return str_replace('\'','',Str::slug($text));
        });

        Route::get('/admin','AdminController@index');
        Route::get('/admin/users','AdminController@users');
    });
});

Route::get('/article/howto', function () {
    return view('staticPages.article_howto');
})->name('article.howto');

Route::get('/', 'ArticleController@feed');
Route::get('/article/{id}', 'ArticleController@viewPost');
Route::get('/images/{articleId}/{imgId}','ArticleController@getImage');

Route::get('/comments/getByParent/{parentId}','CommentsController@getByParent');

Route::get('/user/getAvatarImage/{userId?}', 'HomeController@getAvatarImage')->name('avatarImage');
Route::get('/user/getMiniAvatarImage/{userId?}', 'HomeController@getMiniAvatarImage')->name('miniAvatarImage');
Route::get('/profile/{userId}', 'HomeController@profile')->name('profile');
Route::get('/profile/getPreview/{userId}', 'HomeController@profilePreview')->name('profilePreview');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/login_form', 'AccessController@loginForm')->middleware('guest');
Route::get('/error_report_form', function() {
    return view('ajaxForms.errorReport');
});
Route::get('/register/confirm/{id}/{token}','Auth\VerificationController@confirmEmail')->name('confirmEmail');
Route::post('/sendErrorReport', 'MailController@errorReport');

Route::get('sitemap.xml', 'ExportController@sitemap');

Route::group(['middleware' => 'superAdmin'], function () {
    Route::get('/test', 'TestController@index');
    Route::get('convertAllImages', 'ServiceController@convertAllImages');
    Route::get('editAllArticles', 'ServiceController@editAllArticles');
});

Route::get('/about', function () {
    return view('staticPages.about');
});
Route::get('/privacy', function() {
    return view('staticPages.privacy');
});

Route::get('/social-auth/{provider}', 'Auth\SocialController@redirectToProvider')->name('auth.social');
Route::get('/social-auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback')->name('auth.social.callback');

// Email related routes
Route::get('mail/dailyReport', 'MailController@dailyReport')->middleware('localhostOnly');
Route::get('/unsubscribe/articleComments/{userId}/{userToken}', 'MailController@unsubscribeArticleComments')->name('unsubscribeArticleComments');
Route::get('/unsubscribe/articleNotifications/{userId}/{userToken}', 'MailController@unsubscribeArticleNotifications')->name('unsubscribeArticleNotifications');

// Static pages
Route::get('/landing', function () {
    return view('staticPages.landing');
})->name('landing');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
