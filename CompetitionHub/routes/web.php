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


# Pages Routes
Route::get('/', 'PagesController@index');

# User Authentication Routes
Auth::routes();

# User Routes
Route::get('/home', 'HomeController@index')->name('home');

# Competition Routes
Route::resource('/competitions', 'CompetitionController');

# Participation History Routes
Route::resource('/history', 'ParticipationHistoryController');
Route::get('/history/all_participants/{competition_id}', 'ParticipationHistoryController@showallparticipants');
Route::get('/history/all_participants/{competition_id}', 'ParticipationHistoryController@showallparticipants');

# Organizer Team Routes
Route::resource('/organizerteam', 'OrganizerTeamController');

# Organizers Routes
Route::resource('/organizers', 'OrganizersController');
Route::get('/organizers/create/{organizerteam_id}', 'OrganizersController@create'); 
Route::get('/organizers/save/{organizerteam_id}', 'OrganizersController@store'); 

# Admin Authentication Routes...
 Route::get('admin/home', 'AdminController@index');
 $this->get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
 $this->post('admin', 'Admin\LoginController@login');
 $this->post('logout', 'Admin\LoginController@logout')->name('logout');

# Admin Password Reset Routes...
 $this->get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
 $this->post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
 $this->get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
 $this->post('admin-password/reset', 'Admin\ResetPasswordController@reset');

# Email Verification
 Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');

 #Facebook

 Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('google.login');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');