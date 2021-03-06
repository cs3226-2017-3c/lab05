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

Route::get('student/create', 'CreateController@create' );
Route::post('student/create', 'CreateController@check');
Route::get('student/{id}/edit', 'EditController@upload');
Route::post('student/edit', 'EditController@store');
Route::get('student/{id}/delete', 'DeleteController@delete');
Route::post('student/delete', 'DeleteController@store');


Route::get('student/{id}/score', 'EditScoreController@edit');
Route::post('student/score', 'EditScoreController@store');
Route::post('student/{id}/history/delete', 'DeleteScoreController@store');

Route::get('bulkEdit', 'BulkEditController@home');
Route::post('bulkEdit', 'BulkEditController@editHome');
Route::get('bulkEdit/{component}/{id}', 'BulkEditController@edit');
Route::post('bulkEdit/{component}/{id}', 'BulkEditController@store');


Route::get('history', 'HistoryController@history');
Route::get('historyDataSet', 'HistoryController@historyDataSet');
Route::get('student/{id}', 'DetailController@detail');
Route::get('student/{id}/history', 'HistoryController@studentHistory');
Route::get('student/{id}/historyDataSet', 'HistoryController@studentHistoryDataSet');


Route::get('achievement', function() { return view('achievement'); });
Route::post('achievement', 'AchievementController@achievementHome');
Route::get('achievement/{component}/{id}', 'AchievementController@detail');

Route::get('redirect', 'SocialAuthController@redirect');
Route::get('github', 'SocialAuthController@callback');


Route::get('message', 'MessageController@retrieve');
Route::post('message', 'MessageController@send');

Route::get('/changeLanguage/{locale}', array( 
	'Middleware' => 'Language',
	'uses' => 'LanguageController@switchLang'));