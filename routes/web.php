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
Route::post('/getIndexHtml', 'StudentController@indexWithData');
Route::get('/', 'StudentController@index');
Route::get('help', function() { return view('help'); });


Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('student/create', function() { return view('create'); })->middleware('auth');;
Route::post('student/create', 'CreateController@check');
Route::get('student/{id}/edit', 'EditStudentController@upload');
Route::post('student/edit', 'EditStudentController@store');
Route::get('student/{id}/delete', 'DeleteController@delete');
Route::post('student/delete', 'DeleteController@store');
Route::get('student/{id}/score', 'EditScoreController@edit');
Route::post('student/score', 'EditScoreController@store');

Route::get('student/{id}', 'DetailController@detail');
Route::get('student/{id}/history', 'HistoryController@history');

Route::get('bulkEdit', 'BulkEditController@edit');
Route::post('bulkEdit', 'BulkEditController@store');

