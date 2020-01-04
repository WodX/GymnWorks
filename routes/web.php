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


Route::get('/', 'PagesController@index');
Route::get('role', 'PagesController@role');
Route::patch('role/{user}', 'PagesController@update');

Route::resource('posts', 'PostsController');
Route::resource('plans', 'PlansController');
Route::post('plans/duplicate/{plan}', 'PlansController@duplicate')->name('plans.duplicate');
	
Route::get('home', 'HomeController@index')->name('home');

Route::post('plans/{plan}/tasks', 'PlanTasksController@store');
Route::patch('tasks/{task}', 'PlanTasksController@update');
Route::delete('tasks/{task}', 'PlanTasksController@destroy');

Route::put('user/{user}', 'UsersController@update');
Route::patch('user/{user}/type', 'UsersController@usertype');
Route::get('user/{user}/edit', 'UsersController@edit');
Route::get('user/{user}/show', 'UsersController@show');
Route::delete('user/{user}', 'UsersController@destroy');

Route::get('gymnasts', 'UserGymnastsController@index');
Route::post('user/{user}/gymnasts', 'UserGymnastsController@store');
Route::delete('gymnasts/{gymnast}', 'UserGymnastsController@destroy');

Auth::routes();


