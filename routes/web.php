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

Route::get('/', ['as' => 'home', 'uses' => function () {
    return view('home');
}]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/servers', 'ServersController@index')->name('servers');
Route::get('/servers/add', 'ServersController@add')->name('servers/add');
Route::post('/servers/insert', 'ServersController@insert')->name('servers/insert');
Route::post('/servers/update', 'ServersController@update')->name('servers/update');
Route::get('/servers/change/{serverid}', 'ServersController@change')->name('servers/change');
Route::get('/servers/delete/{serverid}', 'ServersController@delete')->name('servers/delete');
Route::post('/servers/remove', 'ServersController@remove')->name('servers/remove');

Route::get('/servergroups', 'ServerGroupsController@index')->name('servergroups');
Route::get('/servergroups/add', 'ServerGroupsController@add')->name('servergroups/add');
Route::post('/servergroups/insert', 'ServerGroupsController@insert')->name('servergroups/insert');
Route::post('/servergroups/update', 'ServerGroupsController@update')->name('servergroups/update');
Route::get('/servergroups/change/{servergroupid}', 'ServerGroupsController@change')->name('servergroups/change');
Route::get('/servergroups/delete/{servergroupid}', 'ServerGroupsController@delete')->name('servergroups/delete');
Route::post('/servergroups/remove', 'ServerGroupsController@remove')->name('servergroups/remove');

Route::get('/thresholdprofiles', 'ThresholdProfileController@index')->name('thresholdprofiles');
Route::get('/thresholdprofiles/add', 'ThresholdProfileController@add')->name('thresholdprofiles/add');
Route::post('/thresholdprofiles/insert', 'ThresholdProfileController@insert')->name('thresholdprofiles/insert');
Route::post('/thresholdprofiles/update', 'ThresholdProfileController@update')->name('thresholdprofiles/update');
Route::get('/thresholdprofiles/change/{profileid}', 'ThresholdProfileController@change')->name('thresholdprofiles/change');
Route::get('/thresholdprofiles/delete/{profileid}', 'ThresholdProfileController@delete')->name('thresholdprofiles/delete');
Route::post('/thresholdprofiles/remove', 'ThresholdProfileController@remove')->name('thresholdprofiles/remove');

Route::get('/dbconnectionprofiles', 'DbConnectionProfileController@index')->name('dbconnectionprofiles');
Route::get('/dbconnectionprofiles/add', 'DbConnectionProfileController@add')->name('dbconnectionprofiles/add');
Route::post('/dbconnectionprofiles/insert', 'DbConnectionProfileController@insert')->name('dbconnectionprofiles/insert');
Route::post('/dbconnectionprofiles/update', 'DbConnectionProfileController@update')->name('dbconnectionprofiles/update');
Route::get('/dbconnectionprofiles/change/{servergroupid}', 'DbConnectionProfileController@change')->name('dbconnectionprofiles/change');
Route::get('/dbconnectionprofiles/delete/{servergroupid}', 'DbConnectionProfileController@delete')->name('dbconnectionprofiles/delete');
Route::post('/dbconnectionprofiles/remove', 'DbConnectionProfileController@remove')->name('dbconnectionprofiles/remove');

Route::get('/notifications', 'NotificationsController@index')->name('notifications');
