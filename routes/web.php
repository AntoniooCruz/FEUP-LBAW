<?php
use App\Category;

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
    return redirect('home');
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
    return view('pages.about', ['categories' => Category::all()]);
  })->name('about');

Route::get('faqs', function () {
    return view('pages.faqs', ['categories' => Category::all()]);
  })->name('faqs');


//Profile
Route::get('profile', 'ProfileController@show')->name('myProfile');
Route::post('profile/remove', 'ProfileController@remove')->name('removeProfile');
Route::get('profile/edit', 'ProfileController@showEdit');
Route::post('profile/edit', 'ProfileController@update');
Route::get('profile/{id_user}', 'ProfileController@showUser');
Route::put('api/profile/{id_user}/follow','ProfileController@followUser');
Route::delete('api/profile/{id_user}/follow','ProfileController@unfollowUser');
Route::post('api/event/{id_event}/ticket', 'EventController@purchaseTicket');
Route::put('profile/{id_user}/ban', 'ProfileController@ban');
Route::post('profile/{id_user}/report', 'ProfileController@report');

Route::get('/invites', 'InviteController@showMyInvites');

//Event
Route::get('event/{id_event}', 'EventController@show');
Route::post('event', 'EventController@create');
Route::get('api/post/{id_post}/comments','EventController@getComments');
Route::post('api/event/{id_event}/post/{id_post}/comment', 'EventController@addComment');
Route::post('api/event/{id_event}/post', 'EventController@newPost');
Route::post('/api/pollOption/{poll_option_id}', 'EventController@vote');
Route::post('event/{id_event}/report', 'EventController@report');
Route::delete('api/event/{id_event}/post/{id_post}/delete', 'EventController@deletePost');

//Search
Route::get('search', 'SearchController@search');
Route::get('api/search', 'SearchController@onpagesearch');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Invites
Route::get('invites', 'InviteController@showMyInvites');

//Tickets
Route::get('tickets', 'TicketController@showMyTickets');

//Admin
Route::get('admin', 'AdminController@show');

Route::put('report/{id_report}/accept', 'ReportController@accept');
Route::put('report/{id_report}/archive', 'ReportController@archive');