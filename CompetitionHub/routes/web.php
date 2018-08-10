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

Route::get('/chlogout', 'Auth\\LoginController@chlogout')->name('chlogout');

# User Routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{user_id}/profile', 'HomeController@profile');
Route::get('/{user_id}/profile_edit', 'HomeController@editProfile');
Route::post('/profile_update', 'HomeController@updateuser');
Route::get('/settings', 'HomeController@settings');

# Competition Routes
Route::get('/competitions/top_competitons', 'CompetitionController@allCompetitions');
Route::get('/competitions/top_competitons_by_catagory', 'CompetitionController@allCompetitionsByCatagory');
Route::get('/competitions/{competition_id}/delete', 'CompetitionController@destroy');
Route::resource('/competitions', 'CompetitionController');

# Participation History Routes
Route::resource('/history', 'ParticipationHistoryController');
Route::get('/history/all_participants/{competition_id}', 'ParticipationHistoryController@showallparticipants');
Route::get('/history/all_participants/{competition_id}', 'ParticipationHistoryController@showallparticipants');
Route::get('/history/delete/{participant_id}/{competition_id}', 'ParticipationHistoryController@destroy');

# Organizer Team Routes
Route::resource('/organizerteam', 'OrganizerTeamController');

# Update Routes
Route::get('/update/{competition_id}/show', 'UpdatesController@show');
Route::get('/update/{competition_id}/create', 'UpdatesController@create');
Route::post('/update/{competition_id}', 'UpdatesController@store'); 

# Organizers Routes
Route::resource('/organizers', 'OrganizersController');
Route::get('/organizers/delete/{user_id}/{organizer_team_id}', 'OrganizersController@destroy'); 
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

# Socialite
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'twitter|facebook|linkedin|google|github');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'twitter|facebook|linkedin|google|github');

# Notifications
Route::get('member_added', 'NotificationController@addedOrganizerMember')->name('MemberAddedNotification');
Route::get('markasread', 'NotificationController@MarkasRead')->name('markAsRead');
Route::get('update_notificaiton', 'NotificationController@updatePost');
Route::get('event_alert', 'NotificationController@EventAlert')->name('event_alert');


