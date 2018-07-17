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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/competitions', 'CompetitionController');
Route::resource('/history', 'ParticipationHistoryController');
Route::resource('/organizerteam', 'OrganizerTeamController');
Route::resource('/organizers', 'OrganizersController');
Route::get('/history/all_participants/{competition_id}', 'ParticipationHistoryController@showallparticipants');
Route::get('/history/all_participants/{competition_id}', 'ParticipationHistoryController@showallparticipants');