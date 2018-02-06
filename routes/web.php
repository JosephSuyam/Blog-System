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


Route::get('auth/social', 'Auth\SocialAuthController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\SocialAuthController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.callback');
// logout kanu
Route::get('users/logout', function(){
	Auth::logout();
	return Redirect::to('/');
});
Route::get('users/home', function(){
	return view('users/home');
});

Route::get('/', 'CreatedControllers\BlogController@viewAllBlogs'); // view allowed blogs on welcome

Route::get('users/home', 'CreatedControllers\BlogController@viewUserBlogs'); // view users blogs on users/home.blade

Route::get('/openblog/{id}', 'CreatedControllers\BlogController@openBlogs'); // open blog on welcome

Route::get('users/addblog', 'CreatedControllers\BlogController@viewCreatedBlogs'); // view users blogs on users/addblog.blade

Route::get('users/home/{blog_id}', 'CreatedControllers\BlogController@viewSelectedBlog'); // view users blogs on users/home/{blog_id}



Route::post('/openblog/{blog_id}/comment', 'CreatedControllers\Fun@comment'); // comment on users/openblog.blade

Route::post('users/home/{blog_id}/addBlog', 'CreatedControllers\Fun@home'); // form in users/home.blade

Route::post('users/addblog/new', 'CreatedControllers\BlogController@addBlog'); // form in users/home.blade
