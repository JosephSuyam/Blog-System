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
Route::get('users/logout', function(){  // logout kanu
	Auth::logout();
	return Redirect::to('/');
});

// Auth::routes();

Route::get('login', function(){
	return Redirect::to('/')->with('message', 'You must login before you can access the site!');
})->name('login');


Route::get('/', 'CreatedControllers\IndexController@viewAllBlogs'); // view allowed blogs on welcome

Route::get('users/home', 'CreatedControllers\BlogController@viewUserBlogs'); // view users blogs on users/home.blade

Route::get('/openblog/{id}', 'CreatedControllers\IndexController@openBlogs'); // open blog on welcome

Route::get('users/addblog', 'CreatedControllers\BlogController@viewCreatedBlogs'); // view users blogs on users/addblog.blade

Route::get('users/home/{blog_id}', 'CreatedControllers\BlogController@viewSelectedBlog'); // view users blogs on users/home/{blog_id}

Route::get('/admin/admin', 'CreatedControllers\UserController@author')->middleware('checkAdmin'); // admin/admin.blade

Route::get('/admin/blog', 'CreatedControllers\BlogController@selectBlog')->middleware('checkAdmin'); // admin/blog.blade

Route::get('/admin/comment', 'CreatedControllers\CommentController@selectComment')->middleware('checkAdmin'); // admin/comment.blade



Route::post('/openblog/{blog_id}/comment', 'CreatedControllers\IndexController@comment'); // comment on users/openblog.blade

Route::post('users/home/{blog_id}/addBlog', 'CreatedControllers\Fun@home'); // form in users/home.blade

Route::post('users/addblog/new', 'CreatedControllers\BlogController@addBlog'); // form in users/home.blade

Route::post('admin/admin/panel', 'CreatedControllers\Fun@new'); // buttons in admin/admin.blade

Route::post('admin/admin/{id}/user', 'CreatedControllers\UserController@accessUser');	// enable/disable on admin/blog

Route::post('admin/admin/{blog_id}/blog', 'CreatedControllers\BlogController@blogControl');	// 	publish/unpublish on admin/blog

Route::post('admin/admin/{comment_id}/comment', 'CreatedControllers\CommentController@commentControl');	// delete comments on admin/comments
