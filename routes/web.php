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
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');

Route::resource('priorities', 'PriorityController');
Route::get('leads/{leadId}/download', 'MailBoxController@downloadAttachment')->name('leads.download');
Route::get('leads/{leadId}/body', 'MailBoxController@getBody')->name('leads.body');
Route::get('leads/{leadId}/reassigned', 'MailBoxController@getReassigned')->name('leads.reassigned');
Route::get('leads/{leadId}/rejected', 'MailBoxController@getRejected')->name('leads.rejected');
Route::get('leads/{leadId}/delete', 'MailBoxController@destroy')->name('leads.destroy');
Route::get('leads/{from}/{to}/report', 'MailBoxController@report')->name('leads.report');
Route::get('leads/{from}/{to}/email', 'MailBoxController@reportEmail')->name('leads.reportemail');
//Route::get('leads/report/{from}/{to}', 'MailBoxController@report')->name('leads.report');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

	Route::get('emails', ['as' => 'emails.manage', 'uses' => 'MailBoxController@manage']);
	Route::post('emails', ['as' => 'emails.manage2', 'uses' => 'MailBoxController@manage']);

	Route::get('getAssigned', ['as' => 'emails.getAssigned', 'uses' => 'MailBoxController@getAssignedLeads']);
	Route::post('getAssigned', ['as' => 'emails.getAssigned2', 'uses' => 'MailBoxController@getAssignedLeads']);

	Route::get('getRejected', ['as' => 'emails.getRejected', 'uses' => 'MailBoxController@getRejectedLeads']);
	Route::post('getRejected', ['as' => 'emails.getRejected2', 'uses' => 'MailBoxController@getRejectedLeads']);
	
	Route::get('getReassigned', ['as' => 'emails.getReassigned', 'uses' => 'MailBoxController@getReassignedLeads']);
	Route::post('getReassigned', ['as' => 'emails.getReassigned2', 'uses' => 'MailBoxController@getReassignedLeads']);
	
	Route::get('reademail', 'MailBoxController@index');
	Route::get('leads/get', 'MailBoxController@sendLeads');
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);

	
});

