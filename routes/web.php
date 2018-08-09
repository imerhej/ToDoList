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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'TaskController@index')->name('home');
Route::resource('/tasks', 'TaskController');
Route::post('/getTasks', 'TaskController@getTasks');
Route::post('/tasks/{id}', 'TaskController@updateCompleted')->name('tasks.completed');
Route::post('/storeSubTask/{id}', 'TaskController@storeSubTask');
Route::post('/getSubTask/{id}', 'TaskController@getSubTask');
Route::post('/updatesubtask/{id}', 'TaskController@updatesubtask');
Route::delete('/deleteSubTask/{id}', 'TaskController@deleteSubTask');