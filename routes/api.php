<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/albums',function (){
    $albums = \App\Album::all();
    return $albums;
});

Route::post('/register','ApiAuth\RegisterController@register');

Route::post('/login','ApiAuth\LoginController@login');

Route::middleware('auth:api')->post('/logout','ApiAuth\LoginController@logout');



