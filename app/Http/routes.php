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


Route::get('job/files/{jobID}',['uses'=>'JobController@files', 'as' => 'job.files'] );

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
Route::get('ajaxGetShot/{id}',['uses'=>'ShotListController@ajaxGetShot', 'as' => 'ajaxGetShot.show']);

Route::get('shotDelete/{id}',['uses'=>'ShotListController@deleteShot', 'as' => 'shotDelete.delete']);

Route::resource('shotList', 'ShotListController');
Route::get('jobs/timeline/create/{jobid}/{timelineId}',['uses'=>'JobTimelineController@jobTimelineCreate', 'as' => 'job_timeline.jobtimelineCreate']);
Route::get('shotDelete/{id}',['uses'=>'ShotListController@deleteShot', 'as' => 'shotDelete.delete']);
Route::get('jobs/timeline/show/{jobid}/{timelineId}',['uses'=>'JobTimelineController@jobTimelineShow', 'as' => 'job_timeline.jobtimelineShow']);
Route::get('jobs/timeline/addShot/{jobid}/{timelineId}/{shotid}',['uses'=>'JobTimelineController@jobTimelineAddShot', 'as' => 'job_timeline.jobtimelineAddShot']);

Route::get('createtimeline/{id}',['uses'=>'TimelineController@createTimeline', 'as' => 'timeline.createTimeline']);

Route::resource('timeline', 'TimelineController');
Route::get('jobs/timeline/addtimelinegroup/{timelineID}/{timelinegroupID}/{jobID}' , ['uses' => 'JobTimelineController@addbygroup', 'as' => 'timeline.addTimelinegroup']);

Route::get('jobs/timeline/index/{jobid}', ['uses'=>'JobTimelineController@jobTimelineIndex', 'as' => 'job_timeline.jobtimelineIndex']);
Route::resource('jobtimeline',  'JobTimelineController');
Route::get('shotListDelete/{id}',['uses'=>'ShotListShotsController@deleteShot', 'as' => 'shotListDelete.delete']);
Route::resource('shotListShots', 'ShotListShotsController');
Route::get('timelinegroupshot/{groupid}/{shotid}',['uses'=>'TimelineGroupController@addshot', 'as' => 'timelinegroupshot.addshot']);
Route::get('cleartimelineshots/{jobID}/{timelineID}', ['uses'=>'JobTimelineController@clearallshots', 'as' => 'timelineshots.clear']);
Route::resource('timelinegroup','TimelineGroupController');

Route::resource('timelinegroupshot', 'TimelineGroupShotController');
Route::resource('session_type', 'Session_Type_Controller');
Route::resource('session' , 'SessionController');
Route::get('jobs/sessions/{jobID}' , ['uses'=>'JobSessionsController@getsessions', 'as' => 'jobsSessions.index']);
Route::get('jobs/sessions/{jobID}/{sessionID}/show' , ['uses'=>'JobSessionsController@showsession', 'as' => 'jobsSessions.show']);

Route::get('jobs/sessions/create/{jobID}/{photogID}' , ['uses'=>'JobSessionsController@createsession', 'as' => 'jobsSessions.create']);

//Athentication

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');

//Registration

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::resource('task', 'TaskController');

Route::resource('taskitem', 'TaskItemController');
Route::post('taskgroup/addtask' , ['uses'=>'TaskGroupController@addtask', 'as'=>'taskgroup.addtask']);
Route::delete('taskgroup/destroytask/{id}', ['uses'=>'TaskGroupController@destroytask', 'as'=>'taskgroup.destroytask']);

Route::resource('taskgroup', 'TaskGroupController');














