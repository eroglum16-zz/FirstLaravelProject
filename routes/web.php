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

Route::get('/', 'PagesController@home');

Route::get('/home', 'PagesController@home');

Route::get('/about', 'PagesController@about');

Route::get('/contact', 'PagesController@contact');

Route::get('/todo', 'PagesController@todo');

Route::get('/projects', 'ProjectsController@index');

Route::get('/projects/{project}','ProjectsController@show');

Route::post('/projects/{project}/tasks','ProjectTasksController@store');

Route::patch('/tasks/{task}','ProjectTasksController@update');

Route::resource('albums','AlbumsController')->middleware('auth');



/*
Route::get('/albums', 'AlbumsController@index');

Route::get('/albums/{album}', 'AlbumsController@show');

Route::post('/albums', 'AlbumsController@store');

Route::patch('/albums/{album}','AlbumsController@update');

Route::delete('/albums/{album}','AlbumsController@destroy');

*/

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
