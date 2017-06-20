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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth'], function(){
	Route::get('testjson', function(){
		return view('testjson');
	});
	Route::get('salaryjson', function(){
		return view('salaryjson');
	});
	Route::resource('staff', 'StaffController');
	Route::get('/test', 'TestController@jsontest');

	Route::get('home', function(){
		return view('home');
	});

	Route::get('record','RecordController@index');
	Route::get('recordtest', function(){
		return view('record');
	});
	Route::get('salarytest', function(){
		return view('salary');
	});
	Route::get('admintest', function(){
		return view('admin');
	});

	Route::resource('salary', 'SalaryController');
	Route::get('countSalary', 'WorktimeController@countSalary');
	Route::get('record','RecordController@index');
	Route::get('record/{sid}', 'RecordController@show');
	Route::put('recountsalary/{id}', 'WorktimeController@reCountSalary');
	Route::resource('admin', 'UserController');

});

Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');

