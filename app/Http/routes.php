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
Route::get('add_contacts/createMore/{id}',['uses'=>'AddMoreContactsController@createMore', 'as' => 'add_contacts.createMore'] );

Route::resource('add_contacts', 'AddMoreContactsController');
Route::resource('addphotog/{$data}','JobRoleController@store');
Route::resource('job_role', 'JobRoleController');
Route::resource('orders', 'OrderController');
Route::resource('order_type', 'OrderTypeController');
Route::resource('orderItems', 'OrderItemController');
Route::resource('productServices', 'ProductServicesController');
Route::resource('packages', 'PackageController');
Route::resource('shotList', 'ShotListController');
Route::get('jobs/timeline/show/{jobid}/{timelineId}',['uses'=>'JobTimelineController@jobTimelineShow', 'as' => 'job_timeline.jobtimelineShow']);
Route::resource('timeline', 'TimelineController');
Route::get('jobs/timeline/index/{jobid}', ['uses'=>'JobTimelineController@jobTimelineIndex', 'as' => 'job_timeline.jobtimelineIndex']);
Route::resource('jobtimeline',  'JobTimelineController');














