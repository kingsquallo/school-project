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

Route::get('test', function () {
    return view('auth.passwords.reset');
});

Auth::routes();
Route::get('/logout','Auth\LoginController@userLogout')->name('user.logout');

//Home
Route::get('/', 'HomeController@index')->name('home');
//Blog
Route::get('/blogs','HomeController@getBlogs')->name('blogs.index');
Route::get('/blogs/{blog}','HomeController@showBlog')->name('blogs.show');

//Contact
Route::get('/contact','HomeController@getContact')->name('contacts.get');
Route::post('/contact','HomeController@postContact')->name('contacts.post');

//Search
Route::get('/search', 'SearchController@getSearch')->name('getSearch');
Route::post('/search', 'SearchController@postSearch')->name('postSearch');


//Post
Route::resource('/posts', 'PostController')->except('show');
Route::get('/posts/favorite-list','PostController@getFavoritePosts')->name('posts.favorite-list');
Route::get('/posts/{post}','PostController@show')->name('posts.show');

//Favorite
Route::post('/posts/favorite','FavoriteController')->name('posts.favorite');

Route::group(['prefix' => 'profile','middleware'=>'auth'], function () {
    Route::get('/', 'ProfileController@index')->name('profile.index');
    Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
    Route::post('/update', 'ProfileController@update')->name('profile.update');
    Route::get('/change-pass', 'ProfileController@getChangePass')->name('profile.change-pass');
    Route::post('/change-pass', 'ProfileController@postChangePass')->name('profile.post-change-pass');
});

//Ajax
Route::group(['prefix' => 'ajax','as'=>'ajax.'], function () {
    Route::post('/upload-image','AjaxController@uploadImage')->name('upload-image');
    Route::get('/delete-image','AjaxController@deleteImage')->name('delete-image');
    Route::get('/districts','AjaxController@getDistricts')->name('districts');
    Route::get('/cities', 'AjaxController@getCities')->name('cities');
    Route::get('/post-type','AjaxController@getPostType')->name('post-type');
    Route::get('/load-notifications', 'AjaxController@getNotification')->name('notifications');
    Route::post('/report-post', 'AjaxController@reportPost')->name('report-post');
    Route::get('/publish-post/{id}', 'AjaxController@publishPost')->name('publish-post');
});
