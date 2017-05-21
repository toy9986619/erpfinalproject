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
/*Route::get('test', function(){
	return "hi";
});*/
Route::get('testjson', function(){
	return view('testjson');
});
Route::get('staff', 'StaffController@index');
Route::get('/test', 'TestController@jsontest');

Route::get('home', function(){
	return view('home');
});
/*Route::get('log-in', function(){
	return view('login');
});*/
Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@login');
//Route::get('logout', 'LoginController@logout');
Route::get('record','RecordController@index');

Route::resource('salary', 'SalaryController');
Route::get('countSalary', 'WorktimeController@countSalary');
