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
    return redirect('login');
});


// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){
  // Password Reset Routes...
  Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
  Route::post('password/reset', 'ResetPasswordController@reset');
});

//static pages
Route::get('about', function () {
    return view('pages.about');
  })->name('about');

Route::get('faqs', function () {
    return view('pages.faqs');
  })->name('faqs');


//Profile
Route::get('profile', 'ProfileController@show')->name('myProfile');
Route::get('profile/edit', 'ProfileController@showEdit');
Route::post('profile/edit', 'ProfileController@update');
Route::get('profile/{id_user}', 'ProfileController@showUser');
Route::post('profile/remove', 'ProfileController@remove');
Route::put('api/profile/{id_user}/follow','ProfileController@followUser');
Route::delete('api/profile/{id_user}/follow','ProfileController@unfollowUser');

//Event
Route::get('event/{id_event}', 'EventController@show');
Route::post('createvent', 'EventController@create');

//Search
Route::get('search', 'SearchController@search');
Route::post('search/', 'SearchController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

