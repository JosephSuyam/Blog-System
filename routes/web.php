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

Route::get('/', 'CreatedControllers\Fun@viewAllBlogs'); // view allowed blogs on welcome

Route::get('users/home', 'CreatedControllers\Fun@viewUserBlogs'); // view users blogs on users/home

Route::get('/openblog/{id}', 'CreatedControllers\Fun@openBlogs'); // open blog on welcome

Route::get('/openblog/{id}', 'CreatedControllers\Fun@openBlogs'); // open blog on welcome

Route::post('/openblog/{blog_id}/comment', 'CreatedControllers\Fun@comment');
