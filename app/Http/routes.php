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
/*
Route::get('/', function () {
    return view('welcome');
}); */



Route::get('/', 'AuthenticateController@index');
Route::get('index', 'AuthenticateController@index');
Route::post('login','AuthenticateController@login');
Route::get('dashboard','DashboardController@index');
Route::get('create-user','DashboardController@insertUser');
Route::Post('create-user','DashboardController@usersCreate');
Route::get('users','DashboardController@listUser');
Route::get('delete-user/{id}','DashboardController@deleteUser');
Route::get('get-user/{id}','DashboardController@getUser');
Route::post('update-user/{id}','DashboardController@updateUser');
Route::get('inactive-users','DashboardController@inactivelistUser');
Route::get('view-user/{id}','DashboardController@getviewUser');
Route::get('logout','DashboardController@logout');

Route::get('profile','DashboardController@profile');


Route::post('profile-edit','DashboardController@editprofile');


Route::post('forgotpassword','AuthenticateController@forgotPassword');
Route::post('forgot-password','AuthenticateController@ajaxforgotPassword');
Route::get('reset-password/{id}','AuthenticateController@resetPassword');
Route::Post('reset-password/{id}','AuthenticateController@resetPassword');
Route::get('change-password','DashboardController@changePassword');
Route::post('change-password','DashboardController@changePassword');
Route::get('history-log/{id}','DashboardController@historyLog');

Route::get('activate-user/{id}','DashboardController@activateUser');


