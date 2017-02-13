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
Route::get('/', 'StudentController@index');
Route::get('student/create', function() { return view('create'); });
Route::post('student/create', 'FormController@check');
Route::get('student/{id}', 'StudentController@detail');
Route::get('help', function() { return view('help'); });
Route::get('student/{id}/upload', 'UploadController@upload');
Route::post('student/upload', 'UploadController@store');
Route::get('student/{id}/delete', 'DeleteController@delete');
Route::post('student/delete', 'DeleteController@store');


Route::get('student/{id}/edit', 'EditController@edit');
Route::post('student/{id}/edit', 'EditController@store');

