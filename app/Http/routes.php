<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('contact', 'PagesController@getContact');

Route::get('about', 'PagesController@getAbout');

Route::get('/', 'PagesController@getIndex');



Route::resource('jobs', 'JobController');

Route::resource('job_types', 'JobTypeController');
Route::get('admin', 'PagesController@getAdmin');
Route::resource('contacts', 'ContactController');
Route::resource('contact_types', 'Contact_TypeController');
Route::resource('roles', 'RoleController');
Route::resource('add_contacts', 'AddMoreContactsController');





