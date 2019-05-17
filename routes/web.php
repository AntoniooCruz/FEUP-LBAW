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



// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


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